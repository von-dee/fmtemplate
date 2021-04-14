<div class="page-managecompany">
    <div class="card" shadow>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-filled" padding>
                        <div class="panel-title">
                            <?php echo ((isset($keys) && $keys!='undefined'))? '<h5>Edit Company</h5>':'<h5>Add Company</h5>';?>
                            <div class="panel-right">
                                <?php if(isset($keys) && $keys!='undefined'){?>
                                <button type="button" class="btn btn-success"
                                    onclick="push({'view':'','viewpage':'update','keys':'<?php echo $keys;?>'})"><i
                                        class="la la-check"></i>
                                    Update</button>
                                <?php }else{ ?>
                                <button type="button" class="btn btn-success"
                                    onclick="push({'view':'','viewpage':'add'})"><i class="la la-check"></i>
                                    Save</button>
                                <?php }?>
                                <button type="button" class="btn btn-danger"
                                    onclick="push({'view':'','viewpage':''})"><i class="la la-close"></i>
                                    Cancel</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="profile-photo row">
                                            <img id="profile"
                                                src="<?php echo (is_object($result) ? '' :  'uploads/brands/'.$result['COMP_BRAND'] );?>"
                                                alt="photo" onError="this.src='theme/assets/img/placeholder.jpg'">
                                            <input type="file" name="compimage" id="compimage" hidden>
                                            <input type="text" name="oldphoto" id="oldphoto"
                                                value="<?php echo (is_object($result) ? '' :  $result['COMP_BRAND'] ); ?>"
                                                hidden>
                                        </div>
                                        <div class="edit"> <span><i class="la la-camera"></i> Edit</span></div>
                                        <h4>Company Logo</h4>
                                        <small>600 x 600 px</small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel panel-filled" padding>
                                                    <input type="hidden" name="pagepageid" id="pagepageid">
                                                    <div class="panel-body" margin-top>
                                                        <div class="row">
                                                            <div class="col-sm-10">
                                                                <div class="form-group">
                                                                    <label for="compname">Name</label>
                                                                    <input type="text" class="form-control"
                                                                        name="compname" id="compname"
                                                                        value="<?php echo (is_object($result) ? '' :  $result['COMP_NAME'] ); ?>"
                                                                        placeholder="">
                                                                    <small id="helpId" class="form-text text-muted">eg.
                                                                        Nframa
                                                                        Limited</small>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label for="compalias">Alias</label>
                                                                    <input type="text" class="form-control"
                                                                        name="compalias" maxlength="3" id="compalias"
                                                                        value="<?php echo (is_object($result) ? '' :  $result['COMP_ALIAS'] ); ?>"
                                                                        placeholder="">
                                                                    <small id="helpId" class="form-text text-muted">eg.
                                                                        JTX</small>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="compphone">Phone Number</label>
                                                                    <input type="text" class="form-control"
                                                                        name="compphone" id="compphone"
                                                                        value="<?php echo (is_object($result) ? '' :  $result['COMP_PHONE'] ); ?>"
                                                                        placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="compemail">E-mail</label>
                                                                    <input type="text" class="form-control"
                                                                        name="compemail" id="compemail"
                                                                        value="<?php echo (is_object($result) ? '' :  $result['COMP_EMAIL'] ); ?>"
                                                                        placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="compraddress">Residential
                                                                        Address</label>
                                                                    <input type="text" class="form-control"
                                                                        name="compraddress" id="compraddress"
                                                                        value="<?php echo (is_object($result) ? '' :  $result['COMP_RES_ADDRESS'] ); ?>"
                                                                        placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="comppaddress">Postal Address</label>
                                                                    <input type="text" class="form-control"
                                                                        name="comppaddress" id="comppaddress"
                                                                        value="<?php echo (is_object($result) ? '' :  $result['COMP_POST_ADDRESS'] ); ?>"
                                                                        placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="compcountry">Country</label>
                                                                    <select class="form-control selector"
                                                                        name="compcountry" id="compcountry">
                                                                        <option value="" disabled selected>Select
                                                                            country...</option>

                                                                        <?php $countries = $engine->countries(); 
                                                                            foreach ($countries as $country) { ?>
                                                                        <option
                                                                            <?php echo is_object($result) ? '' : ($result['COMP_COUNTRY'] == $country['CNT_CODE'] ? 'selected':'');?>
                                                                            value="<?php echo $country['CNT_CODE']; ?>">
                                                                            <?php echo $country['CNT_NAME']; ?></option>
                                                                        ';
                                                                        <?php } ?>
                                                                    </select>

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="comptin">TIN Number</label>
                                                                    <input type="text" class="form-control"
                                                                        name="comptin" id="comptin"
                                                                        value="<?php echo (is_object($result) ? '' :  $result['COMP_TIN_NUMBER'] ); ?>"
                                                                        placeholder="">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-3">
                                                                <div class="form-group">
                                                                    <label for="compstatus">Status</label>
                                                                    <select class="form-control selector"
                                                                        name="compstatus" id="compstatus">
                                                                        <option
                                                                            <?php echo is_object($result) ? '' : ($result['COMP_STATUS']=='1' ? 'selected':'');?>
                                                                            value="1">Inactive</option>
                                                                        <option
                                                                            <?php echo is_object($result) ? '' : ($result['COMP_STATUS']=='2' ? 'selected':'');?>
                                                                            value="2">Active</option>
                                                                    </select>
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

<script>
    $('.edit').on('click', function () {
        $('#compimage').click();
    });
    $("#compimage").change(function () {
        document.getElementById('profile').src = window.URL.createObjectURL(this.files[0])
    });
</script>