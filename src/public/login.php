<?php
session_start();

require "../model/database.php";
require "../model/users.php";

$pdo = getPDO();


$errors = handleUserLogin($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>

    <style>
        .form-widget {
            display: grid;
            grid-template-columns: 1fr 3fr;
            column-gap: 10px;
            margin-bottom: 10px;
        }

        .form-widget label {
            text-align: right;
        }

        #form {
            width: 50%;
            min-width: 500px;
            margin: 15px auto;
        }

        .message {
            background: #DDAAEE;
            border-radius: 10px;
            text-align: center;
            margin: auto;
            width: 80%;
            padding: 5px;
        }
    </style>
</head>
<body>



<div id="form">

<?php if(isset($_SESSION["message"])): ?>
    <div class="message">
        <?= $_SESSION["message"] ?>
    </div>

    <?php unset($_SESSION["message"]) ?>
<?php endif ?>

    <?php if(count($errors) > 0): ?>
        <h3>Veuillez corriger les erreurs suivantes : </h3>
        <ul>
            <?php foreach($errors as $item): ?>
                <li> <?=$item ?> </li>
            <?php endforeach ?>
        </ul>
    <?php endif ?>

    <div class="form-widget">
        <span></span>
        <h1>Connexion</h1>
    </div>
    <form method="post">
        <div class="form-widget">
            <label for="userName">login</label>
            <input type="text" id="userName" name="userName">
        </div>
        <div class="form-widget">
            <label for="userPass">Mot de passe</label>
            <input type="password" id="userPass" name="userPass">
        </div>
        <div class="form-widget">
            <span></span>
            <button type="submit" name="submit">Valider</button>
        </div>
    </form>
    </div>
    
</body>
</html>