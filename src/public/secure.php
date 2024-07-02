<?php
session_start();

if(! isset($_SESSION["userId"])){
    $_SESSION["message"] = "Vous devez vous authentifier pour accèder à l'espace privé";
    header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page sécurisée</title>
</head>
<body>
    <h1>Vous êtes dans un espace privé</h1>
    
</body>
</html>