<?php

class Pagination
{
	public $php_self;

	public $rows_per_page = 10; //Number of records to display per page

	public $total_rows = 0; //Total number of rows returned by the query

	public $links_per_page = 5; //Number of links to display per page

	public $append = ''; //Paremeters to append to pagination links

	public $sql = '';

	public $odb;

	public $debug = false;

	public $conn = false;

	public $page = 1;

	public $max_pages = 1;

	public $offset = 0;

	public $params;

	public $mapup = [];

	private $supported_engine = ['sql', 'mongo', 'array'];

	private $set_engine = '';

	private $querys = [];

	private $valid_keys = ['sql' => ['odb', 'query', 'params', 'limit', 'offset'], 'mongo' => ['odb', 'collection', 'params', 'sort', 'limit', 'offset', 'options'], 'array' => ['data', 'limit', 'offset', 'sort']];

	private $diff = [];

	/**
	 * Constructor
	 *
	 * @param resource $connection adodb connection link
	 * @param object $sql is the adodb connection instands
	 * @param Array $tablename tables to query from
	 * @param integer $rows_per_page Number of records to display per page. Defaults to 10
	 * @param integer $links_per_page Number of links to display per page. Defaults to 5
	 * @param Array $input_array the query where condictions // where name='ato'
	 * @param Array $outputcolumns the output columns. Default is All
	 * @param Array $mappings the mapping columns in cases of join query.
	 * @param string $append Parameters to be appended to pagination links
	 */

	/**
	 * //sql
$querys = ['odb'=>$sql,'query'=>$query, 'limit'=>$limit, 'offset'=> $lenght, 'params'=>[]];
//mongo
//$querys = ['odb' => $mongo, 'collection' => 'gog_natsumippd2', 'limit' => $limit, 'offset' => $lenght,'sort'=>["NTR_ELEM_GROUP_NAME"=>-1], 'params' => [],'options'=>[]];
//array
//$data = array("Apple", "Banana", "Orange");
//$querys = ['data' => $data, 'limit' => $limit, 'offset' => $lenght,'sort'=> 1];
	 */
	public function __construct($db_engine, $query_array = [], $append = '')
	{
		if (in_array($db_engine, $this->supported_engine) && count($query_array) > 0) {
			$this->set_engine = $db_engine;
			$this->querys = $query_array;
		} else {
			if ($this->debug) {
				echo 'Unknown engine type: ' . $db_engine;
			}

			return false;
		}
		//SET APPENDMENT TO THE RETURN URL
		$this->append = $append;
		$this->php_self = htmlspecialchars($_SERVER['PHP_SELF']);
		if (isset($_REQUEST['page'])) {
			$this->page = intval($_REQUEST['page']);
		}
	}

	private function validateArrayKeys()
	{
		if (!empty($this->set_engine)) {
			$to_validate = $this->valid_keys[$this->set_engine];
			$query_keys = array_keys($this->querys);
			$this->diff = array_diff($to_validate, $query_keys);

			return true;
		} else {
			if ($this->debug) {
				echo 'Unknown engine type: ' . $this->set_engine;
			}

			return false;
		}
	}

	/**
	 * Executes the SQL query and initializes internal variables
	 *
	 * @access public
	 * @return resource
	 */
	public function paginate()
	{
		$pass_keys = [];
		$pass_keys = $this->validateArrayKeys();
		if ($pass_keys) {
			$this->rows_per_page = (int)$this->querys['limit'];

			if (empty($this->querys['limit'])) {
				$this->rows_per_page = 20;
				@$_SESSION['limited'] = 20;
			}

			if (intval($this->querys['offset']) > 0) {
				$this->links_per_page = (int) $this->querys['offset'];
			} else {
				$this->links_per_page = 5;
			}

			$rs = $this->{'_' . $this->set_engine}();

			return $rs;
		} else {
			if ($this->debug) {
				echo 'Unknown query array keys passed.' . implode(',', (array) $this->diff);
			}

			return false;
		}
	}

