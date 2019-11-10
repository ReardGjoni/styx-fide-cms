<?php

require_once "auth.php";
require_once "includes/dbConfig.php";

# Post anhand der $_GET['post_id'] abfragen
$postId = filter_var($_GET['id'], FILTER_VALIDATE_INT);

# Post Content etc. zeigen

if ($postId) {
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
        $commentField = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);

        if ($commentField) {
            mysqli_query($dbConnection, "INSERT 
                                        INTO comments (post_id, user_id, comment_content)
                                        VALUES (" . $postId . ",
                                               " . $_SESSION['user_id'] . ",
                                               '" . $commentField . "')");
        }

    }
    
    # Kommentare zeigen
    
    $commentObj = mysqli_query($dbConnection, 
                             "SELECT 
                                    comments.id,
                                    comments.comment_content,
                                    comments.created_at,
                                    usersvet.userName,
                                    posts.id
                              FROM comments
                              JOIN usersvet
                              ON usersvet.id = comments.user_id
                              JOIN posts
                              ON posts.id = comments.post_id
                              WHERE posts.id = " . $postId . "
                              ORDER BY comments.created_at");
                
    $comments = [];
    
    while ($_row = mysqli_fetch_assoc($commentObj)) {
        $comments[] = $_row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>
<?php foreach($posts as $post): ?>
  <?= $post['title'] ?>
<?php endforeach ?>
</title>
<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="../dash.css">
<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400|Pacifico' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">
</head>

<body>
  <?php require_once 'partials/header.php'; ?>  

  <main class="dashboard">
    <?php foreach($posts as $post): ?>
      <img style="width:60rem; padding-left: 100px;" src="https://images.pexels.com/photos/34600/pexels-photo.jpg?cs=srgb&dl=code-coder-codes-34600.jpg&fm=jpg" class="mr-5" alt="...">
      <div class="media" style="color: white;">
          <div class="media-body">
            <h1 style="padding-left: 35%; font-weight: bold; font-size: 2.7rem;" class="mt-4">
              <?= $post['title'] ?>
            </h1>
            
            <p style="padding-left: 9%; padding-top: 30px; font-size: 17px;" class="mt-4">
              <?= $post['content'] ?>
            </p>
            
            <p style="padding-left: 9%;" class="mt-5">
              Posted by 
              <a href="#"><?= $post['userName'] ?? 'unknown' ?></a> on <?= $post['created_at'] ?> in 
              <a href=""><?= $post['category_title'] ?? 'uncategorized' ?></a>
            </p>
        </div>
      </div> <br> <br> <br> <br>
  <?php endforeach ?>

<?php foreach($comments as $comment): ?>
    <div class="card w-50 h-auto" style="margin-bottom: 80px;">
      <div class="card-body">
        <a style="font-size: 26px;" href="<?= $comment['userName'] ?>" class="card-text"><?=$comment['userName']?></a>
        <p style="margin-top: 20px;" class="card-title"><?=$comment['comment_content']?></p> <br>
        <a style="width: 50px; height: 50px; margin-bottom: 20px;" href="#" class="btn btn-primary style"><img style="width:20px; padding-top: 10px;" src="heart.png"></a>
        <p class="card-text"><?=$comment['created_at']?></p>
      </div>
    </div><br>
<?php endforeach ?>

<br><form method="post">
    <div  class="form-group commentDiv" >
      <textarea style="background: rgb(197, 197, 197); border: none; border-radius: 5px;" name="comment" class="form-control w-75" id="comment" rows="5" placeholder="What do you think?"></textarea>
      <input style="margin-top: 20px;" type="submit" class="btn btn-dark" value="Comment">
    </div>
</form><br><br>
</main>
 



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!-- CDN for chart js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.js"></script>
<script src="main.js"></script>
</body>