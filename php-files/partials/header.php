<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="editor.css">
<link rel="stylesheet" href="dash.css">
</head>

<header>
<i class="fa fa-bars"></i>

<div class="menu">
    <p>Menu</p>

    <ul>
    <li class="active"><a href="#"><i class="fa fa-line-chart"></i>Analytics</a></li>
    <li><a href="#"><i class="fa fa-folder-open"></i>Reports</a> <span class="notification">4</span></li>
    <li><a href="#"><i class="fa fa-wrench"></i>Settings</a></li>
    </ul>

<p>My account</p>

    <ul>
    <li><a href="profile.php"><i class="fa fa-user"></i> View Profile</a></li>
    <li><a href="#"><i class="fa fa-wrench"></i> Settings</a></li>
    <li><a href="#"><i class="fa fa-paper-plane"></i> Messages</a></li>
    <li><a href="logout.php"><i class="fa fa-sign-out"></i> Log out</a></li>
    </ul>
</div>

<div class="account">
<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/217538/profile.jpg" />
<p>My account<i class="fa fa-caret-down"></i></p>
</div>

<div class="account-box">
<h3><?php echo $_SESSION['username'] ?? ''; ?></h3>
<li><a href="profile.php"><i class="fa fa-user"></i> View Profile</a></li>
<li><a href="#"><i class="fa fa-wrench"></i> Settings</a></li>
<li><a href="#"><i class="fa fa-paper-plane"></i> Messages</a></li>
<li><a href="logout.php"><i class="fa fa-sign-out"></i> Log out</a></li>
</div>
</header>

<aside>

<a href="../index.html"><h1>Styx Fide</h1></a>

<ul id="jsContainer">
<?php if (isset($_SESSION["group_id"]) && $_SESSION["group_id"] >= 1): ?>
    <?php if(hasPermission('settings')): ?>
        <li class="nav-item">
        <a class="nav-link" href="settings.php">Settings</a>
        </li>
    <?php endif ?>

    <?php if(hasPermission('edit_users')): ?>
        <li class="nav-item">
        <a class="nav-link" href="edit_users.php">Users</a>
        </li>
    <?php endif ?>

    <?php if(hasPermission('create_posts')): ?>
        <li class="nav-item">
        <a class="nav-link" href="create_post.php">Create a post</a>
        </li>
    <?php endif ?>
<?php endif ?>

    <?php if(!isset($_SESSION['group_id'])): ?>
    <li class="nav-item">
    <a class="nav-link" href="posts_guest.php">View as a Guest</a>
    </li>
    <?php endif ?>

    <?php if(isset($_SESSION['group_id']) && $_SESSION['group_id'] >= 1): ?>
    <li class="nav-item">
    <a class="nav-link" href="posts.php">Posts</a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="dashboard.php">Your Dashboard</a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="#">User Analytics</a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="#">Your sites</a>
    </li>

    <li class="nav-item">
    <a class="nav-link" href="#">Discover</a>
    </li>
    <?php endif ?>

</ul>
</aside>

</html>