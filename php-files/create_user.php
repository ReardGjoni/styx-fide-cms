<?php
require_once "auth.php";
require_once "includes/dbConfig.php";
error_reporting(E_ALL);
if (!hasPermission('edit_users')) {
    header("Location: 403/403.html");
}

$groupsObj = mysqli_query($dbConnection, 
                                        "SELECT id,
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
<title>Create User Manually</title>
<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
<link rel="stylesheet" href="<?= BASE ?>dash.css">
<link rel="stylesheet" href="<?= BASE ?>editor.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400|Pacifico' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
</head>

<body>
  
<?php require_once 'partials/header.php'; ?>

<main class="container dashboard"><br>
  <form style="margin-left: 20%; margin-top: 5%; color: white;" class="w-50" method="post" action="edit_users.php">
      <h1>Create User</h1>
      
    		<div class="form-group">
    			<label for="username">Username</label>
    			<input name="username" id="username" type="text" class="form-control" placeholder="Username" value="">
        </div>
        
    		<div class="form-group">
    			<label for="email">Email</label>
    			<input name="email" id="email" type="email" class="form-control" placeholder="E-Mail" value="">
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input name="password" id="password" type="password" class="form-control" placeholder="Password">
        </div>

        <div class="form-group">
            <label for="password-repeat">Repeat Passwort</label>
            <input name="password_repeat" id="password-repeat" type="password" class="form-control" placeholder="Repeat Password">
        </div>

        <div class="form-group">
          <label for="group_id">Role</label>
          <select class="custom-select" name="group_id" id="group_id">
            <?php foreach ($groups as $group): ?>
              <option value="<?= $group['id'] ?>"><?= ucfirst($group['role']) ?></option>
            <?php endforeach ?>
          </select>
        </div>

        <div class="form-check">
          <input name="activated" class="form-check-input" type="checkbox" id="activated" checked>
          <label class="form-check-label" for="activated">Activated</label>
        </div>
        <!-- Um, in edit_users.php (s. action) den Kontext zu kontrollieren -->
        <input type="hidden" name="create-user">
			<br>
    		<input type="submit" class="btn btn-dark" value="Create">
    	</form>
	</main>






<!-- Compiled and minified jQuery 2.1.3 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- CDN for chart js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.js"></script>
<script src="main.js"></script>
</body>