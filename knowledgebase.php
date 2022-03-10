<?php 
    session_start();

    //include Configs
    include "config/config.php";
    include "config/language.php";
    //Database connection
    $db_host = DB_HOST;
    $db_user = DB_USER;
    $db_password = DB_PASSWORD;
    $db_db = DB_DB;

    $con = mysqli_connect($db_host, $db_user, $db_password, $db_db);

    //Variabels for the navbar
    $dashboard = DASHBOARD;
    $create_a_ticket = CREATE_A_TICKET;
    $tickets = TICKETS;
    $knowledge_base = KNOWLEDGE_BASE;
    $administration = ADMINISTRATION;

    $sql = "SELECT * from tLanguageToCategory JOIN tCategory ON ltcCatId = catKey WHERE catActive = '1'";
    $db_erg = mysqli_query($con, $sql);
?>

<!DOCTYPE html>

<html>
    <head>    
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo PAGE_NAME ?> | Knowledge base</title>
        <!-- Get Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <!-- Style -->
        <link rel="stylesheet" href="templates/style.css">
    </head>

    <body>
    <?php 
    if($_SESSION['client']['useGroId'] == '1') {
      include 'templates/adminNavbar.php';
    } else {
        include 'templates/navbar.php';
    }
    ?>

      <div class="container">

        <?php
          if(mysqli_num_rows( $db_erg ) == 0) {
            echo '<br>';
            echo '<table class="table col-md-12">';
            echo    '<tbody>';
            echo        '<tr>';
            echo            '<th>'. NO_CATEGORIES .'</th>';
            echo            '<td><a href="admin/knowledgeBase.php" class="btn btn-success" >'. NEW_CATEGORY .'</a></td>';
            echo        '</tr>';
            echo    '</tbody>'; 
            echo '</table>';
          } else {

            while($row = mysqli_fetch_array( $db_erg, MYSQLI_ASSOC)) {
              echo '<br>';
              echo '<h5>'. $row['ltcName'] .'</h5>';
              $id = $row['catKey'];

              $article = "SELECT * from tArticle WHERE $id = artCatId";
              $result = mysqli_query($con, $article);

              if(mysqli_num_rows( $result ) > 0) {
                while($row = mysqli_fetch_array($result))  {
                  echo '<table class="table col-md-12">';
                  echo    '<tbody>';
                  echo        '<tr>';
                  echo            '<th class="table col-md-3">'. $row['artTopic'].'</th>';
                  echo            '<td class="table col-md-3"><a href="article.php?id='. $row['artKey'] .'" class="btn btn-info" >'. VIEW .'</a></td>';
                  echo        '</tr>';
                  echo    '</tbody>'; 
                  echo '</table>';
                }
                if ($_SESSION['client']['useGroId'] == '1' || $_SESSION['client']['useGroId'] == '2') {
                  echo    '<a href="createArticle.php" class="btn btn-success table col-md-12" >'. ADD_ARTICLE .'</a>';
                }
              } else {
                  echo '<hr>';
                  echo '<p>'. NO_ARTICLES .'</p>';
                if ($_SESSION['client']['useGroId'] == '1' || $_SESSION['client']['useGroId'] == '2') {
                  echo    '<a href="createArticle.php" class="btn btn-success table col-md-12" >'. ADD_ARTICLE .'</a>';
                }
              }
            }
          }
        ?>
      <div>
      <div id="text">
      </div>   
      <script src="Script.js"></script> 
    </body>
    <footer>
    <?php
      echo '<div id="footer">';
              include 'templates/footbar.php';
      echo '</div>';
    ?>
  </footer>
</html>