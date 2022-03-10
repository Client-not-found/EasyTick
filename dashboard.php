<?php

    /**Session Handling Container erstellen */
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

    /**Formular Daten in Variabel speichern */
    if( !empty($_POST)) {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $res = mysqli_query( $con, "SELECT * FROM tuser WHERE useUsername = '$username' AND usePassword = '$password'");
    
        $_SESSION['loggedIn'] = mysqli_num_rows( $res ) == 1;
        $_SESSION['client'] = mysqli_fetch_assoc($res);

    }   
    
    //Variabels for the navbar
    $dashboard = DASHBOARD;
    $create_a_ticket = CREATE_A_TICKET;
    $tickets = TICKETS;
    $knowledge_base = KNOWLEDGE_BASE;
    $administration = ADMINISTRATION;

        $username = $_SESSION['client']['useUsername'];
        $password = $_SESSION['client']['usePassword'];

         /** Tickets abfragen */

         if($_SESSION['client']['useGroId'] == '1'or $_SESSION['client']['useGroId'] == '2') {
          /** Offene Tickets */
        $totalopen = mysqli_query( $con, "SELECT count(lttStatus) from tLanguageToTicket JOIN tTicket ON lttticId = ticKey WHERE lttStatus = 'open'");
        $_SESSION['open'] = mysqli_fetch_assoc($totalopen);
        /** Geschlossene Tickets */
        $totalclosed = mysqli_query( $con, "SELECT count(lttStatus) from tLanguageToTicket JOIN tTicket ON lttticId = ticKey WHERE lttStatus = 'closed'");
        $_SESSION['closed'] = mysqli_fetch_assoc($totalclosed);

        /** Tickets gesammt */
        $totalresult = mysqli_query( $con, "SELECT count(lttStatus) from tLanguageToTicket");
        $_SESSION['total'] = mysqli_fetch_assoc($totalresult);

        /** Abruf der offenen Tickets für die Liste */
        $sql = "SELECT * from tLanguageToTicket JOIN tTicket ON lttTicId = ticKey JOIN tUser ON ticUseId = useKey WHERE lttStatus = 'open'";
        $db_erg = mysqli_query($con, $sql);
         } else {
        /** Offene Tickets */
        $totalopen = mysqli_query( $con, "SELECT count(lttStatus) from tLanguageToTicket JOIN tTicket ON lttticId = ticKey JOIN tUser ON ticUseId = useKey WHERE lttStatus = 'open' AND useUsername = '$username' AND usePassword = '$password'");
        $_SESSION['open'] = mysqli_fetch_assoc($totalopen);
        /** Geschlossene Tickets */
        $totalclosed = mysqli_query( $con, "SELECT count(lttStatus) from tLanguageToTicket JOIN tTicket ON lttticId = ticKey JOIN tUser ON ticUseId = useKey WHERE lttStatus = 'closed' AND useUsername = '$username' AND usePassword = '$password'");
        $_SESSION['closed'] = mysqli_fetch_assoc($totalclosed);

        /** Tickets gesammt */
        $totalresult = mysqli_query( $con, "SELECT count(lttStatus) from tLanguageToTicket JOIN tTicket ON lttticId = ticKey JOIN tUser ON ticUseId = useKey WHERE useUsername = '$username' AND usePassword = '$password'");
        $_SESSION['total'] = mysqli_fetch_assoc($totalresult);

        /** Abruf der offenen Tickets für die Liste */
        $sql = "SELECT * from tLanguageToTicket JOIN tTicket ON lttTicId = ticKey JOIN tUser ON ticUseId = useKey WHERE lttStatus = 'open'  AND useUsername = '$username' AND usePassword = '$password'";
        $db_erg = mysqli_query($con, $sql);
      }
    If( !$_SESSION['loggedIn'] ) {
        header( 'Location: index.php' );
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo PAGE_NAME ?> | Dashboard</title>
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
    
    <br>
    <!-- Div Container -->
    <div class="container">
      <!-- Statistics cards -->
      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body text-white bg-success">
              <h5 class="card-title"><?php echo OPEN_COUNT ?></h5>
              <?php  echo $_SESSION['open']['count(lttStatus)']; ?>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body text-white bg-danger">
              <h5 class="card-title"><?php echo CLOSED_COUNT ?></h5>
              <?php echo $_SESSION['closed']['count(lttStatus)']; ?>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-body text-white bg-info">
              <h5 class="card-title"><?php echo TOTAL_COUNT ?></h5>
              <?php echo $_SESSION['total']['count(lttStatus)']; ?>
            </div>
          </div>
        </div>
      </div>
      <br>
      <!-- Offene Tickets -->
      <table class="table col-md-12">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                        <th scope="col"><?php echo TOPIC ?></th>
                        <th scope="col"><?php echo DEPARTEMENT ?></th>
                        <th scope="col"><?php echo STATUS ?></th>
                        <th scope="col">#</th>     
                    </tr>
                </thead>
                <?php 

                while($row = mysqli_fetch_array( $db_erg)) {

                echo    '<tbody>';
                echo        '<tr>';
                echo            '<th>'. $row['ticKey'].'</th>';
                echo            '<td>'. $row['ticTopic'].'</td>';
                echo            '<td>'. $row['lttDepartement'].'</td>';
                echo            '<td>'. $row['lttStatus'].'</td>';
                echo            '<td><a href="ticketDetails.php?id='. $row['ticKey'] .'" class="btn btn-info" >'. VIEW .'</a></td>';
                echo        '</tr>';
                echo    '</tbody>'; 

                }
            
            echo '</table>';
                mysqli_free_result( $db_erg );
        
            ?>
    </div>
  </body>
  <footer>
    <?php
      echo '<div id="footer">';
              include 'templates/footbar.php';
      echo '</div>';
    ?>
  </footer>
</html>