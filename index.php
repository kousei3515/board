<?php
session_start();

$message = '';
try {
    $DBSERVER = 'localhost';
    $DBUSER = 'board';
    $DBPASSWD = 'boardpw';
    $DBNAME = 'board';

    $dsn = 'mysql:'
        . 'host=' . $DBSERVER . ';'
        . 'dbname=' . $DBNAME . ';'
        . 'charset=utf8';
    $pdo = new PDO($dsn, $DBUSER, $DBPASSWD, array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (Exception $e) {
    $message = "接続に失敗しました: {$e->getMessage()}";
}
$sql = 'SELECT * FROM `boards`';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$boardList = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>トップ</title>
</head>
<body>
<header>
    <div>
        <a href="/board/index.php">TOP</a>
        <a href="/board/create_board.php">掲示板作成</a>
        <a href="/board/register.php">新規作成</a>
        <a href="/board/login.php">ログイン</a>
        <a href="/board/logout.php">ログアウト</a>
    </div>
    <h1>トップ</h1>
</header>
<div>
    <?php echo "{$_SESSION['name']}さんようこそ"; ?>
</div>
<div>
    掲示板一覧
    <ul>
        <?php
        foreach ($boardList as $board) {
            echo "<li><a href='/board/board.php?id={$board['id']}'>{$board['title']}（{$board['created']}）</a></li>";
        }
        ?>
    </ul>
</div>
</body>
</html>