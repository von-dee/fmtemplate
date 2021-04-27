<?php
/**
 * This class defines the Navigation class and handles all system
 * page navigation from module to module.
 * Created By: Reggie Gyan
 * Date: 02-09-2019
 */

class Menu extends Engine{
	public $prefix = WEB_DB_PREFIX;
    public function __construct(){
        parent::__construct();
	}

	public function usermenu(){
		$sql = $this->sql;
		$userid = $this->session->get('userid');
		$stmt = $sql->Execute($sql->Prepare("SELECT UMN_ROOT_MENU,UMN_SUB_MENU FROM ".$this->prefix."user_menu WHERE UMN_USR_CODE=".$sql->Param('a')." AND UMN_STATUS='1' "),[$userid]);
		if($stmt && $stmt->RecordCount() >0){
			$usermenu = $stmt->FetchRow();
		}else{
			$usermenu = [];
		}
		return $usermenu;
	}

    public function rootmenu(){
		$arroot = array();
		$usrroot  = $this->usermenu();
		$rootmenu = (array) json_decode($usrroot['UMN_ROOT_MENU'],true);
		$dbrootmenu = (array) $this->init_root_menu();
		foreach ($rootmenu as $arr) {
			$arroot[] = current($arr);
		}
		foreach($dbrootmenu as $a){
			if (in_array($a["RMN_CODE"], $arroot)) {
				$arrMake[] = $a;
			}
		};
		return $arrMake;
    }

    public function submenu(){
		$sql = $this->sql;
        $subarray = array();
		$usrsub  = $this->usermenu();
		$submenu = (array) json_decode($usrsub['UMN_SUB_MENU'],true);
		$stmt = $sql->Execute($sql->Prepare("SELECT SMN_RMN_CODE,SMN_CODE,SMN_NAME,SMN_SLUG FROM ".$this->prefix."sub_menu WHERE SMN_STATUS='1' "));
		if($stmt && $stmt->RecordCount() >0){
			$dbsubmenu = (array) $stmt->GetAll();
			foreach ($submenu as $arr) {
				$subarray[] = $arr['sub'];
			}
			foreach($dbsubmenu as $a){
				if (in_array($a["SMN_CODE"], $subarray)) {
					$arrMake[] = $a;
				}
			};
		}else{
			$arrMake =[];
		}
		return $arrMake;
	}
	
	public function init_root_menu(){
		$sql = $this->sql;
		$stmt = $sql->Execute($sql->Prepare("SELECT RMN_CODE,RMN_NAME,RMN_ICON,RMN_SLUG FROM ".$this->prefix."root_menu WHERE RMN_STATUS='1' ORDER BY RMN_ORDER ASC "));
		if($stmt && $stmt->RecordCount() >0){
			$root = $stmt->GetAll();
		}else{
			$root =[];
		}
        return $root;
    }

    public function init_sub_menu($rootid){
        $sql = $this->sql;
		$stmt = $sql->Execute($sql->Prepare("SELECT SMN_CODE,SMN_NAME,SMN_SLUG FROM ".$this->prefix."sub_menu WHERE SMN_STATUS='1' AND SMN_RMN_CODE=".$sql->Param('a')." "),[$rootid]);
		if($stmt && $stmt->RecordCount() >0){
			$subroot = $stmt->GetAll();
		}else{
			$subroot =[];
		}
        return $subroot;
	}

	public function has_submenu($value,$array,$key){
		$has_it = in_array($value, array_column($array, $key)) ? true : false;
		return $has_it;
	}

	public function userAccountMenu($userid){
		$sql = $this->sql;
		$stmt = $sql->Execute($sql->Prepare("SELECT UMN_ROOT_MENU,UMN_SUB_MENU FROM ".$this->prefix."user_menu WHERE UMN_USR_CODE=".$sql->Param('a')." AND UMN_STATUS='1' "),[$userid]);
		if($stmt && $stmt->RecordCount() >0){
			$usermenu = $stmt->FetchRow();
		}else{
			$usermenu = [];
		}
		return $usermenu;
	}
}

?>