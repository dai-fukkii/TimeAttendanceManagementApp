<?php

const DB_NAME = 'mysql:dbname=time_attendance_management;host=localhost';
const DB_USER = 'root';
const DB_PASS = 'daichi39';

try {

    $pdo = new PDO(DB_NAME, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);

} catch(PDOException $e){
    echo 'データベースへの接続ができません'.$e -> getMessage();
}