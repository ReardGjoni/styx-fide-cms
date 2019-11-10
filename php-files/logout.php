<?php 

session_start();

$_SESSION["logout_success"] = true;

unset($_SESSION["user_id"]);
unset($_SESSION["group_id"]);


header("Location: login.php");