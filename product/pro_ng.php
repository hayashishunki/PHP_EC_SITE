<?php

#session_start();
#session_regenerate_id(true);
#if (isset($_SESSION["login"]) === false) {
#    print "ログインしていません。<br><br>";
#    print "<a href='staff_login.php'>ログイン画面へ</a>";
#    exit();
#} else {
#    print $_SESSION["name"] . "さんログイン中";
#    print "<br><br>";
#}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品選択NG</title>
</head>

<body>

    商品を選択してください<br><br>
    <a href="pro_list.php">商品一覧へ</a>

</body>

</html>