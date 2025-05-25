<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Görev Listem</h2>
    <form method="post">
        <input type="text" name="task" placeholder="Yeni görev ekleyin..." required>
        <button type="submit">Ekle</button>
    </form>

    <ul>
        <li>
            Alışveriş yap
            <span class="delete">✖</span>
        </li>
        <li>
            Ödevleri bitir
            <span class="delete">✖</span>
        </li>
        <li>
            Spor yap
            <span class="delete">✖</span>
        </li>
    </ul>

    <a href="login.php">Çıkış Yap</a>
</div>
</body>
</html>
