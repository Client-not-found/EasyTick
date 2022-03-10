<?php

    /**Session Handling Container erstellen */
    session_start();
    //include Configs
    include "../config/config.php";

    //Database connection
    $db_host = DB_HOST;
    $db_user = DB_USER;
    $db_password = DB_PASSWORD;
    $db_db = DB_DB;

    $con = mysqli_connect($db_host, $db_user, $db_password, $db_db);

    /** Permission */
    $group = $_SESSION['client']['useGroId'];


    ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo PAGE_NAME ?> | Admin - Dashboard</title>
      <!-- Get Bootstrap -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  </head>

  <body>
    <?php include 'navbar.php'; ?>
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" href="dashboard.php">Info</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="userlist.php">User list</a>
      </li>
      <li class="nav-item">
                <a class="nav-link" href="knowledgeBase.php">Knowledge base</a>
            </li>
    </ul>
    
    <!-- Container -->
    <div class="container">
      <br>
      <h4>Software</h4>
      <hr>
      <p><b>Version:</b> <?php echo PAGE_VERSION ?></p>
      <b>Autor:</b> Nicolas Rhyner</p>

      <p>Copyright © 2020 Nicolas Rhyner. All rights reserved.</p>
      <br>
      <h4>Server</h4>
      <hr>
      <p><b>Web-Server: </b> <?php echo $_SERVER['SERVER_SOFTWARE'];?></p><br>
    </div>
  </body>
</html>