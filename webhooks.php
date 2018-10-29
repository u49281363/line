<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'TcPY8ZGaFaIo9WIvLi1A6A60s9ul6a1vKez2mTW9hJG/WNHXyrjm/yOawEQg8uy/o0zut/8zv1ViXB2TzCW3cN5QiKmxHNBr90mfoOXdl8V+cUUMWav7yvTmZtpGHXOsBcEFyVa1FlCUnA5Pd+YXLwdB04t89/1O/w1cDnyilFU=';
//beer
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);

$arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    
    //รับข้อความจากผู้ใช้
    $messageInput = $events['events'][0]['message']['text'];



// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['source']['userId'];
			$userId = $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			if($messageInput=="ลงทะเบียน")
			{
			$messages = [
				'type' => 'text',
				'text' => 'ลงทะเบียนเพื่อเชื่อมต่อ UP Alert ได้ที่ URL นี้ www.dsa.up.ac.th/'.$userId.' กรุณาอย่าเปิดเผย URL นี้ให้ผู้อื่นทราบ'
			];
			}
			else
			{
				$messages = [
				'type' => 'text',
				'text' => ''
				];
			
			}

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
