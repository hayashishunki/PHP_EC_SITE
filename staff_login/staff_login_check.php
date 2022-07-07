<?php
//データベース参照、前ページで入力したcode,pass一致でログイン
require_once("../common/common.php");
require_once("../env.php");
try {

    $host = DB_HOST;
    $db = DB_NAME;
    $user = DB_USER;
    $password = DB_PASS;

    $post = sanitize($_POST);
    $code = $post["code"];
    $pass = $post["pass"];

    $pass = md5($pass);

    $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
    $dbh = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $sql = "SELECT name FROM mst_staff WHERE code=? AND password=?";
    $stmt = $dbh->prepare($sql);
    $data[] = $code;
    $data[] = $pass;
    $stmt->execute($data);

    $dbh = null;
    $rec = $stmt->fetch(PDO::FETCH_ASSOC); //カラム名のみ

    if (empty($rec["name"]) === true) {
        print "入力が間違っています。<br><br>";
        print "<a href='staff_login.html'>戻る</a>";
        exit();
    } else {
        //ログイン成功session IDを付与
        session_start();
        $_SESSION["login"] = 1;
        $_SESSION["name"] = $rec["name"];
        $_SESSION["coda"] = $code;
        header("Location:staff_login_top.php");
        exit();
    }
} catch (Exception $e) {
    print "只今障害が発生しております。";
    print "<a href='staff_login.html>戻る</a>";
}
