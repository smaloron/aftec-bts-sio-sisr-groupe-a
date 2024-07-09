<?php
require "../model/database.php";
require "../model/tasks.php";

$done = filter_input(INPUT_POST, "done", FILTER_DEFAULT);
$id = filter_input(INPUT_POST, "id", FILTER_DEFAULT);

var_dump($id, $done);

$done = $done=="true"?true:false;

updateTaskById($id, $done, getPDO());

?>