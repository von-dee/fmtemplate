<?php include SPATH_THEME.DS.'header.php';?> 
  <?php include SPATH_THEME.DS.'navigation.php'; $token= generateFormToken();?> 

    <form name="myform" id="myform" method="post" action="#" data-toggle="validator" role="form"
    enctype="multipart/form-data" autocomplete="off">
        <input id="view" name="view" value="" type="hidden" />
        <input id="viewpage" name="viewpage" value="" type="hidden" />
        <input id="keys" name="keys" value="<?php echo (!empty($keys)?$keys:'') ;?>" type="hidden" />
        <input id="ekeys" name="ekeys" value="<?php echo (!empty($ekeys)?$ekeys:'') ;?>" type="hidden" />
        <input id="newkeys" name="newkeys" value="<?php echo $keys;?>" type="hidden" />
        <input id="data" name="data" value="" type="hidden" />
        <input id="action_search" name="action_search" value="" type="hidden" />
        <input id="microtime" name="microtime" value="<?php echo md5(microtime()); ?>" type="hidden" /> 
        <input id="token" name="token" value="<?php echo $token ; ?>" type="hidden" />  

        <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
            <div class="containers">
                <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                    <?php
        
                        $viewpage ?? '';
                        $prefix = WEB_DB_PREFIX;
                        $userid = $session->get('userid');
                        $fullname = $session->get('userfullname');
                        $firstname = $session->get('userfirstname');
                        $accesslevel = $session->get('useraccesslevel'); 
                        $branchcode = $session->get('branchcode');
                        $companycode = $session->get('companycode');
                        $companytype = $session->get('companytype');

                        if(empty($limit)){
                            $limit = 20;
                        }
            
                        include ($nav->nav_switch($pg));
                        $session->set($pg.'_token', $token);  
                    ?>
                </div>
            </div>
        </div>

    </form>
  
<?php include SPATH_THEME.DS.'footer.php';?> 

    