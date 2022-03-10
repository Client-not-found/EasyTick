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

    $id = $_GET['id'];

    $con = mysqli_connect($db_host, $db_user, $db_password, $db_db);
    $ticket = "SELECT * from tLanguageToTicket JOIN tTicket ON lttTicId = ticKey JOIN tUser ON ticUseId = useKey WHERE $id = ticKey";
    $message = "SELECT * from tMessage JOIN tTicket ON mesTicId = ticKey JOIN tUser ON mesUseId = useKey WHERE $id = ticKey ORDER BY ticKey ASC";
    $db_erg = mysqli_query($con, $ticket);
    $mes = mysqli_query($con, $message);
    $row = mysqli_fetch_array( $db_erg, MYSQLI_ASSOC);

        //Variabels for the navbar
        $dashboard = DASHBOARD;
        $create_a_ticket = CREATE_A_TICKET;
        $tickets = TICKETS;
        $knowledge_base = KNOWLEDGE_BASE;
        $administration = ADMINISTRATION;

        if(isset($_POST['Submit']))  {
            $newTicketMessage = $_POST['newTicketMessage'];
            $newUserId = $_SESSION['client']['useKey'];
    
            $id = $_POST['id'];
    
            /**Insert Befehl */
            $newMessageInsert = mysqli_query( $con, "INSERT INTO tMessage(mesTicId, mesUseId,  mesMessage) VALUES ('$id','$newUserId', '$newTicketMessage')");
    
            /**Weiterleitung */
            header( 'Location: ticketDetails.php?id='. $id );
            } else {
    
            }

        if(isset($_POST['close']))  {
        $close = mysqli_query( $con, "UPDATE tLanguageToTicket JOIN tTicket ON lttTicId = ticKey SET lttStatus = 'closed' WHERE $id = ticKey");
        header( 'Location: ticketDetails.php?id='. $id );
        } else {

        }

        if(isset($_POST['open']))  {
            $open = mysqli_query( $con, "UPDATE tLanguageToTicket JOIN tTicket ON lttTicId = ticKey SET lttStatus = 'open' WHERE $id = ticKey");
            header( 'Location: ticketDetails.php?id='. $id );
        } else {

        }
    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo PAGE_NAME ?> | Ticket details</title>
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
            <div class="row">
                <div class="col-md-9">

                <?php while($zeile = mysqli_fetch_array( $mes, MYSQLI_ASSOC)) {
                echo '<div class="card">';
                echo    '<div class="card-body">';
                echo        '<p class="card-text text-muted">'. $zeile['useFirstname']. ' ' .$zeile['useLastname'] .'</p>';
                echo        '<hr>';
                echo        '<p class="card-text">'. $zeile['mesMessage'] .'</p>';
                echo    '</div>';
                echo '</div>';
                echo '<br>';

                } ?>
                </div>
                <div class="col-md-3">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2"><?php echo STATUS ?></h6>
                            <p class="card-text"><?php echo $row['lttStatus']?></p>
                            <h6 class="card-subtitle mb-2"><?php echo PRIORITY ?></h6>
                            <p class="card-text"><?php echo $row['lttPriority']?></p>
                            <h6 class="card-subtitle mb-2"><?php echo DEPARTEMENT ?></h6>
                            <p class="card-text"><?php echo $row['lttDepartement']?></p>
                            <h6 class="card-subtitle mb-2"><?php echo TOPIC ?></h6>
                            <p class="card-text"><?php echo $row['ticTopic']?></p>
                            <?php   if($_SESSION['client']['useGroId'] == '1'or $_SESSION['client']['useGroId'] == '2') {
                                echo '<hr>';
                                if($row['lttStatus'] == 'open') {
                                echo '<form action="ticketDetails.php?id='. $row['ticKey'] .'" method="POST">';
                                echo '<input class="btn btn-danger" type="submit" value="close" name="close" />';
                                echo '</form>';
                                } else {
                                    echo '<form action="ticketDetails.php?id='. $row['ticKey'] .'" method="POST">';
                                    echo '<input class="btn btn-success" type="submit" value="open" name="open" />';
                                    echo '</form>';            
                                }
                            } else {}

                            ?>
                        </div>
                    </div>
                </div>

                <?php if($row['lttStatus'] == 'open') { ?>
                <div class="col-md-9">
                <br>
                <form method="POST" action="ticketDetails.php">
                <div class="form-group col-md-12">
                        <input type="hidden" id="id" name="id" value="<?php echo $id?>">
                        <textarea class="form-control" id="newTicketMessage" name="newTicketMessage" rows="5" placeholeder="Neue Nachricht..." required></textarea>
                    </div>
                    <input class="btn btn-success" type="submit" value="Submit" name="Submit" />
                    <button class="btn btn-danger" type="reset" value="Reset"><?php echo CANCEL ?></button>
                </form>
            </div> 

                <?php } else {
                    echo  '<div class="col-md-9">';
                    echo    '<div class="alert alert-primary" role="alert">';
                    echo      CLOSED_MESSAGE;
                    echo    '</div>';
                    echo  '</div>';
                    }
                ?>
            </div>
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