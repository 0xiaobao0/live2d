<?php
//获得聊天
$appkey = '9bfa939a996d4bada1bd542cc9802faa'; //你的appkey
$talkContent = "";
$info=addslashes($_POST['info']);
$userid=addslashes($_POST['userid']);
//$info=addslashes('哈哈');
//$userid=addslashes('asd');
$jsondata = array(
        "reqType" => 0,
        "perception" => array(
            "inputText" => array(
                "text" => $info
            ),
            "inputImage" => array(
                "url" => ''
            ),
            "selfInfo" => array(
                "location" => array(
                    "city" => '',
                    "province" => '',
                    "street" => ''
                )
            )
        ),
        "userInfo" => array(
            "apiKey" => $appkey,
            "userId" => $userid
        )
    );
$jsondata = json_encode($jsondata);

//使用方法
function http_post_json($url, $jsonStr)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($jsonStr)
        )
    );
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return array($httpCode, $response);
}
$url = 'http://openapi.tuling123.com/openapi/api/v2';


if($appkey==""){
    $talkContent = '{"code":"500","text":"我还没学会聊天功能，快和站长联系吧！"}';
}
else{
    list($returnCode, $contnt) = http_post_json($url, $jsondata);
    $talkContent = $contnt;
}
header('Content-type:text/json');
echo $talkContent;
?>