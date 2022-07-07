<?php

//session_start();
//session_regenerate_id(true);
//if(isset($_SESSION["login"]) === false) {
//    print "ログインしていません。<br><br>";
//    print "<a href='staff_login.html'>ログイン画面へ</a>";
//    exit();
//} else {
//    print $_SESSION["name"]."さんログイン中";
//    print "<br><br>";
//}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>スタッフ追加実行</title>
</head>

<body>
    <?php

    require_once("../env.php");
    require_once("../common/common.php");

    $host = DB_HOST;
    $db = DB_NAME;
    $user = DB_USER;
    $password = DB_PASS;

    $post = sanitize($_POST);
    $name = $post["name"];
    $pass = $post["pass"];

    $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

    try {
        $dbh = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $sql = "INSERT INTO mst_staff(name, password) VALUES(?, ?)";
        $stmt = $dbh->prepare($sql);
        $data[] = $name;
        $data[] = $pass;
        $stmt->execute($data);
        //切断
        $dbh = null;
    } catch (Exception $e) {
        echo "DB接続エラー".$e->getMessage();

    }
    ?>

    スタッフを追加しました。<br><br>
    <a href="staff_list.php">スタッフ一覧へ</a>

</body>

</html>
