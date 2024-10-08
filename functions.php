<?php

function setToken() {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function checkToken(){
    if(empty($_SESSION['csrf_token']) || $_SESSION['csrf_token'] !== $_POST['csrf_token']){
        echo 'ユーザー名とパスワードを入力してください',PHP_EOL;
    }
}

function validation($datas, $confirm){

    $errors = [];

    if(empty($datas['name'])){
        $errors['name'] = 'ユーザネームを入力してください';
    }else if(mb_strlen($datas['name'])<6 || mb_strlen($datas['name'])>50){
        $errors['name'] = 'ユーザネームは6文字以上、50文字以内で入力してください';
    }

    

    if(empty($datas['password'])){
        $errors['password'] = 'パスワードを入力してください';
    }
    else if(!preg_match('/\A[a-z\d]{6,}\z/i', $datas['password']) ){   
        $errors['password'] = 'パスワードは6文字以上で英数字入力してください';
    }

    

    if($confirm){
        if(empty($datas['confirm_password'])){
            $errors['confirm_password'] = '確認用パスワードを入力してください';
        }else if($datas['password'] !== $datas['confirm_password']){
            $errors['confirm_password'] = '確認用パスワードが一致しません';
        }
    }

    return $errors;
}

function db_input_create($params, $add_dq){
    $count = 0;
    $str = '';
    foreach(array_keys($params) as $key){
        if ($count > 0) {
            $str .= ',';
        }
        if ($add_dq) {
            $str .= ':';
        }
        $str .= $key;
        $count++;
    }

    return $str;
}