<?php
    
    require_once 'auth.php';
    require_once 'includes/dbConfig.php';
    error_reporting(E_ALL);
    if (!hasPermission('edit_users'))
    {
      header('Location: 403/403.html');
    }

    # Create User
    
    if (!empty($_POST)) {

      if (isset($_POST['create-user'])) {
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $passwordRepeat = filter_var($_POST['password_repeat'], FILTER_SANITIZE_STRING);
        $activated = (isset($_POST['activated'])) ? 1 : 0;
        $group_id = filter_var($_POST['group_id'], FILTER_SANITIZE_STRING);
  
        $errors = [];
        # Add User in the Database
        # Safer way to do it

        # Validierung

        if (strlen($username) < 5) {
          $errors[] = "Username should contain at least 5 characters.";
        }

        if (!$email) {
          $errors[] = "E-Mail format invalid.";
        }

        if (strlen($password) < 6) {
          $errors[] = "Password should contain at least 6 characters.";
        }

        if ($password !== $passwordRepeat) {
          $errors[] = "Both passwords should be identical.";
        } else {
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

            if ($resultCheck > 0) {
              $errors[] = "User already taken.";
            } else {
              $sql = "INSERT INTO usersvet (userName,
                                   email,
                                   pwd,
                                   activated,
                                   group_id)
                VALUES (?, ?, ?, ?, ?)";

                if (!mysqli_stmt_prepare($statement, $sql)) {
                  $errors[] = "Sql Error.";
                } else {
                  $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                  mysqli_stmt_bind_param($statement, "sssii", $username, $email, $hashedPwd, $activated, $group_id);
                  mysqli_stmt_execute($statement);
                  mysqli_stmt_store_result($statement);
              }
            }
          }
        }
      } 
    }  

    # Delete user

    if (!empty($_GET)) {
      if (isset($_GET['delete_user_id'])) {
        
        $id = filter_var($_GET['delete_user_id'], FILTER_VALIDATE_INT);

        mysqli_query($dbConnection, "DELETE FROM usersvet
                                     WHERE id = " . $id);
        
      }
    }

    $usersObj = mysqli_query($dbConnection, "SELECT
                                    usersvet.id, 
                                    usersvet.group_id, 
                                    usersvet.email, 
                                    usersvet.userName 
                                    FROM usersvet");
    $users = [];
    while ($_row = mysqli_fetch_assoc($usersObj))
    {
      $users[] = $_row;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Edit Users</title>
<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= BASE ?>dash.css">
<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400|Pacifico' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
</head>

<body>
    <?php require_once 'partials/header.php'; ?>  

    <div class="dashboard">
        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <div class="well">
                    <p class="alert alert-warning"><?= $error ?></p>
                </div>
            <?php endforeach ?>
        <?php endif ?>

        <table class="table-fill">
          <thead>
              <tr>
                  <th class="text-left">ID</th>
                  <th class="text-left">Rights</th>
                  <th class="text-left">E-Mail</th>
                  <th class="text-left">Username</th>
                  <th class="text-left">Action</th>
              </tr>
          </thead>

          <tbody class="table-hover">
          <?php foreach ($users as $user): ?>
            <tr>
            <td class="text-left"><?= $user['id'] ?></td>
            <td class="text-left"><?= $user['group_id'] ?></td>
            <td class="text-left"><?= $user['email'] ?></td>
            <td class="text-left"><?= $user['userName'] ?></td>

            <td>
              <button class="btn btn-dark">
              <a style="text-decoration:none" href="edit_user.php?user_id=<?= $user['id'] ?>">Edit</a>
              </button>

              <button class="btn btn-dark">
              <a style="text-decoration:none" href="edit_users.php?delete_user_id=<?= $user['id'] ?>">Delete</a>
              </button>
            </td>
            </tr>
        <?php endforeach ?>
      </tbody>
    </table>
    <a style="margin: 40px;" href="create_user.php" class="btn btn-light ">Create new User</a>
</div>

<!-- Compiled and minified jQuery 2.1.3 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- CDN for chart js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.js"></script>
<script src="main.js"></script>
</body>