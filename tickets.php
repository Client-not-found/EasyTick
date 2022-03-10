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

    //Variabels for the Ticket-details
    $status = STATUS;
    $departement = DEPARTEMENT;
    $topic = TOPIC;

    //Variabels for Buttons
    $view = VIEW;
    
    $username = $_SESSION['client']['useUsername'];
    $password = $_SESSION['client']['usePassword'];

    If( !$_SESSION['loggedIn'] ) {
        header( 'Location: index.php' );
    }

    if ($_SESSION['client']['useGroId'] == '1'or $_SESSION['client']['useGroId'] == '2') {
        $sql = "SELECT * from tLanguageToTicket JOIN tTicket ON lttTicId = ticKey JOIN tUser ON ticUseId = useKey ORDER BY ticKey ASC";
        
        } else
            $sql = "SELECT * from tLanguageToTicket JOIN tTicket ON lttTicId = ticKey JOIN tUser ON ticUseId = useKey WHERE useUsername = '$username' AND usePassword = '$password' ORDER BY ticKey ASC";
    
            $db_erg = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo PAGE_NAME ?> | Tickets</title>
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

        <!-- Div Container -->
        <div class="container">

                <table class="table col-md-12">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col"><?php echo $topic?></th>
                        <th scope="col"><?php echo $departement?></th>
                        <th scope="col"><?php echo $status?></th>
                        <th scope="col">#</th>      
                    </tr>
                </thead>
                <?php while($row = mysqli_fetch_array( $db_erg, MYSQLI_ASSOC)) {

                echo    '<tbody>';
                echo        '<tr>';
                echo            '<th>'. $row['ticKey'].'</th>';
                echo            '<td>'. $row['ticTopic'].'</td>';
                echo            '<td>'. $row['lttDepartement'].'</td>';
                echo            '<td>'. $row['lttStatus'].'</td>';
                echo            '<td><a href="ticketDetails.php?id='. $row['ticKey'] .'" class="btn btn-info" >'. $view .'</a></td>';
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