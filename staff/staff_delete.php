<?php

session_start();
session_regenerate_id(true);
if (isset($_SESSION["login"]) === false) {
    print "ログインしていません。<br><br>";
    print "<br><br>";
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
    <link rel="stylesheet" href="style.css">
    <title>スタッフ削除確認画面</title>
</head>

<body>
    <?php

    require_once("../env.php");

    $host = DB_HOST;
    $db = DB_NAME;
    $user = DB_USER;
    $password = DB_PASS;

    try {

        $code = $_GET["code"];

        $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
        $dbh = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);

        $sql = "SELECT code, name FROM mst_staff WHERE code=?";
        $stmt = $dbh -> prepare($sql);
        $data[] = $code;
        $stmt->execute($data);

        $dbh = null;

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        print "只今障害が発生しております。<br><br>";
        print "<a href='../staff_login/staff_login.html'>ログイン画面へ";
    }
    ?>

    スタッフ詳細<br><br>
    スタッフコード<br>
    <?php print $rec["code"] ?>
    <br><br>
    スタッフネーム<br>
    <?php print $rec["name"] ?>
    <br><br>
    上記情報を削除しますか？<br><br>
    <form action="staff_delete_done.php" method="post">
        <input type="hidden" name="code" value="<?php print $rec['code']; ?>">
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
    </form>
</body>

</html>
