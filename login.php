<?php
//Начало скрипта
require "config.php";



if (isset($_COOKIE['userName'])) {
    header("Location: /");
}  
$message = "";
$users0 = [
    ["name" => "SLChat", "login" => "SLChat", "password" => "1305"],
    ["name" => "Александр_Картавцев", "login" => "Santer", "password" => "qwert12345QWE"],
    ["name" => "NeSanter", "login" => "NeSanter", "password" => "qwert"],
    ["name" => "Test", "login" => "Test", "password" => "Test"]
];



if (isset($_POST["login"]) && isset($_POST["password"])) {
    $login = $_POST["login"];
    $password = $_POST["password"];
}

if (!empty($login) && !empty($password)) {
    $sql = "SELECT * FROM users WHERE `login` = '" . $login . "'";
    echo $sql;
    $user = $db->query($sql)->fetch();
    if (!empty ($user) && password_verify($password, $user["password"])) {
        setcookie("userName", $user["name"], time() + 60 * 60 * 24);
        header("location: /");
        die;
    }
    $message = "Логин или пароль не правильны или не существует! Повторите попытку!";
}
//Конец скрипта
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?<?=time()?>">
    <title>Login</title>
</head>
<body>
    <form class="login_form" action="login.php" method="POST">
    <div><p class = "login_text">Войдите</p></div>
    <label for="login">Логин</label>
        <input type="text" name="login"><br><br>
    <label for="password">Пароль</label>
        <input type="text" name="password"><br><br>
        <input type='submit' value='login'>
        <div class="message"><?=$message?></div>
    </form>
    <a href="register.php">Зарегистрируйся!</a>
</body>
</html>