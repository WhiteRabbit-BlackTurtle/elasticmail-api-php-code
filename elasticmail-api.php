<?php

##############################################################################
################################ SEND VIA ELASTICMAIL ################################
##############################################################################

define("ELASTIC_MAIL_API_KEY", "111111111111111111111111111111");
define("ELASTIC_MAIL_API_BASPATH", "https://api.elasticemail.com/v2/");
define("ELASTIC_MAIL_SEND_MAIL_ENDPOINT", ELASTIC_MAIL_API_BASPATH . "email/send");
define("ELASTIC_MAIL_EMAIL_STATUS_ENDPOINT", ELASTIC_MAIL_API_BASPATH . "email/status?apiKey=" . ELASTIC_MAIL_API_KEY);

function send_mail_apiA($postTo, $postTitle, $postContent, $postCC='', $postReplyTo='', $postFrom=''){

    if($postReplyTo==""){
        $postReplyTo = "name@email.com";
    }

    if($postFrom==""){
        $postFrom = "name@email.com";
    }
    
    $postData = [
        "from"            => $postFrom,
        "apikey"          => ELASTIC_MAIL_API_KEY,
        "isTransactional" => false,
        "subject"         => $postTitle,
        "to"              => $postTo,
        "replyTo"         => $postReplyTo,
        "bodyText"        => $postContent,
        "bodyHtml"        => $postContent,
        "charset"         => "utf-8",
    ];

    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL            => ELASTIC_MAIL_SEND_MAIL_ENDPOINT,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $postData,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
        CURLOPT_SSL_VERIFYPEER => false
    ]);

    $result  = json_decode(curl_exec($ch));
    curl_close($ch);

    return $result;

}


?>