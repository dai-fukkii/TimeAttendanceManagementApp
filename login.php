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


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    checkToken();

    $datas = [
        'name' => '',
        'password' => '',
        'confirm_password' => ''
    ];

    foreach ($datas as $key => $value) {
        if ($value = filter_input(INPUT_POST, $key, FILTER_DEFAULT)) {
            $datas[$key] = $value;
        }
    }
    

    $errors = validation($datas, false);

    if (empty($errors)) {
        $sql = "SELECT id, name, password FROM user_info WHERE name= :name";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('name',$datas['name'],PDO::PARAM_STR);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($datas['password'], $row['password'])) {
                session_regenerate_id();
                $_SESSSION['login'] = true;
                $_SESSION['id'] = $row['id'];
                $_SESSION['name'] = $row['name'];
                header("location:my_top.php");
            }
            else {
                $login_err = "ユーザネームもしくはパスワードが間違っています";
            }
        }
        else {
            $login_err = "ユーザネームもしくはパスワードが間違っています";
        }
    }

}


    



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login_signup.css">
</head>
<body>
    <h1>ログイン</h1>
    <?php
        if(!empty($login_err)){
            echo  $login_err;
        }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            
            <div>
                <input type="text" name="name" id="username" placeholder="ユーザ名">
                <br>
            </div>
            <div>
                
                <input type="password" autocomplete="new-password" name="password" id="password" placeholder="パスワード">
                <br>
            </div>
            
            <div>
                <br>
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']);?>">
                <input type="submit" >
            </div>

            <p>登録をしていない方はこちら <a href="signup.php">サインアップ</a></p>
        </form>

        <script src="script/login_signup_animation.js"></script>
</body>
</html>