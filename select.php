<?php
$sql = 'SELECT * FROM `users`';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll();