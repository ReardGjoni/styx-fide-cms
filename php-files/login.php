<?php

session_start();
require_once "includes/dbConfig.php";

if (!empty($_POST)) {
    
    $mailAndUsername = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    $errors = [];
    if (empty($mailAndUsername) || empty($password)) {
        $errors[] = "Please enter your Username / E-Mail and your Password.";
    } else {
        $sql = "SELECT * FROM usersvet WHERE userName=?;";
        $statement = mysqli_stmt_init($dbConnection);

        if (!mysqli_stmt_prepare($statement, $sql)) {
            $errors[] = "SQL Error bro.";
        } else {
            mysqli_stmt_bind_param($statement, "s", $mailAndUsername);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            
            if ($_row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $_row["pwd"]);
                if (!$pwdCheck) {
                    $errors[] = "Wrong Password."; 
                } else {
                    #session_start();
                    
                    $_SESSION["user_id"] = $_row["id"];
                    $_SESSION["username"] = $_row["userName"];
                    $_SESSION["group_id"] = $_row["group_id"];
                    header("Location: dashboard.php");
                }
            } else {
                $errors[] = "User does not exist.";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="reg.css">
<title>Log In</title>
</head>
<body>
<header>LOG IN</header>

<form id="form" class="topBefore" method="post">
    <?php if (isset($_SESSION["not_logged_in"])): ?>
                <p class="alert alert-warning">You are not logged in(anymore).</p>
                <?php unset($_SESSION["not_logged_in"]); ?>
    <?php endif ?>
        
    <?php if (isset($_SESSION["logout_success"])): ?>
            <p class="alert alert-success">You are now logged out.</p>
            <?php session_destroy(); ?>
    <?php endif ?>
    
    <?php if (isset($_POST) && !empty($errors)): ?>
        <?php foreach($errors as $error): ?>
            <div class="well">
                <p class="alert alert-warning"><?= $error ?></p>
            </div>
        <?php endforeach ?>
    <?php endif ?>

    <input name="username" type="text" placeholder="Username">
    <input style="border-top: none;" name="password" type="password" placeholder="Password">
    <input style="border-top: none;" name="signup-button" id="submit" type="submit" value="GO!">
    
    <?php
    if (isset($_GET['newpwd'])) {
        if ($_GET['newpwd'] == 'passwordupdated') {
            echo "Your Password has been reset.";
        }
    }
    ?>

    <a style="text-decoration: none; color: #B3ACA7; position: relative; top: 30px;" href="reset_password.php">Forgot your password?</a>

</form>
</body>
</html>