<div class="page-managecompany">
    <div class="panel-title">
        <h5>Manage Company</h5>
        <div class="panel-right">
            <button type="button" class="btn btn-dark" onclick="push({'view':'','viewpage':''})"><i
                    class="la la-arrow-left"></i> Back</button>
        </div>
    </div>
   
    <div class="card company" shadow>
        <div class="card-body row">
            <div class="col-sm-3">
                <div class="profile-photo-sm row">
                    <img id="profile"
                        src="<?php echo (is_object($result) ? '' :  'uploads/brands/'.$result['COMP_BRAND'] );?>"
                        alt="photo" onError="this.src='theme/assets/img/placeholder.jpg'">
                </div>
            </div>
            <div class="col-sm-9">
                <div class="row top-space">
                    <div class="col-sm-6">
                        <div class="divTable">
                            <div class="divTableBody">
                                <div class="divTableRow">
                                    <div class="divTableCell bold">Name:</div>
                                    <div class="divTableCell"><?php echo $result['COMP_NAME'];?></div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell bold">E-mail:</div>
                                    <div class="divTableCell"><?php echo $result['COMP_EMAIL'];?></div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell bold">Office Address:</div>
                                    <div class="divTableCell"><?php echo $result['COMP_RES_ADDRESS'];?></div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell bold">Country:</div>
                                    <div class="divTableCell"><?php echo $result['COMP_COUNTRY'];?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="divTable">
                            <div class="divTableBody">
                                <div class="divTableRow">
                                    <div class="divTableCell bold">Alias:</div>
                                    <div class="divTableCell"><?php echo $result['COMP_ALIAS'];?></div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell bold">Phone No:</div>
                                    <div class="divTableCell"><?php echo $result['COMP_PHONE'];?></div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell bold">Postal Address:</div>
                                    <div class="divTableCell"><?php echo $result['COMP_POST_ADDRESS'];?></div>
                                </div>
                                <div class="divTableRow">
                                    <div class="divTableCell bold">TIN:</div>
                                    <div class="divTableCell"><?php echo $result['COMP_TIN_NUMBER'];?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card services" shadow>
        <div class="card-body row ">
            <div class="col-sm-3 tabs">
                <a href="<?php echo $nav->navigate('settings','wallet').'&keys='.$result['COMP_CODE'];?>" class="btn btn-default ">
                <i class="la la-wallet"></i> Walet</a>
            </div>
            <div class="col-sm-2 tabs">
                <a href="<?php echo $nav->navigate('settings','users').'&keys='.$result['COMP_CODE'];?>" class="btn btn-default ">
                <i class="la la-users"></i> Manage User</a>
            </div>
            <div class="col-sm-2 tabs">
                <a href="<?php echo $nav->navigate('settings','managebranches').'&keys='.$result['COMP_CODE'];?>" class="btn btn-default ">
                <i class="la la-building"></i> Branches</a>
            </div>
            <div class="col-sm-2 tabs">
                <a href="<?php echo $nav->navigate('settings','logevents').'&keys='.$result['COMP_CODE'];?>" class="btn btn-default ">
                <i class="la la-clipboard-list"></i> Log Events</a>
            </div>
            <div class="col-sm-2 tabs">
                <a href="<?php echo $nav->navigate('settings','reports').'&keys='.$result['COMP_CODE'];?>" class="btn btn-default ">
                <i class="la la-business-time"></i> Reports</a>
            </div>
        </div>
    </div>
</div>