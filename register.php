<?php
require_once 'config.php';
$error = [];
$message = "";
$confirm_password = "";
$password = "";
$email = "";
$name = "";
$login = "";


if (isset($_POST["name"])){
    $name = $_POST["name"];
}
if (isset($_POST["login"])){
    $login = $_POST["login"];
} 
if (empty($login)) {
    $error[] = "Пожалуйста, введите логин!";
}

if (isset($_POST["password"])){
    $password = $_POST["password"];
} 
if(empty($password)) {
    $error[] = "Пожалуйста, введите пароль!";
}

if (isset($_POST["confirm_password"])){
    $confirm_password = $_POST["confirm_password"];
} 
if (empty($confirm_password)) {
    $error[] = "Пожалуйста, подтвердите пароль!";
}



if (isset($_POST["email"])){
    $email = $_POST["email"];
} 
if(empty($email)) {
    $error[] = "Пожалуйста, введите email!";
} if ($password != $confirm_password)
$error[] = "Пароль и подтверждения не совпадают";

if (empty($error)) {
    $sqlselect = "SELECT `login`, `email` FROM users WHERE login = '" . $login . "' OR `email` = '" . $email . "'";
    $anyUser = $db->query($sqlselect)->fetch();
    if (!empty($anyUser)) {
        if (!empty($anyUser["login"]) && $anyUser["login"] == $login){
            $message = "Такой логин уже есть!";
        } else if (!empty($anyUser["email"]) && $anyUser["email"] == $email) {
            $message = "Такой email уже есть!";
        }
    } else {
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, login, password, email) VALUES ('" . $name . "', '" . $login . "', '" . $pass . "', '" . $email . "')";
        $db->query($sql);
        header("Location: login.php");
    }
} elseif (!empty($_POST)){
    foreach ($error as $item) {
        $message .= $item . "<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css?<?=time()?>">
</head>
<body>
    <form class="login_form" action="register.php" method="POST">
        <div><p class = "login_text">Зарегестрируйся</p></div>
        <label for="name">Имя</label>
        <input type="text" name="name"><br><br>
        <label for="login">Логин</label>
        <input type="text" name="login"><br><br>
        <label for="password">Пароль</label>
        <input type="text" name="password"><br><br>
        <label for="confirm_password">Повторите Пароль</label>
        <input type="text" name="confirm_password"><br><br>
        <label for="email">Email</label>
        <input type="email" name="email"><br><br>
        <input type='submit' value='Register'>
        <div class="message"><?=$message?></div>
    </form>
    <a href="login.php">Войдите!</a>
</body>
</html>