<?php
$DBSERVER = 'localhost';
$DBNAME = 'board';
$DBUSER = 'board'; //作成したユーザー名
$DBPASSWD = 'pw'; //作成したユーザーのパスワード
$dsn = "mysql:host={$DBSERVER};dbname={$DBNAME};charset=utf8";
$pdo = new \PDO($dsn, $DBUSER, $DBPASSWD, array(\PDO::ATTR_EMULATE_PREPARES => false));
