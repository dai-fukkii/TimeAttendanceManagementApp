<?php 

    session_start();

    $_SESSION = array();

    session_destroy();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>logout</title>
</head>
<body>
    <p>ログアウト完了</p>
    <a href="login.php">ログインページに戻る</a>
</body>
</html>