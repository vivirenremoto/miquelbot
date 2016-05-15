<?php

// configurar token
$botToken = "136953531:AAE6LlHmDlSfIIgc7T-v6Ctkm7-3oh-5RqZ";
$website = "https://api.telegram.org/bot".$botToken;
$content = file_get_contents("php://input");
$update = json_decode($content, TRUE);
$message = $update["message"];
$chatId = $message["chat"]["id"];
$text = $message["text"];
$text = strtolower($text);

// comando que se ejecuta al iniciar conversación con el bot
if( $text == "/start" ){
	$content = "Pregúntame: \n - como te llamas? \n - cuantos años tienes? \n - suma 3 + 2";
	file_get_contents($website."/sendmessage?parse_mode=Markdown&chat_id=" . $chatId . "&text=" . urlencode($content) );
	
}else if( $text == "como te llamas?" ){
	$content = "Miquel";
	file_get_contents($website."/sendmessage?parse_mode=Markdown&chat_id=" . $chatId . "&text=" . urlencode($content) );
	
}else if( $text == "cuantos años tienes?" ){
	$date = new DateTime("02-06-1986");
	$now = new DateTime();
	$interval = $now->diff($date);
	
	$content = sprintf("nací en el 86, tengo %d años", $interval->y);
	file_get_contents($website."/sendmessage?parse_mode=Markdown&chat_id=" . $chatId . "&text=" . urlencode($content) );
	
}else if( stristr($text, "suma") ){
	$q = str_ireplace("suma ", "", $text);
	$total = array_sum( explode( '+', $q ) );
	$content = "la suma es: " . $total;
	file_get_contents($website."/sendmessage?parse_mode=Markdown&chat_id=" . $chatId . "&text=" . urlencode($content) );
	
}