	private function _sql()
	{
		//Find total number of rows
		$this->odb = $this->querys['odb'];
		$this->sql = $this->querys['query'];
		$this->params = $this->querys['params'];
		$stmt = $this->odb->Prepare($this->sql);

		if (is_array($this->params) && !empty($this->params)) {
			$stmt = $this->odb->Prepare($this->sql, $this->params);
			$stmt = strtolower($stmt);
			$str = explode('from', $stmt);

			$stmt = 'SELECT COUNT(*) AS TT FROM ' . $str[1];
			$stmt = $this->odb->Execute($stmt, array_values($this->params));

			$obj = $stmt->fetchNextObj();
		} else {
			$stmt = strtolower($stmt);
			$str = explode('from', $stmt);

			$stmt = 'SELECT COUNT(*) AS TT FROM ' . $str[1];
			$stmt = $this->odb->Execute($stmt);

			$obj = $stmt->fetchNextObj();

			// print_r($obj);
		}

		if (!$obj) {
			if ($this->debug) {
				echo 'SQL query failed. Check your query.<br /><br />Error Returned: ' . $this->odb->ErrorMsg();
			}

			return false;
		}
		$this->total_rows = $obj->TT;

		//Return FALSE if no rows found
		if ($this->total_rows == 0) {
			if ($this->debug) {
				echo 'Query returned zero rows.';
			}

			return false;
		}

		if ($this->rows_per_page != 'all') {
			//Max number of pages
			$this->max_pages = ceil($this->total_rows / $this->rows_per_page);
			if ($this->links_per_page > $this->max_pages) {
				$this->links_per_page = $this->max_pages;
			}

			//Check the page value just in case someone is trying to input an aribitrary value
			if ($this->page > $this->max_pages || $this->page <= 0) {
				$this->page = 1;
			}

			//Calculate Offset
			$this->offset = $this->rows_per_page * ($this->page - 1);

			//Fetch the required result set
			$rs = $this->odb->Prepare($this->sql . " LIMIT {$this->offset}, {$this->rows_per_page}");
			//$rs = $this->odb->Prepare($this->sql);
			//select all

			if (is_array($this->params) && !empty($this->params)) {
				$rs = $this->odb->Execute($rs, $this->params);
			} else {
				$rs = $this->odb->Execute($rs);
			} //end of if
		} else {
			$rs = $this->odb->Prepare($this->sql);
			//select all
			if (is_array($this->params) && !empty($this->params)) {
				$rs = $this->odb->Execute($rs, $this->params);
			} else {
				$rs = $this->odb->Execute($rs);
			} //end of if
		}

		if (!$rs) {
			if ($this->debug) {
				echo 'Pagination query failed. Check your query.<br /><br />Error Returned: ' . $this->odb->ErrorMsg();
			}

			return false;
		}

		return $rs->GetArray();
	}

	//end of _sql function

	private function _mongo()
	{
		$this->odb = $this->querys['odb'];
		$collection = $this->querys['collection'];
		$this->params = $this->querys['params'];
		$this->total_rows = $this->odb->Execute($collection)->count($this->params);

		//Return FALSE if no rows found
		if ($this->total_rows == 0) {
			if ($this->debug) {
				echo 'Query returned zero rows.';
			}

			return false;
		}

		if ($this->rows_per_page != 'all') {
			//Max number of pages
			$this->max_pages = ceil($this->total_rows / $this->rows_per_page);
			if ($this->links_per_page > $this->max_pages) {
				$this->links_per_page = $this->max_pages;
			}

			//Check the page value just in case someone is trying to input an aribitrary value
			if ($this->page > $this->max_pages || $this->page <= 0) {
				$this->page = 1;
			}

			//Calculate Offset
			$this->offset = $this->rows_per_page * ($this->page - 1);

			$options = [];
			$options = $this->querys['options'];
			$options['limit'] = (int) $this->rows_per_page;
			$options['skip'] = (int) $this->offset;
			if (!empty($this->querys['sort'])) {
				$options['sort'] = $this->querys['sort'];
			}

			if (is_array($this->params) && !empty($this->params)) {
				$cursor = $this->odb->Execute($collection)->find($this->params, $options);
			} else {
				$cursor = $this->odb->Execute($collection)->find([], $options);
			} //end of if
		} else {
			//select all
			if (is_array($this->params) && !empty($this->params)) {
				$cursor = $this->odb->$collection->find($this->params, $options);
			} else {
				$cursor = $this->odb->$collection->find([], $options);
			} //end of if
		}

		if ($cursor != null) {
			$rs = $cursor;
			unset($cursor);
		} else {
			if ($this->debug) {
				echo 'Pagination query failed. Check your query.<br /><br />Error Returned: ' . $this->odb->ErrorMsg();
			}

			return false;
		}

		return $rs->toArray();
	}

