<?php
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
   <form action="register.html" method="post">
     <label>メールアドレス: <input type="email" name="mail"/></label><br/>
     <label>パスワード: <input type="password" name="password"/></label><br/>
     <label>名前: <input type="text" name="name"/></label><br/>
     <input type="submit" value="新規登録">
   </form>
 </div>
 </body>
 </html