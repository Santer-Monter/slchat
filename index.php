<?php
if (isset($_POST["logout"])) {
    setcookie("userName", "", time() - 1);
}
$userName = "";
if (!isset($_COOKIE['userName'])) {
    header("Location: login.php");
die;
} else {
    $userName = $_COOKIE['userName'];
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?<?=time()?>">
    <title>SLChat</title>
</head>
<body>
    <div class="hello"><p class=>Привет, <?=$userName?>!<br>Ты находишся на сайте SLChat!<br>Добро пожаловать!</div>
    <form action="/" method="post">
        <button name="logout" value="3">Выйти</button>
    </form>
</body>
</html>