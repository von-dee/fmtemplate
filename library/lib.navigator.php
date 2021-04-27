<?php
/**
 * This class defines the Navigation class and handles all system
 * page navigation from module to module.
 * Created By: Reggie Gyan
 * Date: 02-09-2019
 */

class Nav extends Engine{
    private  $secretHash ='25c6c7ff35b9979b151f2136cd13b0ff';
    private $encryptionMethod = "AES-256-CBC";
    public function __construct(){
        parent::__construct();
    }

    
    public function activetab($module){
        $url= $this->encodeURL($module);
        return  urldecode($url);
    }

    public function navigate($root,$option=null,$target=null){
        $url = '';
        if($root!==null && $option==null && $target==null){
            $url="index.php?pg=".$this->encodeURL($root);
        }elseif($root!==null && $option!==null && $target==null){
            $url="index.php?pg=".$this->encodeURL($root)."&option=".$this->encodeURL($option);
        }elseif($root!==null && $option!==null && $target!==null){
            $url="index.php?pg=".$this->encodeURL($root)."&option=".$this->encodeURL($option)."&target=".$this->encodeURL($target);
        }
        return $url;
    }
    
    public function nav_switch($pg='',$allowed_modules=[]){
        $result = "dashboard/platform.php";
        if(!empty($pg)){
            $page = $this->decodeURL($pg);
            $path = $page.'/platform.php';
            if(file_exists(dirname(__FILE__).'/../public/'.$path)){
                $result= $path;
            }
        }
        //exit;
        return $result;
    }
    
    public function nav_option($pg,$option=null,$target=null){
        $result = dirname(__FILE__)."../../public/dashboard/platform.php";
        $page = $this->decodeURL($pg);
        if($option!==null && $target==null){
            $pageoptions = $this->decodeURL($option);
            $pathurl = dirname(__FILE__).'/../public/'.$page.'/'.$pageoptions.'/platform.php';
            if(file_exists($pathurl)){
                $result= $pathurl;
            }
        }elseif($option!==null && $target!==null){
            $pageoptions = $this->decodeURL($option);
            $pagetarget = $this->decodeURL($target);
            $path = $pagetarget.'/platform.php';
            if(file_exists(dirname(__FILE__).'/../public/'.$page.'/'.$pageoptions.'/'.$path)){
                $result= $path;
            }
        }
        return $result;
    }
    
    private function encodeURL($textToEncrypt){
        return urlencode(@openssl_encrypt($textToEncrypt, $this->encryptionMethod, $this->secretHash));
    }
    
    private function decodeURL($encryptedMessage){
        return urldecode(@openssl_decrypt($encryptedMessage, $this->encryptionMethod, $this->secretHash));
    }
}

?>