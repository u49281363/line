<?php



require "vendor/autoload.php";

$access_token = 'TcPY8ZGaFaIo9WIvLi1A6A60s9ul6a1vKez2mTW9hJG/WNHXyrjm/yOawEQg8uy/o0zut/8zv1ViXB2TzCW3cN5QiKmxHNBr90mfoOXdl8V+cUUMWav7yvTmZtpGHXOsBcEFyVa1FlCUnA5Pd+YXLwdB04t89/1O/w1cDnyilFU=';

$channelSecret = 'a206adcff0ab5fc50dc7693371569bdd';

$pushID = $_GET['UID'];
$MSG = $_GET['MSG']

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($MSG);
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







