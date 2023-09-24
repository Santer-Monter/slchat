<?php
if (isset($_COOKIE['userName'])) {
    header("Location: /");
}  
$message = "";
$users = [
    ["name" => "Александр", "login" => "SLChat", "password" => "1305"],
    ["name" => "Santer", "login" => "Santer", "password" => "fgegrgthr"],
    ["name" => "NeSanter", "login" => "NeSanter", "password" => "qwert"],
    ["name" => "Test", "login" => "Test", "password" => "Test"]
];



if (isset($_POST["login"]) && isset($_POST["password"])) {
    $login = $_POST["login"];
    $password = $_POST["password"];
}

if (!empty($login) && !empty($password)) {
    foreach ($users as $user) {
        if ($user["login"] == $login && $user["password"] == $password) {
            setcookie("userName", $user["name"], time() + 60 * 60 * 24);
            header("location: /");
            die;
        }
    }
    $message = "Логин или пароль не правильны или не существует! Повторите попытку!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form class="login_form" action="login.php" method="POST">
    <label for="login">Login</label>
        <input type="text" name="login">
    <label for="password">Password</label>
        <input type="text" name="password">
        <input type='submit' value='login'>
        <div class="message"><?=$message?></div>
    </forn>
</body>
</html>