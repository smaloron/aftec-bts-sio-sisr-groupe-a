<?php

function handlePersonDelete($pdo){
    // Test pour savoir si on a cliqué sur un bouton 
    // dont l'attribut name est égal à "delete" 
    $isDelete = filter_has_var(INPUT_POST, "delete");
    if($isDelete){
        // Récupération de l'id à supprimer
        $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

        // Requête de suppression
        $sql = "DELETE FROM persons WHERE id=?";
        $query = $pdo->prepare($sql);
        $query->execute([$id]);

        header("location:index.php");
    }
}

function handlePersonEdit($pdo){
    // Test pour savoir si on a cliqué sur un bouton 
    // dont l'attribut name est égal à "delete" 
    $isEdit = filter_has_var(INPUT_POST, "edit");

    if($isEdit){
        // Récupération de l'id à modifier
        $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

        // Récupération des infos de la personne à modifier
        $sql = "SELECT * FROM persons WHERE id = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$id]);

        $editedPerson = $query->fetch(PDO::FETCH_ASSOC);

        //var_dump($person["person_name"]);

    }
}

function handlePersonInsert($pdo){
    // Test pour savoir si les données ont été postées
    $isPosted = filter_has_var(INPUT_POST, "submit");

    // Si les données sont postées alors on traite le formmulaire
    if($isPosted){
        // Récupération de la saisie
        $name = filter_input(INPUT_POST, "personName", FILTER_SANITIZE_SPECIAL_CHARS);
        $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_SPECIAL_CHARS);
        $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

        // Validation de la saisie
        // On part du principe que la saisie est valide 
        $isValid = true;
        // Si le nom est vide la saisie est invalide
        if(trim($name) == ""){
            $isValid = false;
        // Sinon si le genre est l'un des deux attendus
        } else if($gender != "masculin" && $gender != "féminin"){
            $isValid = false;
        }

        // Les données sont récupérées et validées
        // on peut donc enregistrer dans la base de données
        if($isValid){

            if(empty($id)){
                // Les paramètres de la requête sont remplacés par des ?
                $sql = "INSERT INTO persons (person_name, gender) VALUES (?,?)";
                // Préparation de la requête
                $query = $pdo->prepare($sql);
                // Exécution de la requête
                $query->execute([$name, $gender]);
            } else {
                // Les paramètres de la requête sont remplacés par des ?
                $sql = "UPDATE persons SET person_name=? , gender=? WHERE id = ?";
                // Préparation de la requête
                $query = $pdo->prepare($sql);
                // Exécution de la requête
                $query->execute([$name, $gender, $id]);
            }
            
            // Redirection vers la page pour sortir de la méthode post
            header("location:index.php");
        }
    }
}