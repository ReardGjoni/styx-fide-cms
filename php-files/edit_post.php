<?php

require_once "auth.php";
require_once "includes/dbConfig.php";


if (!hasPermission('edit_posts')) {
  header("Location: 403/403.html");
}

$postId = $_GET['id'];

# Post Content etc. zeigen
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
          
$posts = [];

while ($_row = mysqli_fetch_assoc($postsObj)) {
  $posts[] = $_row;
}

if (!empty($_POST)) {
  $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
  $content_elem = filter_var($_POST['createPost'], FILTER_SANITIZE_STRING);

  $sql = "UPDATE posts
          SET title = '" . $title . "',
              content = '" . $content_elem . "' 
          WHERE id = " . $postId;
  $update = mysqli_query($dbConnection, $sql);
}


?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Edit Post</title>
<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= BASE ?>dash.css">
<link rel="stylesheet" href="<?= BASE ?>editor.css">
<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400|Pacifico' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
</head>

<body>
  <?php require_once 'partials/header.php'; ?>

  <div class="dashboard">
    <div class="editor">
          <div class="editor-menuebar">
              <button class="editor-button" data-attribute="bold">Bold</button>
              <button class="editor-button" data-attribute="italic">Italic</button>
              <button class="editor-button" data-attribute="underline">Underline</button>
              <button class="editor-button" data-attribute="justifyleft">Left</button>
              <button class="editor-button" data-attribute="justifycenter">Right</button>
          </div>

          <?php foreach($posts as $post): ?>
              <div class="title" id="title" contenteditable type="text"><?= $post['title'] ?></div>
              <div style="margin-bottom: 20px;" class="editor-canvas" id="canvas" contenteditable><?= $post['content']?></div>
          <?php endforeach ?>
          
          <form method="post">    
              <input type="hidden" name="title">
              <input type="hidden" name="createPost">
              <button style="height: 3rem; font-size: 18px;background: black;border: none;color: white;margin-left: 45%; margin-bottom: 20px;width: 12rem;" type="submit" class="btn btn-light editorBtn">Submit</button>
          </form>
      </div>
  </div>



<script>

    let form = document.querySelector("form"),
        editorCanvaas = document.querySelector(".editor-canvas"),
        editorContent = form.createPost;

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        editorContent.value = editorCanvaas.innerHTML;
        console.log(editorCanvaas.innerHTML);
        form.submit();
    }, false);

    let title = document.querySelector(".title"),
        editorTitle = form.title;

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        editorTitle.value = title.innerHTML;
        form.submit();
    }, false);

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- CDN for chart js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.js"></script>
<script src="main.js"></script>
<script src="editor.js"></script>
</body>