<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    header("Location: todo.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Ol</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Kayıt Ol</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Kullanıcı Adı" required>
        <input type="password" name="password" placeholder="Şifre" required>
        <button type="submit">Kayıt Ol</button>
    </form>
    <a href="login.php">Zaten bir hesabınız var mı? Giriş yap</a>
</div>
</body>
</html>
