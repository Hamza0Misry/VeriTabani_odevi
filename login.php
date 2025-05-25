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
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .error {
            color: red;
            margin-top: 5px;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Giriş Yap</h2>
    <form method="post" id="login-form">
        <input type="text" name="username" placeholder="Kullanıcı Adı" required>
        <input type="password" name="password" placeholder="Şifre" id="password" required>
        <div class="error" id="password-error"></div>
        <button type="submit">Giriş</button>
    </form>
    <a href="register.php">Hesabınız yok mu? Kayıt olun</a>
</div>

<script>
    const form = document.getElementById("login-form");
    const passwordInput = document.getElementById("password");
    const errorDiv = document.getElementById("password-error");

    form.addEventListener("submit", function(e) {
        const password = passwordInput.value;
        const hasUppercase = /[A-Z]/.test(password);

        if (password.length < 5 || !hasUppercase) {
            e.preventDefault();
            errorDiv.textContent = "Şifre en az 5 karakter olmalı ve en az 1 büyük harf içermelidir.";
        } else {
            errorDiv.textContent = "";
        }
    });
</script>
</body>
</html>
