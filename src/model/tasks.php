<?php

function getTasksById(int $id, PDO $pdo){
    $sql = "SELECT * FROM tasks WHERE user_id = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$id]);
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function handleTaskInsert(PDO $pdo){
    $isPosted = filter_has_var(INPUT_POST, "submit");
    $errors = [];

    if($isPosted){
        $taskName = filter_input(INPUT_POST, "taskName", FILTER_SANITIZE_SPECIAL_CHARS);

        if(trim($taskName) == ""){
            array_push($errors, "La tâche ne peut être vide");
        }

        if(count($errors) == 0){
            $sql = "INSERT INTO tasks (taskname, user_id) VALUES (?, ?)";
            $query = $pdo->prepare($sql);
            $query->execute([$taskName, $_SESSION["userId"]]);

            header("location:secure.php");
        }
    }

    return $errors;
}