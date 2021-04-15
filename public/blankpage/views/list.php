<div class="page-blankpage">
<input id="class_call" name="class_call" value="" type="hidden" />
    <div class="container">
        <div class="page-header">
            <h1 class="page-title"> Blank </h1>
            <div class="page-options">
                <button class="btn btn-info" type="submit" onclick="document.getElementById('view').value = 'add'; document.myform.submit();"> <i class="fa fa-plus"></i> Data</button>
                <button class="btn btn-danger" type="button" onclick="document.getElementById('view').value = ''; document.myform.submit();">Cancel</button>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row pagination">
                    <div class="col-sm-12">
                        <div class="page form">
                            <div class="row" style="padding-top:20px;padding-bottom:20px;">
                                <div class="col">
                                    <div id="pager">
                                        <?php echo $paging->renderFirst('<span class="fa fa-angle-double-left"></span>');?>
                                        <?php echo $paging->renderPrev('<span class="fa fa-chevron-left"></span>','<span class="fa fa-chevron-left"></span>');?>
                                        <input name="page" type="text" value="<?php echo $paging->renderNavNum();?>"
                                            readonly
                                            style="width:40px;padding-left:5px; height:31px;border-radius:5px; border:1px solid #EFEFEF;" />
                                        <?php echo $paging->renderNext('<span class="fa fa-chevron-right"></span>','<span class="fa fa-chevron-right"></span>');?>
                                        <?php echo $paging->renderLast('<span class="fa fa-angle-double-right"></span>');?>
                                        <?php $paging->limitList($limit,"myform");?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <input type="text" tabindex="1" value="<?php echo $fdsearch; ?>"
                                            class="form-control square-input" id="fdsearch" name="fdsearch"
                                            placeholder="Enter to Search" />
                                        <div class="input-group-append" id="button-addon4">
                                            <button type="submit"
                                                onclick="document.getElementById('view').value='';document.getElementById('viewpage').value='searchitem';document.myform.submit;"
                                                class="btn btn-secondary">
                                                <i class="fa fa-search"></i>
                                            </button>
                                            <button class="btn btn-info"
                                                onclick="document.getElementById('fdsearch').value='';document.myform.submit;"><i
                                                    class="fa fa-refresh"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <span style="float:right;"><?php echo $paging->page_count($paging);?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=1;
                            if($paging->total_rows > 0 ){
                                $page = (empty($page))? 1:$page;
                                $num = (isset($page))? ($limit*($page-1))+1:1;
                            
                                foreach ($rs as $val){      
                        ?>
                            <tr>
                                <th scope="row"><?php echo $i++;?></th>
                                <td><?php echo $val['USR_CODE'];?></td>
                                <td><?php echo $val['USR_FIRSTNAME'].' '.$val['USR_OTHERNAME'];?></td>
                                <td><?php echo $val['USR_EMAIL'];?></td>
                                <td><?php echo (($val['USR_STATUS']==='1'))? 'Active':'Inactive';?></td>
                                <td width="150px">
                                    <button class="btn btn-info" onClick="document.getElementById('view').value='edit';document.getElementById('class_call').value='edit';document.myform.submit();">Edit</button>
                                    <button class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            <?php }}else{?>
                            <tr>
                                <td colspan="6" align="center"><strong>No Record(s) Found!</strong></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>