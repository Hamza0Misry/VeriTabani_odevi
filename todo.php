<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Haftalık Görev Listesi</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .day-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
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
        }

        #save-all:hover {
            background-color: #45a049;
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
    <a href="login.php" style="display: block; margin-top: 20px;">Çıkış Yap</a>
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
