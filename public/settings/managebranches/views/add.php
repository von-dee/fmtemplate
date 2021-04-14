<div class="page-managebranches">
    <div class="panel-title"></div>
    <div class="card" shadow>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-filled" padding>
                        <div class="panel-title">
                            <?php echo ((isset($keys) && $keys!='undefined'))? '<h5>Edit Branch</h5>':'<h5>Add Branch</h5>';?>
                            <div class="panel-right">
                                <?php if(isset($keys) && $keys!='undefined'){?>
                                <button type="button" class="btn btn-success" onclick="push({'view':'','viewpage':'update','keys':'<?php echo $keys;?>'})"><i class="la la-check"></i> Update</button>
                                <?php }else{ ?>
                                <button type="button" class="btn btn-success" onclick="push({'view':'','viewpage':'add','payload':'<?php echo $payload;?>'})"><i class="la la-check"></i> Save</button>
                                <?php }?>

                                <button type="button" class="btn btn-danger" onclick="push({'view':'','viewpage':''})"><i class="la la-close"></i> Cancel</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card-body">
                                    <div class="profile-photo row">
                                        <img id="profile" src="#" alt="photo" onError="this.src='theme/assets/img/placeholder.jpg'">
                                    </div>
                                    <h4>Company Logo</h4>
                                </div>
                            </div>

                            <div class="col-sm-8">
                                <div class="card" shadow>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel panel-filled" padding>
                                                    <input type="hidden" name="pagepageid" id="pagepageid">
                                                    <div class="panel-body" margin-top>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="compname">Name</label>
                                                                    <input type="text" class="form-control" name="compname" id="compname" value="<?php echo (is_object($result) ? '' :  $result['BRA_NAME'] ); ?>" placeholder="">
                                                                    <small id="helpId" class="form-text text-muted">eg. Nframa Limited</small>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="compphone">Phone Number</label>
                                                                    <input type="text" class="form-control" name="compphone" id="compphone" value="<?php echo (is_object($result) ? '' :  $result['BRA_PHONE'] ); ?>" placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="compemail">E-mail</label>
                                                                    <input type="text" class="form-control" name="compemail" id="compemail" value="<?php echo (is_object($result) ? '' :  $result['BRA_EMAIL'] ); ?>" placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="compraddress">Residential
                                                                        Address</label>
                                                                    <input type="text" class="form-control" name="compraddress" id="compraddress" value="<?php echo (is_object($result) ? '' :  $result['BRA_RES_ADDRESS'] ); ?>" placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="comppaddress">Postal Address</label>
                                                                    <input type="text" class="form-control" name="comppaddress" id="comppaddress" value="<?php echo (is_object($result) ? '' :  $result['BRA_POST_ADDRESS'] ); ?>" placeholder="">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="compcountry">Country</label>
                                                                    <select class="form-control selector" name="compcountry" id="compcountry">
                                                                        <option value="" disabled selected>Select
                                                                            country...</option>
                                                                        <?php 
                                                                            $nation = $engine->getcountries();
                                                                            foreach($nation as $country){
                                                                        ?>
                                                                        <option
                                                                            <?php echo is_object($result) ? '' : ($result['BRA_COUNTRY'] == $country['CNT_CODE'] ? 'selected':'');?>
                                                                            value="<?php echo $country['CNT_CODE'];?>">
                                                                            <?php echo $country['CNT_NAME'];?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="compregion">Region</label>
                                                                    <select class="form-control selector" name="compregion" id="compregion">
                                                                        <option value="" disabled selected>Select
                                                                            region...</option>
                                                                        <?php 
                                                                            $regions = $engine->getregions();
                                                                            foreach($regions as $reg){
                                                                        ?>
                                                                        <option
                                                                            <?php echo is_object($result) ? '' : ($result['BRA_REGION'] == $reg['REG_CODE'] ? 'selected':'');?>
                                                                            value="<?php echo $reg['REG_CODE'];?>">
                                                                            <?php echo $reg['REG_NAME'];?></option>
                                                                        <?php } ?>
                                                                    </select>

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="compcity">City</label>
                                                                    <input type="text" class="form-control"
                                                                        name="compcity" id="compcity"
                                                                        value="<?php echo (is_object($result) ? '' :  $result['BRA_CITY'] ); ?>"
                                                                        placeholder="">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="compsince">Date Since</label>
                                                                    <input <?php echo (is_object($result) ? 'type="date"' :  ($result['BRA_SINCE'] ? 'type="text"':'type="date"') ); ?> class="form-control"
                                                                        name="compsince" id="compsince"
                                                                        value="<?php echo (is_object($result) ? '' :  $result['BRA_SINCE'] ); ?>"
                                                                        placeholder="">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="compseats">Seats</label>
                                                                    <input type="number" class="form-control"
                                                                        name="compseats" id="compseats"
                                                                        value="<?php echo (is_object($result) ? '' :  $result['BRA_SEATS'] ); ?>"
                                                                        placeholder="">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="compstatus">Status</label>
                                                                    <select class="form-control selector"
                                                                        name="compstatus" id="compstatus">
                                                                        <option
                                                                            <?php echo is_object($result) ? '' : ($result['BRA_STATUS']=='1' ? 'selected':'');?>
                                                                            value="1">Inactive</option>
                                                                        <option
                                                                            <?php echo is_object($result) ? '' : ($result['BRA_STATUS']=='2' ? 'selected':'');?>
                                                                            value="2">Active</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 form-group">
                                                                <label for=""> Services Offered</label> <br>
                                                                <div class="service-block">
                                                                <?php 
                                                                    if(!is_object($result)){
                                                                        $bracode = $result['BRA_CODE'];
                                                                        $services = $engine->get_branch_services($bracode);
                                                                        foreach ($services as $key => $value) {
                                                                            $serve[] = $value['code'];
                                                                        }
                                                                    }
                                                                    $services = $engine->get_company_services($companycode);
                                                                    foreach($services as $key => $se){
                                                                ?>
                                                                    <label class="checkbox-inline checkbox-cool">
                                                                        <input type="checkbox" name="comp_services[]" <?php  echo(!empty($serve) && in_array($se['code'],$serve))?'checked="true"':''?> value="<?php echo $se['code'].','.$se['name'];?>"/><?php echo $se['name'];?>
                                                                    </label>
                                                                <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>