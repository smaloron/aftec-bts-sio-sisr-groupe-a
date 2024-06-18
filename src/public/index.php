<?php

    // Connexion à la base de données
    $dataSourceName = "mysql:host=lemp-mariadb-a;dbname=aftec;charset=utf8";
    $dbUser = "devuser";
    $dbPassword = "secret";

    $pdo = new PDO($dataSourceName, $dbUser, $dbPassword);


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

    


    // Exécution d'une requête sur la base de données
    $query = $pdo->query("SELECT * FROM persons");

    // Récupération des données
    $data = $query->fetchAll(PDO::FETCH_ASSOC);


    $now =  date('d/m/Y h:i:s');
    $names = ["Siobhan", "Saoirse", "Niamh", "Maedhbh"];

    $person = [
        "name" => "Brahé",
        "firstName" => "Tycho",
        "profession" => "Astronome"
    ];

    $personList = [
        ["name" => "Tycho Brahé", "gender" => "masculin"],
        ["name" => "Olympe de Gouges", "gender" => "féminin"],
        ["name" => "Georges Sand", "gender" => "féminin"],
        ["name" => "Alexandre Grothendieck", "gender" => "masculin"]
    ];

    /*
    foreach($names as $item){
        echo "<p> $item </p>";
    }
    */
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premiére page PHP</title>
    <style>
        .lady {
            background-color: #FF22AA;
        }

        .gent {
            background-color: #22AAFF;           
        }
    </style>
</head>
<body>
    <h2>Liste des noms</h2>
    <ul>
        <?php foreach($names as $item): ?>
            <li> <?= $item; ?> </li>
        <?php endforeach; ?>
    </ul>

    <h2>Fiche d'une personne </h2>

    <table>
        <?php foreach ($person as $key => $item): ?>
        <tr>
            <td><?= $key; ?></td>
            <td><?= $item; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <table>
        <thead>
        <tr>
            <th>Nom</th>
            <th>Genre</th>

        </tr>
        </thead>
        <tbody>
            <?php foreach($personList as $item): ?>
                <tr class="<?=$item["gender"]== "féminin"?"lady":"gent"; ?>">
                    <td><?= $item["name"]; ?></td>
                    <td><?= $item["gender"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2> Liste des personnes de la BD </h2>


    <h3>Nouvelle personne</h3>
    <div>
        <form method="post">
            <div>
                <label>Nom</label>
                <input type="text" name="personName" 
                value="<?=isset($editedPerson)?$editedPerson["person_name"]:""?>">
            </div>

            <div>
                <input type="radio" name="gender" value="féminin" id="radioF" 
                <?=isset($editedPerson) && $editedPerson["gender"]=="féminin"?"checked":""?> >
                <label for="radioF">Femme</label>

                <input type="radio" name="gender" value="masculin" id="radioM"
                <?=isset($editedPerson) && $editedPerson["gender"]=="masculin"?"checked":""?> 
                >
                <label for="radioM">Homme</label>
            </div>
            <input type="hidden" name="id" 
            value="<?=isset($editedPerson)? $editedPerson["id"]: "" ?>">
            <button type="submit" name="submit">Valider</button>

        </form>
    </div>


    <table>
        <thead>
        <tr>
            <th>Nom</th>
            <th>Genre</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($data as $item): ?>
                <tr class="<?=$item["gender"]== "féminin"?"lady":"gent"; ?>">
                    <td><?= $item["person_name"]; ?></td>
                    <td><?= $item["gender"]; ?></td>
                    <td>
                        <form method="post" onsubmit="return confirm('Voulez vous vraiment supprimer')">
                            <button type="submit" name="delete">Supprimer</button>
                            <input type="hidden" name="id" value="<?=$item["id"];?>">
                        </form>
                    </td>

                    <td>
                        <form method="post">
                            <button type="submit" name="edit">Modifier</button>
                            <input type="hidden" name="id" value="<?=$item["id"];?>">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</body>
</html>




