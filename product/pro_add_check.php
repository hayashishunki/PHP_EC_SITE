<?php

#session_start();
#session_regenerate_id(true);
#if(isset($_SESSION["login"]) === false) {
#    print "ログインしていません。<br><br>";
#    print "<a href='staff_login.html'>ログイン画面へ</a>";
#    exit();
#} else {
#    print $_SESSION["name"]."さんログイン中";
#    print "<br><br>";
#}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品追加チェック</title>
</head>

<body>
    <?php
    require_once("../common/common.php");

    $post = sanitize($_POST);
    $name = $post["name"];
    $price = $post["price"];
    $gazou = $post["gazou"];
    $comments = $post["comments"];
    $cate = $post["cate"];

    print $cate . "<br><br>";

    if (empty($name) === true) {
        print "商品名が入力されていません。";
    } else {
        print $name;
        print "<br><br>";
    }

    if (preg_match("/\A[0-9]+\z/", $price) === 0) {
        print "正しい値を入力してください。<br><br>";
    } else {
        print $price . "円";
        print "<br><br>";
    }
    ?>
</body>

</html>
