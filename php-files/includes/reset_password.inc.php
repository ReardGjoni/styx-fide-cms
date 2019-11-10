<?php

if (isset($_POST['reset_password_submit'])) {
    
    $selector = $_POST['selector'];
    $validator = $_POST['validator'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];
    $errors = [];

    if (empty($password) || empty($passwordRepeat)) {
        header("Location: login.php");
        exit();
    } else if ($password != $passwordRepeat) {
        $errors[] = "Both passwords should be identical.";
    }

    $currentDate = date("U");

    require_once "dbConfig.php";

    $sql = "SELECT * FROM pwdreset
            WHERE pwdResetSelector = ?
            AND pwdResetExpires >= ?;";
    $stmt = mysqli_stmt_init($dbConnection);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $errors[] = "There was an error.";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (!$row = mysqli_fetch_assoc($result)) {
            $errors[] = "You need to re-submit your reset request.";
            exit();
        } else {

            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row['pwdResetToken']);

            if ($tokenCheck === false) {
                $errors[] = "You need to re-submit your reset request.";
                exit();
            } elseif ($tokenCheck === true) {
                $tokenEmail = $row['pwdResetEmail'];
                $sql = "SELECT * FROM usersvet WHERE email=?;";
                $stmt = mysqli_stmt_init($dbConnection);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    $errors[] = "There was an error.";
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if (!$row = mysqli_fetch_assoc($result)) {
                        $errors[] = "There was an error.";
                        exit();
                    } else {
                        $sql = "UPDATE usersvet SET pwd=? WHERE email=?;";
                        $stmt = mysqli_stmt_init($dbConnection);

                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            $errors[] = "There was an error.";
                            exit();
                        } else {
                            $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?;";
                            $stmt = mysqli_stmt_init($dbConnection);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                $errors[] = "There was an error.";
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../login.php?passwordupdated");
                            }
                        }
                    }
                }
            }
        }
    }



} else {
    header("Location: login.php");
}





















