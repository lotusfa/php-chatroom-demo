<?php

$target_dir = "./uploads/";

$type = pathinfo($_FILES["icon_file"]["name"],PATHINFO_EXTENSION);
$target_file = $target_dir . $_POST["username"].".".$type;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

$error_msg = ""; 
$check = getimagesize($_FILES["icon_file"]["tmp_name"]);

if($check !== false) {
    $error_msg = $error_msg." File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
} else {
    $error_msg = $error_msg." File is not an image.";
    $uploadOk = 0;
}

if (!isset($_POST["username"]) || $_POST["username"] == "") {
	$uploadOk = 0;
}

// Check file size
if ($_FILES["icon_file"]["size"] > 500000) {
    $error_msg = $error_msg." Sorry, your file is too large.";
    $uploadOk = 0;
}

$successUpload = false;

if ($uploadOk == 0) {
    $error_msg = $error_msg." Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["icon_file"]["tmp_name"], $target_file)) {
        $error_msg = $error_msg." The file ". basename( $_FILES["icon_file"]["name"]). " has been uploaded.";
        $successUpload = true;
    } else {
        $error_msg = $error_msg." Sorry, there was an error uploading your file.";
    }
}

if ($successUpload) {
	$users_db = "./chat_user.json";
	$jsonString = file_get_contents($users_db);
	$users_arr = json_decode($jsonString, true);
	$users = $users_arr['users'];
	$current_t = time();

	//update users current time 
	if ( isset($_POST["username"]) ) {
		$cur_user = $_POST["username"];
		$users[$cur_user]['last_login'] = $current_t;
		$users[$cur_user]['icon'] = $_POST["username"].".".$type;

		$data = array('users' => $users);
		file_put_contents($users_db, json_encode($data));
	}


}

$jsonMsg = array(
	'status' => $uploadOk,
	'error' => $error_msg,
	'username' => $_POST["username"] );

$newJson = json_encode($jsonMsg );
echo $newJson;

?>