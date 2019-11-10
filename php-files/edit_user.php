<?php

require_once "auth.php";
require_once "includes/dbConfig.php";
error_reporting(E_ALL);

if (!hasPermission('edit_users')) {
    header("Location: 403/403.html");
}

if (!empty($_POST)) {
    # Get variables
    $id = filter_var($_GET['user_id'], FILTER_VALIDATE_INT);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $activated = (isset($_POST['activated'])) ? 1 : 0 ;
    $group_id = filter_var($_POST['group_id'], FILTER_VALIDATE_INT);

    $sql = "UPDATE usersvet
            SET group_id = ?,
                userName = ?,
                email = ?, 
                activated = ?
            WHERE id = ?";
    $statement = mysqli_stmt_init($dbConnection);

    if (!mysqli_stmt_prepare($statement, $sql)) {
        die("SQL Error Bro.");
    } else {
        mysqli_stmt_bind_param($statement, "issii", $group_id, $username, $email, $activated, $id);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);
    }
}

if (isset($_GET['user_id'])) {
    $id = filter_var($_GET['user_id'], FILTER_VALIDATE_INT);
    if ($id) {
        $sql = "SELECT email,
                       userName,
                       group_id,
                       activated
                FROM usersvet
                WHERE id = " . $id;

    $userObj = mysqli_query($dbConnection, $sql);
    $user = mysqli_fetch_assoc($userObj);
    }
}

$groupsObj = mysqli_query($dbConnection, "SELECT id,
                                                 role
                                          FROM groups");
$groups = [];

while ($_row = mysqli_fetch_assoc($groupsObj)) {
    $groups[] = $_row;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Edit User <?= $user['userName'] ?></title>
<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400|Pacifico' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
<link rel="stylesheet" href="<?= BASE ?>dash.css">
</head>

<body>
<?php require_once 'partials/header.php'; ?>  

<main class="dashboard users" style="color: white; padding-top: 100px; padding-left: 50px;" class="dashboard">
  <h1>Edit User with the Username <?= $user['userName'] ?? '' ?></h1> <br>
    <form class="w-50" method="post">
      <div class="form-group">
        <label for="username">Username</label>
        <input class="form-control" id="username" type="text" name="username" value="<?= $user['userName'] ?>">
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control" id="email" type="text" name="email" value="<?= $user['email'] ?>">
      </div>

      <div class="form-group">
      <label for="group_id">Role</label>
      
      <select class="custom-select" name="group_id" id="group_id">

        <?php foreach ($groups as $group): ?>
          <option value="<?= $group['id'] ?>" 
          <?php if ($group['id'] == $user['group_id']) echo 'selected'; ?>><?= ucfirst($group['role']) ?>
          </option>
        <?php endforeach ?>

      </select> 
      </div>

      <div class="form-check">
        <input name="activated" class="form-check-input" type="checkbox" id="activated" <?php if (isset($user['activated']) && $user['activated'] == 1) echo 'checked' ?>>
        <label class="form-check-label" for="activated">Activated</label>
      </div>
      <br><br>
      <input type="submit" class="btn btn-dark" value="Save">
    </form>
	</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- CDN for chart js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.js"></script>
<script src="main.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>