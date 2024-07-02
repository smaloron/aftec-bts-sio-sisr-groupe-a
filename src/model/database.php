<?php

/**
 * Fonction de connexion à la base de données
 * retourne une instance de PDO
 */
function getPDO(){
    $dataSourceName = "mysql:host=lemp-mariadb-a;dbname=aftec;charset=utf8";
    $dbUser = "devuser";
    $dbPassword = "secret";

    return new PDO ($dataSourceName, $dbUser, $dbPassword);
}
