<?php

require_once 'auth.php';
    require_once 'includes/dbConfig.php';

    // Userdaten laden und unten anzeigen
    $userID = $_SESSION["user_id"];
    $username = $_SESSION["username"]; // ose userName

    $email = mysqli_fetch_assoc(mysqli_query($dbConnection, "SELECT email FROM usersvet WHERE id = " . $userID))['email'];

    if (!empty($_POST))
    {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $passwordRepeat = filter_var($_POST['password-repeat'], FILTER_SANITIZE_STRING);

        $errors = [];
        $success = [];

        if (!$email)
        {
            $errors[] = 'E-Mail Format is wrong.';
        }

        if (!empty($password) || !empty($passwordRepeat))
        {
            // Neues PW wurde gewählt
            $password = $password;
            $passwordRepeat = $passwordRepeat;

            if (strlen($password) < 6) 
            {
                $errors[] = 'Your password should contain at least 8 characters.';   
            }

            if ($password !== $passwordRepeat)
            {
                $errors[] = 'Both passwords should be identical.';
            }

            if (empty($errors))
            {
                mysqli_query($dbConnection,
               "UPDATE usersvet 
                SET email = '" . $email . "',
                    pwd = '" . password_hash($password, PASSWORD_DEFAULT) . "' 
                WHERE id = " . $userID) 
                or die(mysqli_error($dbConnection));
                $success[] = "Password successfully changed.";

            }

        } else {
            if (empty($errors))
            {
                mysqli_query($dbConnection, 
                            "UPDATE usersvet 
                             SET email = '" . $email . "' 
                             WHERE id = " . $userID);
                $success[] = "E-Mail successfully changed.";
            }
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<title>My Profile</title>
<!-- Google Fonts -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400|Pacifico' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
<link rel="stylesheet" href="<?= BASE ?>dash.css">
</head>

<body>
  <?php require_once 'partials/header.php'; ?>

  <main class="container" style="color: white; padding-top: 100px; padding-left: 50px;"><br>
    <div class="dashboard">
        <h2>Edit Profile</h2>
        <?php if (!empty($errors)): ?>
          <?php foreach ($errors as $error): ?>
            <div class="well">
                <p class="alert alert-warning"><?= $error ?></p>
            </div>
          <?php endforeach ?>
        <?php endif ?>

        <?php if (!empty($success)): ?>
          <?php foreach ($success as $key): ?>
            <div class="well">
                <p class="alert alert-success"><?= $key ?></p>
            </div>
          <?php endforeach ?>
        <?php endif ?>

        <form class="w-50" method="post" action="">
          <div class="form-group">
            <label>Username</label>
            <input style="background-color: rgb(31, 31, 31);" name="username" type="text" class="form-control" value="<?= $username ?>" readonly>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input name="email" id="email" type="email" class="form-control" placeholder="E-Mail" value="<?= $email ?>">
          </div>

          <div class="form-group">
              <label for="password">Change Password</label>
              <input name="password" id="password" type="password" class="form-control" placeholder="Password" value="">
          </div>

          <div class="form-group">
              <label for="password-repeat">Repeat new password</label>
              <input name="password-repeat" id="password-repeat" type="password" class="form-control" placeholder="Repeat Password" value="">
          </div>
        <br>
        <input type="submit" class="btn btn-dark" value="Commit, you dirty beast">
        </form>
          <br> <br>
        </div>
  </main>

<!-- Compiled and minified jQuery 2.1.3 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- CDN for chart js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.js"></script>
<script src="main.js"></script>
</body>
</html>