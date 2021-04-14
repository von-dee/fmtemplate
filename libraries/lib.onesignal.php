<?php
class OneSignal{
    private $app_url;
    private $app_id;
    private $api_key;

    public function __construct(){ 
        global $api_key,$app_id,$app_url;
        $this->app_url = "https://onesignal.com/api/v1/notifications";
        $this->app_id = "GET APP ID FROM ONESIGNAL";
        $this->api_key = "GET API KEY FROM ONESIGNAL";
    }

    public function sendMessage($message,$data=null,$picture=null){
        $content = array(
            "en" => $message
        );
    
        $fields = array(
            'app_id' => $this->app_id,
            'included_segments' => array('All'),
            'data' => $data, //-> must send an array -eg. array("foo" => "bar");
            'small_icon' => "https://crataa.com/web/assets/img/onesignal_default.png",
            'large_icon' => "https://crataa.com/web/assets/img/logo.png",
            'big_picture' => $picture,
            'contents' => $content
        );
    
        $fields = json_encode($fields);
        //print("\nJSON sent:\n");
        //print($fields);
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->app_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8','Authorization: Basic '.$this->api_key));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        return $response;
    }

    public function sendMessageToUser($playerid,$message,$data=null,$picture=null){
        $content = array(
            "en" => $message
        );
    
        $fields = array(
            'app_id' => $this->app_id,
            'data' => $data, //-> must send an array -eg. array("foo" => "bar");
            'include_player_ids' => array( $playerid ),
            'small_icon' => "https://crataa.com/web/assets/img/onesignal_default.png",
            'large_icon' => "https://crataa.com/web/assets/img/logo.png",
            'big_picture' => $picture,
            'contents' => $content
        );
    
        $fields = json_encode($fields);
        //print("\nJSON sent:\n");
        //print($fields);
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->app_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8','Authorization: Basic '.$this->api_key));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        return $response;
    }
    
}

?>