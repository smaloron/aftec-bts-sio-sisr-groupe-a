<?php
session_start();
unset($_SESSION["userId"]);
unset($_SESSION["userFullName"]);

session_regenerate_id(true);

header("location:index.php");
