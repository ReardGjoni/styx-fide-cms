<?php

require_once 'includes/dbConfig.php';

$sql = "SELECT userName COUNT(*) AS Number FROM usersvet";

$userNames = filter_var($_POST['username'], FILTER_SANITIZE_STRING);

echo $sql;




?>





<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

<link rel="stylesheet" href="dash.css">
<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400|Pacifico' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Bree+Serif" rel="stylesheet">

<!-- Font Awesome -->

<body>

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

        <li><a href="#"><i class="fa fa-user"></i> View Profile</a></li>

        <li><a href="#"><i class="fa fa-wrench"></i> Settings</a></li>

        <li><a href="#"><i class="fa fa-paper-plane"></i> Messages</a></li>

        <li><a href="#"><i class="fa fa-sign-out"></i> Log out</a></li>

      </ul>

    </div>

    <div class="account">

      <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/217538/profile.jpg" />
      <p>My account<i class="fa fa-caret-down"></i></p>

    </div>

    <div class="account-box">

      <h3>Jack Thomson</h3>

      <li><a href="#"><i class="fa fa-user"></i> View Profile</a></li>

      <li><a href="#"><i class="fa fa-wrench"></i> Settings</a></li>

      <li><a href="#"><i class="fa fa-paper-plane"></i> Messages</a></li>

      <li><a href="#"><i class="fa fa-sign-out"></i> Log out</a></li>

    </div>

  </header>

  <aside>

    <h1>Styx Fide</h1>

    <ul>

      <li class="active"><a href="#"><i class="fas fa-columns"></i>User Analytics</a></li>

      <li><a href="#"><i class="fas fa-columns"></i>Write an article</a></li>

      <li><a href="#"><i></i>Your sites</a></li>

      <li><a href="#"><i class="fas fa-columns"></i>Discover</a></li>

      <li><a href="#"><i class="fa fa-wrench"></i>Settings</a></li>

    </ul>

  </aside>

  <input type="hidden" name="username" id="">

  <div class="dashboard">

    <canvas id="myChart"></canvas>

    <div class="row">

      <div class="profits">

        <div class="info">

          <span class="circle c-profits">Total</br>visits</span>

          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit praesentium magni minima eius culpa sunt totam numquam, adipisci nihil quo?</p>

        </div>

      </div>

      <div class="expenses">

        <div class="info">

          <span class="circle c-expenses">User</br>conversion rate</span>

          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, et tempora. Quibusdam inventore eum ratione non minima quod iste numquam.</p>

        </div>

      </div>

    </div>

  </div>

  <!-- Compiled and minified jQuery 2.1.3 -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  
  <!-- CDN for chart js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.js"></script>
  
  <!-- Compiled and minified global js file -->
  <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/217538/global-min.js"></script>
  <script src="main.js"></script>

</body>

</html>