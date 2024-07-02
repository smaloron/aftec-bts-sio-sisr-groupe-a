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
    }


    return $errors;
}