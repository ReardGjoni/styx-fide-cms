<?php

require_once 'auth.php';
require_once 'includes/dbConfig.php';
require_once 'includes/initialize.php';


if (!empty($_POST)) {
    /*
       Leider keine vervollständigte Funktionalität wie z.B Resultate zeigen auch wenn der Suchwert
       nicht bis zum Ende eingegeben worden ist oder wenn es keine Resultate gibt.
       Auch ist diese Funktionalität gegen SQL Injections nicht geschützt.
    */
    $search = filter_var($_POST['search'], FILTER_SANITIZE_STRING);

        
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
                            WHERE posts.title LIKE '$search'
                            ORDER BY posts.created_at
                            DESC");
            
    $posts = [];

    while ($_row = mysqli_fetch_assoc($postsObj)) {
        $posts[] = $_row;
    }
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Posts</title>
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

<main class="dashboard">

<form method="post" id="search">
    <input style="border: none;
                  background: #1C2631;
                  color: white;
                  height: 50px;
                  font-size: 18px;
                  margin-left: 105px;
                  margin-top: 100px;
                  padding: 20px;
                  border-radius: 3px;" name="search" type="text" placeholder="Search Posts">
  </form>

  <?php foreach($posts as $post): ?>
    <div class="jumbotron jumbotron-fluid w-75" id="posts">
        <div class="container jumbo">
            <div style="padding-bottom: 50px;" class="display-4">
              <a style="color: white;" href="post.php?id=<?= $post['id'] ?>">
                  <?= $post['title'] ?>
              </a>
            </div>

            <p style="color: lightgrey;"><?= substr($post['content'], 0, 50) ?></p> 
            <!-- substr takes three parameters, 
            an array, the beginning of the start and the end
            (show only characters from these two places) -->
            <p class="lead">
            Posted by <a href="#"><?= $post['userName'] ?? 'unknown' ?></a> on <?= $post['created_at'] ?> in 
            <a href=""><?= $post['category_title'] ?? 'uncategorized' ?></a>
            </p><br>

            <?php if (isset($_SESSION["group_id"]) && $_SESSION["group_id"] >= 2): ?>
              <a style="background: rgb(58, 55, 55); border: none;" href="edit_post.php?id=<?= $post['id'] ?>" class="btn btn-primary">Edit</i></a>
              
              <?php if(hasPermission('delete_posts')): ?>
                <a style="margin-left: 20px; background: rgb(58, 55, 55); border: none;" href="delete_post.php?delete_post=<?= $post['id'] ?>" class="btn btn-primary">Delete</i></a>
              <?php endif ?>
            <?php endif ?>
        </div>
    </div>
  <?php endforeach ?>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- CDN for chart js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.js"></script>
<script src="main.js"></script>
</body>















