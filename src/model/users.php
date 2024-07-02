<?php

function handleUserRegistration($pdo){
    // Initialisation du tabmeau des erreurs
    $errors = [];

    // Les données ont elles été postées
    $isPosted = filter_has_var(INPUT_POST, "submit");

    if($isPosted){
        // Récupération des saisies
        $userName = filter_input(INPUT_POST, "userName", FILTER_SANITIZE_SPECIAL_CHARS);
        $userFullName = filter_input(
            INPUT_POST, 
            "userFullName", 
            FILTER_SANITIZE_SPECIAL_CHARS);
        $userPass = filter_input(
                INPUT_POST, 
                "userPass", 
                FILTER_DEFAULT);
        $userPassConfirm = filter_input(
                    INPUT_POST, 
                    "userPassConfirm", 
                    FILTER_DEFAULT);

        // Validation des saisies
        if(trim($userName) == ""){
            array_push($errors, "Le login ne peut être vide");
        }
        if(trim($userFullName) == ""){
            array_push($errors, "Le nom d'utilisateur ne peut être vide");
        }

        if(trim($userPass) == ""){
            array_push($errors, "Le mot de passe ne peut être vide");
        } else if($userPass != $userPassConfirm){
            array_push($errors, "Le mot de passe et sa confirmation doivent être identiques");
        }

        // Le formulaire est valide on peut insérer les données
        if(count($errors) == 0){
            $sql = "INSERT INTO users (username, userfullname, userpass) VALUES (?,?,?)";
            $query = $pdo->prepare($sql);
            $query->execute([
                $userName, $userFullName, 
                password_hash($userPass, PASSWORD_DEFAULT)
            ]);

            // Enregistrement d'un message dans la session 
            // Pour pouvoir le lire dans la page login.php
            $_SESSION["message"] = "Vous êtes inscrit, vous pouvez désormais vous connecter";

            header("location:login.php");
        }
    }
    return $errors;
}