<?php
$sql = 'INSERT INTO `users` (name, mail, password, created, modified)';
$sql .= ' VALUES (:name, :mail, :password, NOW(), NOW())';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, \PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, \PDO::PARAM_STR);
$stmt->bindValue(':password', $password, \PDO::PARAM_STR);
$stmt->execute();
