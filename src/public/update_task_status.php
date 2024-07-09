<?php
require "../model/database.php";
require "../model/tasks.php";

$done = filter_input(INPUT_GET, "done", FILTER_DEFAULT);
$id = filter_input(INPUT_GET, "id", FILTER_DEFAULT);

var_dump($_GET, $_POST);

$done = $done=="true"?true:false;


    updateTaskById($id, $done, getPDO());

    echo json_encode(["done" => $done, "id"=> $id]);
 


?>