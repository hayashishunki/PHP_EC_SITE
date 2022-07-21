<?php

session_start();
session_regenerate_id(true);
if (isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<a href='staff_login.html'>ログイン画面へ</a>";
    exit();
} else {
    print $_SESSION["name"] . "さんログイン中";
    print "<br><br>";
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品修正実行</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php

    require_once("../env.php");
    require_once("../common/common.php");

    try {
        $host = DB_HOST;
        $db = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;

        $post = sanitize($_POST);
        $code = $post["code"];
        $name = $post["name"];
        $price = $post["price"];
        $gazou = $post["gazou"];
        $old_gazou = $post["old_gazou"];
        $comments = $post["explanation"];
        $cate = $post["cate"];

        if (empty($gazou) && isset($old_gazou) === true) {
            $gazou = $old_gazou;
        }

        if ($old_gazou != "" or $gazou != $old_gazou) {
            unlink("./gazou/" . $old_gazou);
        }

        $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
        $dbh = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $sql = "UPDATE mst_product SET category=?, name=?, price=?, gazou=?, explanation=? WHERE code=?";
        $stmt = $dbh->prepare($sql);
        $data[] = $cate;
        $data[] = $name;
        $data[] = $price;
        $data[] = $gazou;
        $data[] = $comments;
        $data[] = $code;
        $stmt->execute($data);

        $dbh = null;
    } catch (Exception $e) {
        print "只今障害が発生しております。<br><br>";
        print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
        echo $e;
    }
    ?>

    商品を修正しました。<br><br>
    <a href="pro_list.php">スタッフ一覧へ</a>
</body>

</html>
