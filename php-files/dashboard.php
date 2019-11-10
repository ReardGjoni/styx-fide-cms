<?php

require_once "auth.php";
require "includes/dbConfig.php";
require_once 'includes/initialize.php';


$username = $_SESSION["username"] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400|Pacifico' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
<link rel="stylesheet" href="<?= BASE ?>dash.css">

<body>
<?php require_once 'partials/header.php'; ?>

  <div class="dashboard">
    <br><br>
      <main class="container" style="color: white; padding-left: 100px; padding-top: 60px;">
        <h1>Hello <?= $username ?>,</h1>
          <br>
          you are now logged in.
      </main>
  </div>

<!-- Compiled and minified jQuery 2.1.3 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- CDN for chart js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.js"></script>
<script src="main.js"></script>
</body>
</html>