	//end of _mongo

	private function _array()
	{
		$data = $this->querys['data'];
		$this->params = $this->querys['params'];
		$this->total_rows = count($data);

		//Return FALSE if no rows found
		if ($this->total_rows == 0) {
			if ($this->debug) {
				echo 'Query returned zero rows.';
			}

			return false;
		}

		if ($this->rows_per_page != 'all') {
			//Max number of pages
			$this->max_pages = ceil($this->total_rows / $this->rows_per_page);
			if ($this->links_per_page > $this->max_pages) {
				$this->links_per_page = $this->max_pages;
			}

			//Check the page value just in case someone is trying to input an aribitrary value
			if ($this->page > $this->max_pages || $this->page <= 0) {
				$this->page = 1;
			}

			//Calculate Offset
			$this->offset = $this->rows_per_page * ($this->page - 1);

			$cursor = [];
			for ($i = (int) $this->offset; $i < (int) $this->rows_per_page; $i++) {
				if (!empty($data[$i])) {
					$cursor[] = $data[$i];
				}
			}
			if (!empty($this->querys['sort'])) {
				sort($cursor);
			}

			$rs = $cursor;
		} else {
			//select all
			$rs = $data;
		}

		return $rs;
	}

	//end of _array

	/**
	 * Display the link to the first page
	 *
	 * @access public
	 * @param string $tag Text string to be displayed as the link. Defaults to 'First'
	 * @return string
	 */
	public function renderFirst($tag = 'First')
	{
		if ($this->total_rows == 0) {
			return false;
		}

		if ($this->page == 1) {
			return '';
		} else {
			//return '<a href="' . $this->php_self . '?page=1&' . $this->append . '">' . $tag . '</a> ';
			return '<a href="javascript:void(0)" onclick="document.getElementById(\'pagehiddenallform\').value=\'1\';document.getElementById(\'myform\').submit()" class="" title="First Page">' . $tag . '</a>';
		}
	}

	/**
	 * Display the link to the last page
	 *
	 * @access public
	 * @param string $tag Text string to be displayed as the link. Defaults to 'Last'
	 * @return string
	 */
	public function renderLast($tag = 'Last')
	{
		if ($this->total_rows == 0) {
			return false;
		}

		if ($this->page == $this->max_pages) {
			return '';
		} else {
			//return ' <a href="' . $this->php_self . '?page=' . $this->max_pages . '&' . $this->append . '">' . $tag . '</a>';
			return '<a href="javascript:void(0)" onclick="document.getElementById(\'pagehiddenallform\').value=' . ($this->max_pages) . ';document.getElementById(\'myform\').submit()" class="" title="Last Page">' . $tag . '</a>';
		}
	}

	/**
	 * Display the next link
	 *
	 * @access public
	 * @param string $tag Text string to be displayed as the link. Defaults to '>>'
	 * @return string
	 */
	public function renderNext($tag = '&gt;&gt;', $tagon = '&lt;&lt;')
	{
		if ($this->total_rows == 0) {
			return $tag;
		}

		if ($this->page < $this->max_pages) {
			return (($this->page < ($this->max_pages - $this->links_per_page)) ? '' : '') . '<a href="javascript:void(0)" onclick="document.getElementById(\'pagehiddenallform\').value=' . ($this->page + 1) . ';document.getElementById(\'myform\').submit()" class="" title="Next Page">' . $tagon . '</a>';
		} else {
			return $tag;
		}
	}

