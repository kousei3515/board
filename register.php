
<?php
session_start()

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
 if(!empty($_POST['name']) && !empty($_POST['mail']) && !empty($_POST['password'])) {
     $name = $_POST['name'];
     $mail = $_POST['mail'];
     $password = $_POST['password'];

     $sql = 'INSERT INTO `users` (name, mail, password, created, modified)';
     $sql .= ' VALUES (:name, :mail, :password, NOW(), NOW())';
     $stmt = $pdo->prepare($sql);
     $stmt->bindValue(':name', $name, \PDO::PARAM_STR);
     $stmt->bindValue(':mail', $mail, \PDO::PARAM_STR);
     $stmt->bindValue(':password', $password, \PDO::PARAM_STR);
     $result = $stmt->execute();
     if($result) {
         $message = 'ユーザーを作成しました';
         $_SESSION['id'] = $pdo->lastInsertId();
         $_SESSION['name'] = $name;
         $_SESSION['mail'] = $mail;
         $_SESSION['password'] = $password;
     } else {
       $message = '登録に失敗しました';
     }
 }

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <title>新規作成</title>
 </head>
 <body>
 <header>
   <div>
     <a href="/board/index.php">TOP</a>
     <a href="/board/register.php">新規作成</a>
     <a href="/board/login.php">ログイン</a>
     <a href="/board/logout.php">ログアウト</a>
   </div>
   <h1>新規作成</h1>
 </header>
 <div>
   <div style="color: red">
     <?php echo $message; ?>
   </div>
   <form action="register.php" method="post">
     <label>メールアドレス: <input type="email" name="mail"/></label><br/>
     <label>パスワード: <input type="password" name="password"/></label><br/>
     <label>名前: <input type="text" name="name"/></label><br/>
     <input type="submit" value="新規登録">
   </form>
 </div>
 </body>
 </html>