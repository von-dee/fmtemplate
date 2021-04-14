<?php
@define('USER_FNAME',$ufname);
@define('USER_LNAME',$ulname);
@define('USER_EMAIL',$uemail);
@define('USER_PHONE_NUM',$uphoneno);
@define('USER_NAME',$uname);
@define('USER_PASSWORD',$pwd);

    class Register{
        private $engine;
        private $connect;
        private $session;
        private $redirect;
        public $prefix = WEB_DB_PREFIX;
        function __construct(){
            global $sql,$session,$engine;
            $this->engine = $engine;
            $this->redirect ="index.php?action=register";
            $this->session	= $session;
            $this->connect = $sql;
            $this->crypt = new Crypt();
            $this->register();
            
        }

        function register(){
            if(USER_NAME != "" && USER_PASSWORD != "" && USER_FNAME != "" && USER_LNAME != ""){
                $date_added = date('Y-m-d H:i:s');
                $usrcode = $this->generateCode($this->prefix.'users','USR','USR_CODE');
                $passwrd = $this->crypt->loginPassword(USER_NAME,USER_PASSWORD);
            
                if($usrcode && $passwrd){
                    $stmt = $this->connect->Prepare("INSERT INTO ".$this->prefix."users (USR_CODE,USR_FIRSTNAME,USR_OTHERNAME,USR_EMAIL,USR_PHONE,USR_USERNAME,USR_PASSWORD,USR_DATE_ADDED) VALUES(?,?,?,?,?,?,?,?)");
                    $stmt = $this->connect->Execute($stmt,array($usrcode,USER_FNAME,USER_LNAME,USER_EMAIL,USER_PHONE_NUM,USER_NAME,$passwrd,$date_added));
                    if($stmt == true){
                        $this->action = 'login';
                    }else{
                        // $this->direct("generate");
                    }
                }else{
                    // $this->direct("codes");
                }
            }else{
                // $this->direct("empty");
                $this->action = 'register';
            }
            exit;
        }

        ### Generate Sequential Codes 
        public function generateCode(String $table,String $prefix,String $base_col){
            global $sql;
            $no_prec = 10;#Maximum number of preceding Zeros;
            $stmt = $sql->Execute($sql->Prepare("SELECT $base_col FROM  $table ORDER BY RIGHT ($base_col,$no_prec) DESC LIMIT 1"));
            if($stmt->RecordCount() > 0){
                $obj = $stmt->FetchNextObject();
                $rawcount = substr($obj->$base_col,strlen($prefix),100);
                $rawcount = $rawcount + 1;
                $multiplier = $no_prec - strlen($rawcount);
                $multiplier = $multiplier <=0 ? 0 : $multiplier ;
                $code = str_repeat("0",$multiplier) . $rawcount;
            }else{
                $code = str_repeat("0",$no_prec-1) . 1;
            }
        
            return $prefix.$code;
        }

        // public function direct($direction=''){
            
        //     if($direction == 'empty'){
        //         header('Location: ' . $this->redirect.'&attempt_in=0');
        //     }else if($direction == 'success'){
        //         header('Location: index.php?action=index');
        //     }else if($direction == 'codes'){
        //         header('Location: ' .$this->redirect.'&attempt_in=1');
        //     }else if($direction == 'generate'){
        //         header('Location: ' .$this->redirect.'&attempt_in=120');
        //     }else{
        //         header('Location: index.php?action=register');
        //     }
        //     exit;
        // }
    }
?>