	/**
	 * Display the previous link
	 *
	 * @access public
	 * @param string $tag Text string to be displayed as the link. Defaults to '<<'
	 * @return string
	 */
	public function renderPrev($tag = '&lt;&lt;', $tagon = '&lt;&lt;')
	{
		if ($this->total_rows == 0) {
			return $tag;
		}

		if ($this->page > 1) {
			return '<a href="javascript:void(0)" onclick="document.getElementById(\'pagehiddenallform\').value=' . ($this->page - 1) . ';document.getElementById(\'myform\').submit()" class="" title="Previous Page">' . $tagon . '</a>' . (($this->page > $this->links_per_page) ? '' : '');
		} else {
			return " $tag";
		}
	}

	/**
	 * Display the page links
	 *
	 * @access public
	 * @return string
	 */
	public function renderNav($prefix = '<span class="page_link">', $suffix = '</span>')
	{
		if ($this->total_rows == 0) {
			return false;
		}

		$batch = ceil($this->page / $this->links_per_page);
		$end = $batch * $this->links_per_page;
		if ($end == $this->page) {
			//$end = $end + $this->links_per_page - 1;
			//$end = $end + ceil($this->links_per_page/2);
		}
		if ($end > $this->max_pages) {
			$end = $this->max_pages;
		}
		$start = $end - $this->links_per_page + 1;
		$links = '';

		for ($i = $start; $i <= $end; $i++) {
			if ($i == $this->page) {
				$links .= $prefix . " $i " . $suffix;
			} else {
				$links .= ' ' . $prefix . '<a href="' . $this->php_self . '?page=' . $i . '&' . $this->append . '">' . $i . '</a>' . $suffix . ' ';
			}
		}

		return $links;
	}

	/**
	 * Display the page number
	 *
	 * @access public
	 * @return string
	 */
	public function renderNavNum()
	{
		if ($this->total_rows == 0) {
			return false;
		}

		$batch = ceil($this->page / $this->links_per_page);
		$end = $batch * $this->links_per_page;
		if ($end > $this->max_pages) {
			$end = $this->max_pages;
		}
		$start = $end - $this->links_per_page + 1;
		$links = '';

		return $this->page;
	}

	/**
	 * Display full pagination navigation
	 *
	 * @access public
	 * @return string
	 */
	public function renderFullNav()
	{
		return $this->renderFirst() . '&nbsp;' . $this->renderPrev() . '&nbsp;' . $this->renderNav() . '&nbsp;' . $this->renderNext() . '&nbsp;' . $this->renderLast();
	}

	public function limitList($limit, $formname)
	{
		echo '<input type="hidden" value="" name="page" id="pagehiddenallform" />';
		echo '<select name="limit" onchange="document.' . $formname . '.submit()" style="width:60px;padding-left:5px; height:31px;border-radius:5px; border:1px solid #EDEDED;">
                <option ' . (($limit == '10') ? 'selected="selected"' : '') . ' value="10">10</option>
                <option ' . (($limit == '50') ? 'selected="selected"' : '') . ' value="50">50</option>
                <option ' . (($limit == '100') ? 'selected="selected"' : '') . ' value="100">100</option>
                <option ' . (($limit == '200') ? 'selected="selected"' : '') . ' value="200">200</option>
                <option ' . (($limit == '500') ? 'selected="selected"' : '') . ' value="500">500</option>
            </select>';
	}

	public function deplayPage($formname)
	{
		echo ' <input name="page" type="text" value="' . $this->renderNavNum() . '" style="width:40px;padding-left:5px; height:31px;border-radius:5px; border:1px solid #EDEDED;" onblur="document.getElementById(\'pagehiddenallform\').value=this.value;document.' . $formname . '.submit();"/>';
	}

