<div class="page-clients">
<div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-filled" padding>
                        <div class="panel-title">
                            <h5>Clients</h5>
                            <div class="panel-right">
                                <button type="button" class="btn btn-info" onclick="push({'view':'add','viewpage':'','payload':'<?php echo $companycode;?>'})"><i class="la la-plus"></i> Add</button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row pagination">
                                <div class="col-sm-12">
                                    <div class="page form">
                                        <div class="row" style="padding-top:20px;padding-bottom:20px;">
                                            <div class="col">
                                                <div id="pager">
                                                    <?php echo $paging->renderFirst('<span class="fa fa-angle-double-left"></span>');?>
                                                    <?php echo $paging->renderPrev('<span class="fa fa-chevron-left"></span>','<span class="fa fa-chevron-left"></span>');?>
                                                    <input name="page" type="text"
                                                        value="<?php echo $paging->renderNavNum();?>" readonly
                                                        style="width:40px;padding-left:5px; height:31px;border-radius:5px; color: inherit;border:1px solid #EDEDED; background:transparent;" />
                                                    <?php echo $paging->renderNext('<span class="fa fa-chevron-right"></span>','<span class="fa fa-chevron-right"></span>');?>
                                                    <?php echo $paging->renderLast('<span class="fa fa-angle-double-right"></span>');?>
                                                    <?php $paging->limitList($list->limit,"myform");?>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="input-group">
                                                    <input type="text" tabindex="1"
                                                        value="<?php echo $list->fdsearch; ?>"
                                                        class="form-control square-input" id="fdsearch" name="fdsearch"
                                                        placeholder="Enter to Search" />
                                                    <div class="input-group-append" id="button-addon4">
                                                        <button type="submit"
                                                            onclick="document.getElementById('view').value='';document.getElementById('viewpage').value='';document.myform.submit;"
                                                            class="btn btn-secondary">
                                                            <i class="la la-search"></i>
                                                        </button>
                                                        <button class="btn btn-info"
                                                            onclick="document.getElementById('fdsearch').value='';document.myform.submit;"><i
                                                                class="la la-refresh"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <span class="record_count"><?php echo $paging->page_count($paging);?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Photo</th>
										<th>AccNo.</th>
                                        <th>Name</th>
                                        <th>E-mail</th>
                                        <th>Phone#</th>
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
                                        <td> <img src="<?php  echo WEB_UPLOADS.DS.'profiles/'.$val['USR_PHOTO'];?>" alt="photo" onError="this.src='theme/assets/img/placeholder.jpg'" avatar></td>
										<td><?php echo $val['USR_ACC_NUM'];?></td>
                                        <td><?php echo $val['USR_FIRSTNAME'].' '.$val['USR_MIDDLENAME'].' '.$val['USR_LASTNAME'];?></td>
                                        <td><?php echo $val['USR_EMAIL'];?></td>
                                        <td><?php echo $val['USR_PHONE'];?></td>
                                        <td><?php echo (($val['USR_STATUS']==='2'))? '<i class="las la-square-full actives"></i>':'<i class="las la-square-full inactive"></i>';?></td>
                                        <td width="80px">
                                            <div class="btn-group">
                                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <button class="dropdown-item" type="button" onclick="push({'view':'add','keys':'<?php echo $val['USR_CODE'];?>','viewpage':'edit'})"><i class="la la-pen-nib"></i> Edit</button>
                                                        <button class="dropdown-item" <?php echo(($val['USR_CODE']== $userid))?"disabled":"";?> type="button" onclick="deletData('delete','<?php echo $val['USR_CODE'];?>')"><i class="la la-trash"></i> Delete</button>
                                                    </div>
                                                </div>
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
    </div>
</div>