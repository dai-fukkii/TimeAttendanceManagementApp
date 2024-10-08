<?php

    session_start();

    if ($_SESSION['login'] == true) {
        header('location:login.php');
    }

    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mytop</title>
</head>
<body>
    <a href="logout.php">ログアウト</a>
    <p>現在の状況</p>
    <p>出勤or退勤or休憩</p>
    <p>何時間経っているか</p>

    <p>出勤、退勤、休憩、休憩終了ボタン</p>
</body>
</html>