	/**
	 * Set debug mode
	 *
	 * @access public
	 * @param bool $debug Set to TRUE to enable debug messages
	 * @return void
	 */
	public function setDebug($debug)
	{
		$this->debug = $debug;
	}

	public function mapUp($subholdings)
	{
		$this->mapup = $subholdings;
	}

	public function buildForm()
	{
		$isValid = false;
		$exp = ['keys', 'view', 'selproduct', 'subaction', 'target', 'syscheckbox', 'syscheckbox2', 'syscheckbox3', 'checkmandate', 'inputdate', 'option', 'viewpage', 'inputyear', 'inputmonth', 'basregid', 'basdisid', 'basdepid', 'basminid', 'fdsearch', 'fsearch', 'report', 'inputusername', 'inputuserpassword', 'inputsurname', 'inputothername', 'prollid', 'phoneno', 'uregion', 'inputcategory', 'inputpriority', 'inputopexception', 'inputpassword', 'inputstatus', 'action_keysup', 'cirdisid', 'agencyid', 'cirunitid', 'ajaxfilter', 'frmname', 'month', 'year'];

		if (is_array($_POST)) {
			$str = '
				<input type="hidden" value="" name="page" id="pagehiddenallform" />';
			$isValid = true;
			foreach ($_POST as $key => $value) {
				if (in_array($key, $exp)) {
					$str .= '<input type="hidden" value="' . $value . '" name="' . $key . '" />';
				}
			}
		}
		// for map ups
		if (is_array($this->mapup) && count($this->mapup) > 0) {
			foreach ($this->mapup as $keymap => $valuemap) {
				$str .= '<input type="hidden" value="' . $valuemap . '" name="' . $keymap . '" />';
			}
		}
		if ($isValid) {
			//$str .= '</form>';
		}
		echo $str;
	}

	//end of buildForm

	public function view_paginate($paging, $limit, $fdsearch)
	{
		$pager = '<div class="page form">
                    <div class="row" style="padding-top:20px;padding-bottom:20px;">
                        <div class="col-sm-3">
                            <div id="pager">
                                ' . $paging->renderFirst('') . $paging->renderPrev('<span class="fa fa-chevron-left"></span>', '<span class="fa fa-chevron-left"></span>') . '
                                <input name="page" type="text" value="' . $paging->renderNavNum() . '"  style="width:40px;padding-left:5px; height:31px;border-radius:5px; border:1px solid #EDEDED;" onclick="document.getElementById(\'view\').value=\'\';document.getElementById(\'viewpage\').value=\'searchitem\';document.myform.submit;"/>
                                ' . $paging->renderNext('<span class="fa fa-chevron-right"></span>', '<span class="fa fa-chevron-right"></span>') . '
                                ' . $paging->renderLast('') . $paging->limitList($limit, 'myform') . '
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group">
                                <input type="text" tabindex="1" value="' . $fdsearch . '" class="form-control square-input" name="fdsearch" placeholder="Enter to Search"
                                />
                                <span class="input-group-btn">
                                    <button type="submit" onclick="document.getElementById(\'view\').value=\'\';document.getElementById(\'viewpage\').value=\'searchitem\';document.myform.submit;" style="background:#fff;border:none;border-bottom:1px solid #d2d2d2;padding:5px;margin-left:-13px;">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    <button style="background:#fff;border:none;border-bottom:1px solid #d2d2d2;padding:0 8px 5px 8px;margin-left:-3px;" onclick="document.getElementById(\'view\').value=\'\';document.getElementById(\'viewpage\').value=\'\';document.myform.submit;"><i class="fa fa-refresh"></i></button>
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <span style="float:right;">' . $paging->page_count($paging) . '</span>
                        </div>
                    </div>   
                </div> ';

		return $pager;
	}

	public function page_count($paging)
	{
		$count = $paging->renderNavNum() . ' of ' . $paging->max_pages . ' <b style="margin-left:10px;">Total: ' . $paging->total_rows . '</b>';

		return $count;
	}
}
