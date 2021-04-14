<?php 
  namespace manageusers;
  class add extends \setup { 
    function __construct(){
      parent::__construct(); 
    }
    function Init(){
      global $view, $viewpage;
      $sql = $this->sql;
      $usrphoto="default.jpg";
      $actorid = $this->session->get('userid');
      $branchcode = $this->session->get('branchcode');
      $companycode = $this->session->get('companycode');
      
      if($this->engine->validatePostForm($this->microtime)){
        if(!empty($this->keys && $this->keys!='undefined')){
          if(!empty($this->upword)){
            $inputpwd = $this->crypt->loginPassword($this->usrname,$this->upword);
            $stmt = $sql->Execute("UPDATE ".$this->prefix."users SET USR_FIRSTNAME=".$sql->Param('a').",USR_OTHERNAME=".$sql->Param('b').",USR_PASSWORD=".$sql->Param('c').",USR_EMAIL=".$sql->Param('d').",USR_PHONE=".$sql->Param('e').",USR_ACCESS_LEVEL=".$sql->Param('f').",USR_STATUS=".$sql->Param('g').",USR_ACTOR_ID=".$sql->Param('h').",USR_GENDER=".$sql->Param('i').",USR_COUNTRY=".$sql->Param('j').",USR_PHOTO=".$sql->Param('k').",USR_ABOUT_USER=".$sql->Param('l')." WHERE USR_CODE= ".$sql->Param('m')." ",[$this->fname,$this->lname,$inputpwd,$this->uemail,$this->uphone,$this->urole,$this->status,$actorid,$this->gender,$this->country,$usrphoto,$this->aboutuser, $this->keys]);
            print $sql->ErrorMsg();
          }else{
            $stmt = $sql->Execute("UPDATE ".$this->prefix."users SET USR_FIRSTNAME=".$sql->Param('a').",USR_OTHERNAME=".$sql->Param('b').",USR_EMAIL=".$sql->Param('c').",USR_PHONE=".$sql->Param('d').",USR_ACCESS_LEVEL=".$sql->Param('e').",USR_STATUS=".$sql->Param('f').",USR_ACTOR_ID=".$sql->Param('g').",USR_GENDER=".$sql->Param('h').",USR_COUNTRY=".$sql->Param('i').",USR_PHOTO=".$sql->Param('j').",USR_ABOUT_USER=".$sql->Param('k')." WHERE USR_CODE= ".$sql->Param('l')."",[$this->fname,$this->lname,$this->uemail,$this->uphone,$this->urole,$this->status,$actorid,$this->gender,$this->country,$usrphoto,$this->aboutuser, $this->keys]);
            print $sql->ErrorMsg();
          }
          
          if($stmt){
              if(is_array($_POST['syscheckbox']) && is_array($_POST['rootmenus'])){
                $subdata = json_encode($_POST['syscheckbox']);
                $rootdata = json_encode($_POST['rootmenus']);
                $submenulist = str_replace("'",'"',$subdata);
                $sql->Execute("UPDATE ".$this->prefix."user_menu SET UMN_SUB_MENU=".$sql->Param('a').",UMN_ROOT_MENU=".$sql->Param('b').",UMN_ACTOR_CODE=".$sql->Param('c')." WHERE UMN_USR_CODE=".$sql->Param('d')." ",[$submenulist,$rootdata,$actorid, $this->keys]);
                $menuaccessa = array_merge($_POST['syscheckbox'],$_POST['rootmenus']);
                print $sql->ErrorMsg();
            }

            $this->engine->msg('success','System user updated successfully.');
          }else{
            $this->engine->msg('error','Error updtaing record.');
            $view ='edit';
            $viewpage ='edit';
          }
        }else{
          if(!empty($this->fname) && !empty($this->lname) && !empty($this->usrname) && !empty($this->upword) && !empty($this->uphone)){
            //Get user code
            $usrcode = $this->engine->generateCode($this->prefix.'users','USR','USR_CODE'); 
            $actualdate = date('Y-m-d H:i:s');         

            //Check if username is unique
            $stmt = $sql->Execute($sql->Prepare("SELECT USR_USERNAME FROM ".$this->prefix."users WHERE USR_USERNAME = ".$sql->Param('a')." "),array($this->usrname));
            print $sql->ErrorMsg();
            if($stmt && $stmt->RecordCount() == 0){
              //Set Password
              $inputpwd = $this->crypt->loginPassword($this->usrname,$this->upword);

              $sql->Execute("INSERT INTO ".$this->prefix."users (USR_CODE,USR_FIRSTNAME,USR_OTHERNAME,USR_PASSWORD,USR_USERNAME,USR_DATE_ADDED,USR_EMAIL,USR_PHONE,USR_ACCESS_LEVEL,USR_STATUS,USR_ACTOR_ID,USR_BRANCH_CODE,USR_COMPANY_CODE,USR_GENDER,USR_COUNTRY,USR_PHOTO,USR_ABOUT_USER) VALUES(".$sql->Param('a').",".$sql->Param('b').",".$sql->Param('c').",".$sql->Param('d').",".$sql->Param('e').",".$sql->Param('f').",".$sql->Param('g').",".$sql->Param('h').",".$sql->Param('i').",".$sql->Param('j').",".$sql->Param('k').",".$sql->Param('l').",".$sql->Param('m').",".$sql->Param('n').",".$sql->Param('o').",".$sql->Param('p').",".$sql->Param('q').")",[$usrcode,$this->fname,$this->lname,$inputpwd,$this->usrname,$actualdate,$this->uemail,$this->uphone,$this->urole,$this->status,$actorid,$branchcode,$companycode,$this->gender,$this->country,$usrphoto,$this->aboutuser]);
              print $sql->ErrorMsg();

              if(is_array($_POST['syscheckbox']) && is_array($_POST['rootmenus'])){
                  $subdata = json_encode($_POST['syscheckbox']);
                  $rootdata = json_encode($_POST['rootmenus']);
                  $submenulist = str_replace("'",'"',$subdata);
                  $menucode = $this->engine->generateCode($this->prefix.'user_menu','UMN','UMN_CODE'); 
                  $sql->Execute("INSERT INTO ".$this->prefix."user_menu (UMN_CODE,UMN_USR_CODE,UMN_SUB_MENU,UMN_ROOT_MENU,UMN_ACTOR_CODE) VALUES(".$sql->Param('a').",".$sql->Param('b').",".$sql->Param('c').",".$sql->Param('d').",".$sql->Param('e').")",[$menucode,$usrcode,$submenulist,$rootdata,$actorid]);
                  $menuaccessa = array_merge($_POST['syscheckbox'],$_POST['rootmenus']);
                  print $sql->ErrorMsg();
              }

              $this->engine->msg('success','System user saved successfully.');
            }else{
              $this->engine->msg('warning','Username already exists.');
              $view ='add';
            }
            
          }else{
              $this->engine->msg('warning','Required fields cannot be empty.');
              $view ='add';
          }
          return true;
        }
      }
    }
  } 
  ?>