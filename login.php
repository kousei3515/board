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
if(!empty($_POST['mail']) && !empty($_POST['password'])) {
    $mail = $_POST['mail'];
    $password = $_POST['password'];

    $sql = 'SELECT * FROM `users` WHERE mail = :mail AND password = :password';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':mail', $mail, \PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, \PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch();
    if(!empty($user)) {
        $message = 'ログインしました';
        $_SESSION['id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['mail'] = $user['mail'];
        $_SESSION['password'] = $user['password'];
    } else {
        $message = 'ログインに失敗しました';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
</head>
<body>
<header>
    <div>
        <a href="/board/index.php">TOP</a>
        <a href="/board/register.php">新規作成</a>
        <a href="/board/login.php">ログイン</a>
        <a href="/board/logout.php">ログアウト</a>
    </div>
    <h1>ログイン</h1>
</header>
<div>
    <div style="color: red">
        <?php echo $message; ?>
    </div>
    <form action="login.php" method="post">
        <label>メールアドレス: <input type="email" name="mail"/></label><br/>
        <label>パスワード: <input type="password" name="password"/></label><br/>
        <input type="submit" value="ログイン">
    </form>
</div>
</body>
</html>