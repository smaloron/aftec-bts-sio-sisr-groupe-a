<?php
    session_start();

    // Inclusion de la connexion à la base données
    require "../model/database.php";

    require "../model/persons.php";

    // Connexion à la base de données
    $pdo = getPDO();

    handlePersonDelete($pdo);

    handlePersonEdit($pdo);

    handlePersonInsert($pdo);

    
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

        <nav>
            <?php if(isset($_SESSION["userId"])): ?>
                <h3>Bonjour <?=$_SESSION["userFullName"] ?> </h3>
                <a href="logout.php">Déconnexion</a>

            <?php else : ?>
            <ul>
                <li>
                    <a href="register.php">Inscription</a>
                </li>
                <li>
                    <a href="login.php">Connexion</a>
                </li>
            </ul>
            <?php endif ?>
        </nav>
        

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




