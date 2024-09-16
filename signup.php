
<?php

require_once "db_userinfo_connect.php";
require_once "functions.php";

session_start();


if (!isset($_SESSION['csrf_token'])){
    
    setToken();
}

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
    checkToken();

    $datas = [
        'name' => $_POST['username'],
        'password' => $_POST['password'],
        'confirm_password' => $_POST['confirm_password']
    ];

    $errors = validation($datas, true);

    if (empty($errors['name'])) {
        #取得するViewのsql文
        $sql = "SELECT id FROM user_info WHERE name = :name";
        #sql文から取得される値の保存場所確保, $PDOオブジェクトのprepareメソッドを使用
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue('name', $datas['name'], PDO::PARAM_STR);
        $stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $errors['name'] = '既に同じ名前が登録されています';
        }
    }

    if (empty($errors)) {
        $params = [
            'id' => null,
            'name' => $datas['name'],
            'password' => password_hash($datas['password'], PASSWORD_DEFAULT),
            // 'create_at' => null
        ];

        $columns = db_input_create($params, false);
        $values = db_input_create($params, true);

        $pdo->beginTransaction();
        try {
            $sql = 'insert into user_info ('.$columns.')values('.$values.')';
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $pdo->commit();
            header("location: login.php");
            exit();
        }catch(PDOException $e){
            echo 'ERROR: Could not register in DB'. $e->getMessage();
            $pdo->rollBack();
        }

    }
   
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
</head>
    <body>
        <h1>サインアップ</h1>
       
        
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            
            <div>
                <label>ユーザ名</label><br/>
                <input type="text" name="username">
            </div>
            <div>
                <label>パスワード</label><br/>
                <input type="password" name="password">
            </div>
            <div>
                <label>確認パスワード</label><br/>
                <input type="password" name="confirm_password">
            </div>
            
            <div>
                <br>
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']);?>">
                <input type="submit" >
            </div>
        </form>
            
        
        <p>既に登録済みである場合は<a href="login.php">こちら</a></p>
    </body>
</html>



