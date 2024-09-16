<?php
require_once "db_userinfo_connect.php";
require_once "functions.php";

session_start();

if(isset($_SESSION['login'])&&$_SESSION['login'] === true){
    header("location: my_top.php");
    exit();
}



$login_err = "";

if (!isset($_SESSION['csrf_token'])){
    setToken();
}

###### if リクエストメソッドがpostの時、tokencheck, login

$datas = [
    'name' => '',
    'password' => '',
    'confirm_ssword' => ''
];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <p>ログイン</p>
    <p>テストテスト</p>
</body>
</html>