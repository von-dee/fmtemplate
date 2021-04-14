<div class="page-manageusers">
<script src="public/settings/manageusers/scripts/tree.js"></script>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-filled" padding>
                        <div class="panel-title">
                            <h5>Edit User</h5>
                            <div class="panel-right">
                                <button type="button" class="btn btn-success" onclick="push({'view':'','viewpage':'add','keys':'<?php echo $result['USR_CODE'];?>'})"><i class="la la-check"></i> Update</button>
                                <button type="button" class="btn btn-danger" onclick="push({'view':'','viewpage':''})"><i class="la la-close"></i> Cancel</button>
                            </div>
                        </div>

                        <div class="panel-body" margin-top>
                            <div class="col-sm-12 row">
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="">First Name</label>
                                            <input class="form-control" type="text" name="fname" value="<?php echo $result['USR_FIRSTNAME'];?>">
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="">Last Name</label>
                                            <input class="form-control" type="text" name="lname" value="<?php echo $result['USR_OTHERNAME'];?>">
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="">Gender</label>
                                            <select class="form-control" name="gender" id="gender">
                                                <option value="" disabled selected>Select Gender...</option>
                                                <option value="M" <?php echo (($result['USR_GENDER']=='M'))?'selected':'';?> >Male</option>
                                                <option value="F" <?php echo (($result['USR_GENDER']=='F'))?'selected':'';?> >Female</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="">Phone No.</label>
                                            <input class="form-control" type="text" name="uphone" value="<?php echo $result['USR_PHONE'];?>">
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="">Email</label>
                                            <input class="form-control" type="email" name="uemail" value="<?php echo $result['USR_EMAIL'];?>">
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="">Country</label>
                                            <select class="form-control" name="country" id="country">
                                                <option value="" disabled selected>Select country...</option>
                                                <option value="68" <?php echo (($result['USR_COUNTRY']=='68'))?'selected':'';?> >Ghana</option>
                                                <option value="28" <?php echo (($result['USR_COUNTRY']=='28'))?'selected':'';?> >Nigeria</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="">Access Level</label>
                                            <select class="form-control" name="urole" id="urole">
                                                <option value="" disabled selected>Select user level...</option>
                                                <option value="1" <?php echo (($result['USR_ACCESS_LEVEL']=='1'))?'selected':'';?> >Admin</option>
                                                <option value="2" <?php echo (($result['USR_ACCESS_LEVEL']=='2'))?'selected':'';?> >Editor</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="">Username</label>
                                            <input class="form-control" type="text" name="usrname" value="<?php echo $result['USR_USERNAME'];?>" readonly>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="">Password</label>
                                            <input class="form-control" type="text" name="upword">
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="">User Status</label>
                                            <select class="form-control" name="status" id="">
                                                <option value="" disabled selected>Select Status...</option>
                                                <option value="1" <?php echo (($result['USR_STATUS']=='1'))?'selected':'';?> >Active</option>
                                                <option value="2" <?php echo (($result['USR_STATUS']=='2'))?'selected':'';?> >Inactive</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-12">
                                            <label for="">About User</label>
                                            <textarea class="form-control" name="aboutuser" id="aboutuser" cols="30" rows="5"><?php echo $result['USR_ABOUT_USER'];?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <!--Module accessibility starts here-->
                                <div class="col-sm-4">
                                    <h4>Module Accessibilty</h4>
                                    <div class="gyn-treeview">
                                        <ul>
											<?php
												$num = 1;
												$usrmenu = $menu->userAccountMenu($result['USR_CODE']);
												$usrroot = (array) json_decode($usrmenu['UMN_ROOT_MENU'],true);
												foreach ($usrroot as $arr) {
													$arroot[] = current($arr);
												}
												$usrsub = (array) json_decode($usrmenu['UMN_SUB_MENU'],true);
												foreach ($usrsub as $sarr) {
													$subarray[] = $sarr['sub'];
												}
												$rootmenu = $menu->init_root_menu();
												foreach($rootmenu as $root){
											?>

                                            <li class="has-children">
                                                <input type="checkbox" id="node-0-<?php echo $num ;?>" name="group-<?php echo $num ;?>" id="group-<?php echo $num ;?>" name="rootmenus[][root]" value="<?php echo $root['RMN_CODE']; ?>" <?php echo((in_array($root["RMN_CODE"], $arroot)))?'checked':'';?>/>
													<label>
														<input type="checkbox" name="rootmenus[][root]" value="<?php echo $root['RMN_CODE']; ?>" <?php echo((in_array($root["RMN_CODE"], $arroot)))?'checked':'';?> /><span></span>
													</label>
													<label for="node-0-<?php echo $num ;?>"><?php echo $root['RMN_NAME'] ;?></label>
                                                <ul>
                                                <?php 
													$smn =1;
													$submenu = $menu->init_sub_menu($root['RMN_CODE']);
													foreach($submenu as $sub){
                                            	?>
                                                    <li>
														<input type="checkbox" id="node-0-<?php echo $smn ;?>-0" name="menubox-<?php echo $smn ;?>" />
														<label>
															<input type="checkbox" value="<?php echo $sub['SMN_CODE']; ?>" name="syscheckbox[][root':'<?php echo $root['RMN_CODE'];?>','sub]" <?php echo((in_array($sub["SMN_CODE"], $subarray)))?'checked':'';?>/><span></span>
														</label>
														<label for="node-0-<?php echo $sub ;?>-0">
														<a href="#0">
															<input type="checkbox" name="syscheckbox[][root':'<?php echo $root['RMN_CODE']?>','sub]" id="menubox" value="<?php echo $sub['SMN_CODE']; ?>" /><?php echo $sub['SMN_NAME']; ?>
														</a>
														</label>
                                                    </li>
                                                    <?php $smn++; }?>
                                                </ul>
                                            </li>
                                            <?php $num++ ; } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>