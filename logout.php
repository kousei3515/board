<?php
session_start();

$_SESSION = [];
header('Location: /board/index.php');
exit;