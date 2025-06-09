<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Haftalık Görev Listesi</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background-image: url('https://images.unsplash.com/photo-1517245386807-bb43f82c33c4');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            backdrop-filter: brightness(0.8);
            color: #fff;
            min-height: 100vh;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            background: rgba(0, 0, 0, 0.85);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
        }

        .container h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .day-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 30px;
        }

        .day-box {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .day-box h3 {
            margin-top: 0;
            color: #333;
        }

        .task-input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .task-list {
            list-style: none;
            padding-left: 0;
        }

        .task-list li {
            margin-bottom: 5px;
            background-color: #e9ecef;
            padding: 6px 10px;
            border-radius: 6px;
            color: #000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .delete {
            color: red;
            margin-left: 10px;
            cursor: pointer;
        }

        #save-all {
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #4CAF50;
            border: none;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        #save-all:hover {
            background-color: #45a049;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Haftalık To-Do List</h2>

    <div class="day-container">
        <?php
        $days = ["Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi", "Pazar"];
        foreach ($days as $day) {
            echo "
            <div class='day-box' data-day='{$day}'>
                <h3>{$day}</h3>
                <input type='text' class='task-input' placeholder='Görev ekle...'>
                <ul class='task-list'></ul>
            </div>";
        }
        ?>
    </div>

    <button id="save-all">🖫 Tümünü Kaydet</button>
    <a href="login.php">Çıkış Yap</a>
</div>

<script>
    const dayBoxes = document.querySelectorAll(".day-box");
    const saveButton = document.getElementById("save-all");

    window.onload = function() {
        dayBoxes.forEach(box => {
            const day = box.dataset.day;
            const ul = box.querySelector(".task-list");
            const saved = JSON.parse(localStorage.getItem("tasks_" + day)) || [];
            saved.forEach(task => {
                addTaskToDay(ul, task);
            });
        });
    };

    dayBoxes.forEach(box => {
        const input = box.querySelector(".task-input");
        const ul = box.querySelector(".task-list");

        input.addEventListener("keypress", function(e) {
            if (e.key === "Enter") {
                e.preventDefault();
                const text = input.value.trim();
                if (text) {
                    addTaskToDay(ul, text);
                    input.value = "";
                }
            }
        });

        ul.addEventListener("click", function(e) {
            if (e.target.classList.contains("delete")) {
                e.target.parentElement.remove();
            }
        });
    });

    function addTaskToDay(ul, text) {
        const li = document.createElement("li");
        li.textContent = text;
        const del = document.createElement("span");
        del.textContent = "✖";
        del.className = "delete";
        li.appendChild(del);
        ul.appendChild(li);
    }

    saveButton.addEventListener("click", function() {
        dayBoxes.forEach(box => {
            const day = box.dataset.day;
            const tasks = [];
            box.querySelectorAll(".task-list li").forEach(li => {
                tasks.push(li.childNodes[0].nodeValue.trim());
            });
            localStorage.setItem("tasks_" + day, JSON.stringify(tasks));
        });
        alert("Tüm görevler kaydedildi!");
    });
</script>
</body>
</html>
