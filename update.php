<?php

$users_db = "./chat_user.json";
$chats_db = "./chat_msg.json";

if (! isset ( $_GET["username"]) || $_GET["username"] == "" ) $cur_user = null;
else $cur_user = $_GET["username"];

$jsonString = file_get_contents($chats_db);
$msg_arr = json_decode($jsonString, true);
$chats = $msg_arr['chats'];

$jsonString = file_get_contents($users_db);
$users_arr = json_decode($jsonString, true);
$users = $users_arr['users'];

$current_t = time();
$time_down_lim = $current_t - 3;
$time_up_lim = $current_t + 3;

//update users current time 
if ($cur_user != null && isset($users[$cur_user]['last_login'])) {
	$users[$cur_user]['last_login'] = $current_t;

	$data = array('users' => $users);
	file_put_contents($users_db, json_encode($data));
}

$online_users = array();
foreach ($users as $key => $value){

	$last_l_time = $value['last_login'];
	if ($last_l_time > $time_down_lim &&  $last_l_time < $time_up_lim) {
		$x = $users[$key];
		$x['username'] = $key;
		array_push( $online_users, $x );
	}
}

$new_arr = array(
	'current_user' => $cur_user,
	'current_time' => $current_t,
	'chats' => $chats,
	'online_users' => $online_users 
);

$newJson = json_encode($new_arr );
echo $newJson;
?>
