<?php
session_start();

require "../model/tasks.php";
require "../model/database.php";

if(! isset($_SESSION["userId"])){
    $_SESSION["message"] = "Vous devez vous authentifier pour accèder à l'espace privé";
    header("location:login.php");
}

$pdo = getPDO();

// Récupération des tâches de l'utilisateur connecté
$taskList = getTasksById($_SESSION["userId"], $pdo);

//gestion de l'ajout de tâche
$errors = handleTaskInsert($pdo);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page sécurisée</title>
    <style>
        .task {
            display: grid;
            grid-template-columns: 50px 1fr;
            vertical-align: top;
        }
        
    </style>

    <script>

        window.onload = function(){
            const doneBoxes = document.querySelectorAll(".task input");
            for(let item of doneBoxes){
                item.addEventListener("change", function(event){
                    const data = {
                        done: event.target.checked,
                        id: event.target.value
                    };
                    console.log(data);
                });
            }
        }
        
    </script>
</head>
<body>
    <h1>Les tâches de <?= $_SESSION["userFullName"] ?></h1>

    <?php include "fragments/_errors.php" ?>

    <div id="form">
        <form method="post">
            <input type="text" name="taskName" placeholder="Votre nouvelle tâche ici">
            <button name="submit">Valider</button>
        </form>
    </div>

    <?php foreach($taskList as $task): ?>
        <div class="task">
            <input type="checkbox" <?=$task["done"]?"checked":"" ?> 
            value="<?= $task["id"] ?>">
            <h4><?= $task["taskname"] ?></h4>
        </div>
    <?php endforeach ?>


    
</body>
</html>