<?php

require_once 'auth.php';
require_once 'includes/dbConfig.php';

$postId = $_GET['delete_post'];

$postsObj = mysqli_query($dbConnection, 
                         "SELECT 
                                posts.id,
                                posts.title,
                                posts.content,
                                posts.created_at,
                                usersvet.userName,
                                categories.title AS category_title
                          FROM posts
                          JOIN usersvet
                          ON usersvet.id = posts.user_id
                          JOIN categories
                          ON categories.id = posts.category_id
                          WHERE posts.id = " . $postId);

$postsObj = mysqli_query($dbConnection, 
                         "DELETE
                          FROM  posts
                          WHERE posts.id = " . $postId);
                          
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Table Style</title>
<link rel="stylesheet" href="<?= BASE ?>dash.css">
<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400|Pacifico' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
</head>

<body>
<?php require_once 'partials/header.php'; ?>

<div class="dashboard">
  <div class="well w-75" style="padding-left: 33.5%; padding-top: 25%;">
      <p class="alert alert-warning w-75" style="background-color: white; border-radius: 3px; text-align:center;">Post succesfully deleted.</p>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <!-- CDN for chart js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.js"></script>
<script src="main.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>