<?php

$users_db = "./chat_user.json";
$chats_db = "./chat_msg.json";

$status = 0;
if ( isset ( $_GET["username"]) &&  $_GET["username"] != "" 
	&& isset ( $_GET["msg"]) &&  $_GET["msg"] != "" 
	&& isset ( $_GET["color"]) &&  $_GET["color"] != "" ){

	$status = 1;

	$jsonString = file_get_contents($chats_db);
	$msg_arr = json_decode($jsonString, true);
	$chats = $msg_arr['chats'];

	$chat = array(
		'name' => $_GET["username"],
		'color' => $_GET["color"] ,
		'msg' => $_GET["msg"]  );

	array_push( $chats, $chat );
	$data = array('chats' => $chats);
	file_put_contents($chats_db, json_encode($data));
}


$msg = array(
	'status' => $status
);

$newJson = json_encode($msg );
echo $newJson;
?>
