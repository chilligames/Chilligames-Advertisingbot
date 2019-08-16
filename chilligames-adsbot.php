<?php

    $bot_url = 'you'r token here'; //exampel = https://api.telegram.org/bot12345789:AAH0yvEseRaedsRIXlb2v2zSqMiklOu4g

    //-------------------------------------

    $update = file_get_contents("php://input");
    $update_array = json_decode($update, true);
    if( isset($update_array["message"]) ) {

        $text    = $update_array["message"]["text"];
        $caption = $update_array["message"]["caption"];
        $photo   = $update_array["message"]["photo"]["0"]["file_id"];
        $video   = $update_array["message"]["video"]["file_id"];
        $video_caption = $update_array["message"]["caption"];
    }
    
    //-----------------

     if ( isset($update_array["message"]["text"]) ) {
       
       $reply = $GLOBALS["text"];
       $url   = $GLOBALS['bot_url'] . "/sendMessage";
       $_params  =  [
                         'chat_id' => [id group or channel],
                         'text'    => $reply,
                   ];

     }
        elseif (isset($update_array["message"]["photo"])) {
          $url   = $GLOBALS['bot_url'] . "/sendPhoto";
          $_params  = [
                             'chat_id'=>  [id group or channel],
                             'photo' => $GLOBALS['photo'] ,
                             'caption' =>$GLOBALS['caption']
                         ];
        } 
        elseif (isset($update_array["message"]["video"])) {
          
          $url   = $GLOBALS['bot_url'] . "/sendVideo";
          $_params  = [
                             'chat_id'=>  -1001221511857,
                             'video' => $GLOBALS['video'] ,
                             'caption' =>$GLOBALS['video_caption']

                         ];
        }
                  
  //------------------end-----------------------------------------------------//
  
  //---------------------------
     send_reply ( $url, $_params );
 //----------------------------------end--------------------------------------//

    function send_reply($url, $_params) {

        $cu = curl_init();
        curl_setopt($cu, CURLOPT_URL, $url);
        curl_setopt($cu, CURLOPT_POSTFIELDS, $_params);
        curl_setopt($cu, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($cu);
        curl_close($cu);
        return $result;
    }
       
?>
