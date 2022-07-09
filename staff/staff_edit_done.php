<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='staff_login.html'>ログイン画面へ</a>";
    exit();
} else {
    print $_SESSION["name"]."さんログイン中";
    print "<br><br>";
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スタッフ修正登録</title>
</head>
<body>
    
<?php
require_once("../common/common.php");

try {
    
    $post = sanitize($_POST);
    $host = DB_HOST;
    $db = DB_NAME;
    $user = DB_USER;
    $password = DB_PASS;
    $code = $post["code"];
    $name = $post["name"];
    $pass = $post["post"];


    $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
    $dbh = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}
?>
</body>
</html>
