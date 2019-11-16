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

// 入力が全て入っていたらユーザーを作成する
if(!empty($_POST['title'])) {
    $title = $_POST['title'];

    $sql = 'INSERT INTO `boards` (title, created, modified)';
    $sql .= ' VALUES (:title, NOW(), NOW())';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':title', $title, \PDO::PARAM_STR);
    $result = $stmt->execute();
    if($result) {
        $message = '掲示板を作成しました';
        // 作成したら掲示板ページにリダイレクトします
        header('Location: /board/board.php?id=' . $pdo->lastInsertId());
        exit;
    } else {
        $message = '作成に失敗しました';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>掲示板作成</title>
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
    <h1>掲示板作成</h1>
</header>
<div>
    <div style="color: red">
        <?php echo $message; ?>
    </div>
    <form action="create_board.php" method="post">
        <label>タイトル: <input type="text" name="title"/></label><br/>
        <input type="submit" value="掲示板作成">
    </form>
</div>
</body>
</html>