<?php
require_once 'auth.php';
require_once 'includes/dbConfig.php';
require_once 'includes/initialize.php';


$categoriesObj = mysqli_query($dbConnection, 
                                        "SELECT id,
                                                title
                                         FROM categories");

$categories = [];

while ($_row = mysqli_fetch_assoc($categoriesObj)) {
    $categories[] = $_row;
}

if (!empty($_POST)) {

    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    $createPost = filter_var($_POST['createPost'], FILTER_SANITIZE_STRING);
    $categoryY = filter_var($_POST['category_id'], FILTER_VALIDATE_INT);
    
    if (!empty($createPost) && !empty($title)) {
        mysqli_query($dbConnection, 
            "INSERT INTO posts (user_id, category_id, title, content) 
            VALUES (
            " . $_SESSION['user_id'] . " ,
            '" . $categoryY . "' ,
            '" . $title . "' , 
            '" . $createPost . "')");
    } else {
        echo mysqli_error($dbConnection);
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Create a Post</title>
  <meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
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
        <div class="title" id="title" contenteditable data-text="Title"></div>
        <div class="editor-canvas" id="canvas" contenteditable data-text="Write something magical"></div>
    </div>

    <form method="post">
        <input type="hidden" name="title">
        <input type="hidden" name="createPost">

        <div style="position: relative; bottom: -17.5px; left: 50px; color: white;" class="form-group w-25">
          <label for="category_id">Category</label>
          <select style="height: 3rem; border-radius: 0px;border-color: #2C3E50;background-color: rgb(31, 31, 31);color: white;" class="custom-select" name="category_id" id="category_id">
              <?php foreach ($categories as $category): ?>
                  <option value="<?= $category['id'] ?>"><?= ucfirst($category['title']) ?></option>
              <?php endforeach ?>
          </select>
        </div>
        <input style="font-size: 18px; background: black;border: none;color: white;margin-left: 45%; position: relative; bottom: 50px;width: 12rem; height: 3rem;" type="submit" class="btn btn-light">
    </form>
    
  </div>

<script>

let form = document.querySelector("form"),
    editorCanvaas = document.querySelector(".editor-canvas"),
    editorContent = form.createPost;

form.addEventListener('submit', (e) => {
    e.preventDefault();
    editorContent.value = editorCanvaas.innerHTML;
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
<script src="editor.js"></script>
<script src="main.js"></script>
</body>