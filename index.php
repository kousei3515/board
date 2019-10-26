<?php
  session_start();
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
         <a href="/board/register.php">新規作成</a>
         <a href="/board/login.php">ログイン</a>
         <a href="/board/logout.php">ログアウト</a>
     </div>
     <h1>トップ</h1>
 </header>
 <div>
     <?php echo "{$_SESSION['name']}さんようこそ"; ?>
 </div>
 </body>
 </html>