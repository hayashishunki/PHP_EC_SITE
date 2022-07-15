<?php

session_start();
session_regenerate_id();
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
    <title>スタッフ詳細</title>
</head>
<body>
    <?php

    require_once("../env.php");

    try {

        $code = $_GET["code"];
        $host = DB_HOST;
        $db = DB_NAME;
        $user = DB_USER;
        $password = DB_PASS;

        $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
        $dbh = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);

        $sql = "SELECT code, name FROM mst_staff WHERE code=?";
        $stmt = $dbh -> prepare($sql);
        $data[] = $code;
        $stmt -> execute($data);

        $dbh = null;

        $rec = $stmt -> fetch(PDO::FETCH_ASSOC);

    }
    catch(Exception $e) {
        print "只今障害が発生しています。<br><br>";
        print "<a href='../staff_login/staff_login.html'>ログイン画面へ</a>";
    }
    ?>

    スタッフ詳細<br><br>
    スタッフコード<br>
    <?php print $rec["code"];?>
    <br><br>
    スタッフネーム<br>
    <?php print $rec["name"];?>
    <br><br>
    <form>
        <input type="button" onclick="history.back()" value="戻る">
    </form>
</body>
</html>
