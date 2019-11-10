<?php

error_reporting(0);

if (isset($_POST["signup-button"])) {
    require "includes/dbConfig.php";
    
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $username = trim($username);

    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $email = trim($email);

    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    $passwordRe = filter_var($_POST["passwordRe"], FILTER_SANITIZE_STRING);

    $termsOfService = filter_var($_POST["terms"], FILTER_SANITIZE_STRING);
    $errors = [];


    if (strlen($username) < 5) {
        $errors[] = "Your Username should contain at least 5 characters.";
    }
    
    if (!$email) {
        $errors[] = "Your E-Mail is invalid.";
    }
    
    if (strlen($password) < 6) {
        $errors[] = "Your password should contain at least 6 characters.";
    }
    
    if ($password !== $passwordRe) {
        $errors[] = "Both passwords should be identical.";
    }
    
    if (!$termsOfService) {
        $errors[] = "Please accept our Terms of Service.";
    } else {
        /*$sql = "INSERT INTO usersvet (userName, email, password) VALUES
                        ('" . $username . "', '" . $email . "', '" . $hashedPwd . "')";
                        
            if (!mysqli_query($dbConnection, $sql)) {
                die(mysqli_error($dbConnection));*/
        $sql = "SELECT pwd FROM usersvet WHERE userName=?";
        $statement = mysqli_stmt_init($dbConnection);
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        password_verify($password, $hashedPwd);

            if (!mysqli_stmt_prepare($statement, $sql)) {
                $errors[] = "Sql Error.";
            } else {
                mysqli_stmt_bind_param($statement, "s", $username);
                mysqli_stmt_execute($statement);
                mysqli_stmt_store_result($statement);
                $resultCheck = mysqli_stmt_num_rows($statement);

                // Prüfen, ob email schon vorhanden
                $checkEmail = mysqli_query($dbConnection, "SELECT email FROM usersvet WHERE email = '" . $email . "'");

                if (mysqli_num_rows($checkEmail)) {
                    $errors[] = "Email already in use.";
                } else if ($resultCheck > 0) {
                    $errors[] = "User already taken.";
                } else {
                    $sql = "INSERT INTO usersvet (group_id, userName, email, pwd)
                                                VALUES (1, ?, ?, ?);";
                    $statement = mysqli_stmt_init($dbConnection);

                    if (!mysqli_stmt_prepare($statement, $sql)) {
                        $errors[] = "SQL Error.";
                    } else {
                        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                        mysqli_stmt_bind_param($statement, "sss", $username, $email, $hashedPwd);
                        mysqli_stmt_execute($statement);
                        mysqli_stmt_store_result($statement);
                    }
                }
            }
        }
        mysqli_stmt_close($statement);
        mysqli_close($dbConnection);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="reg.css">
<title>Sign Up</title>
</head>
<body>
<header>SIGN UP</header>

    <form id="form" class="topBefore" method="post">
        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $error): ?>
            <div class="well">
                <p class="alert alert-warning"><?= $error ?></p>
            </div>
            <?php endforeach ?>
        <?php endif ?>

        <?php if (!empty($_POST) && empty($errors)): ?>
            <div class="well">
                <p class="alert alert-success">Sign Up successful. You can now login <a href="login.php" style="text-decoration:none; color: green;">here</a>.</p>
            </div>
        <?php endif ?>
                
        <input name="username" type="text" placeholder="Username">
        <input name="email" type="text" placeholder="E-Mail">
        <input name="password" type="password" placeholder="Password">
        <input name="passwordRe" type="password" placeholder="Repeat Password">
        <input  name="terms" id="checkbox" type="checkbox">
        <label class="forCheck" for="checkbox">Terms of Service</label>
        <input name="signup-button" id="submit" type="submit" value="GO!">

        <p>Already have an Account? Log In <a href="login.php" style="text-decoration:none; color: white;">here</a></p>
    </form>
</body>
</html>