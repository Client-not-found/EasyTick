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

    //Variabels for the navbar
    $dashboard = DASHBOARD;
    $create_a_ticket = CREATE_A_TICKET;
    $tickets = TICKETS;
    $knowledge_base = KNOWLEDGE_BASE;
    $administration = ADMINISTRATION;

    if(isset($_POST['Save']))  {
            
        $newTicketDepartement = $_POST['newTicketDepartement'];
        $newTicketTopic = $_POST['newTicketTopic'];
        $newTicketPriority = $_POST['newTicketPriority'];
        $newUserId = $_SESSION['client']['useKey'];
        $newTicketMessage = $_POST['newTicketMessage'];
        /** $newTicketFile= $_Post['newTicketFile]; */

        $id =  $_SESSION['client']['useKey'];
        $newInsert = mysqli_query( $con, "INSERT INTO tTicket(ticUseId, ticTopic, ticDate) VALUES ($id, '$newTicketTopic', now());");
        $last_id = mysqli_insert_id($con);
        $newLanguageInsert = mysqli_query( $con, "INSERT INTO tlanguageToTicket(lttLanId, lttTicId, lttStatus, lttPriority, lttDepartement) VALUES (2, '$last_id', 'open', '$newTicketPriority','$newTicketDepartement')");
        $last_id = mysqli_insert_id($con);


        /**Insert Befehl */
        $newMessageInsert = mysqli_query( $con, "INSERT INTO tMessage(mesTicId, mesUseId,  mesMessage) VALUES ('$last_id','$newUserId', '$newTicketMessage')");

        /**Weiterleitung */
        header( 'Location: dashboard.php' );
        } else {

        }
    
?>

<!DOCTYPE html>
<html>

    <!-- inclue Bootstrap -->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo PAGE_NAME ?> | <?php echo CREATE_A_NEW_TICKET ?></title>
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
        <!-- Container -->
        <div class="container">
            <h1 class="text-center"><?php echo CREATE_A_NEW_TICKET ?></h1>
            <form method="POST" action="newticket.php ">
                <fieldset disabled>
                    <div class="row">
                        <div class="from-group col-md-6">
                            <label for="newTicketFirstname">Firstname</label>
                            <input type="text" id="newTicketFirstname" class="form-control" placeholder="<?php echo $_SESSION['client']['useFirstname']?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="newTicketLastname">Lastname</label>
                            <input type="text" id="newTicketLastname" class="form-control" placeholder="<?php echo $_SESSION['client']['useLastname']?>">
                        </div>
                    </div>
                </fieldset>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="newTicketDepartement"><?php echo DEPARTEMENT ?></label>
                        <select id="newTicketDepartement" name="newTicketDepartement" class="form-control" required>
                            <option selected>General Support</option>
                            <option>Technical Support</option>
                            <option>Feedback</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="newTicketPriority"><?php echo PRIORITY ?></label>
                        <select id="newTicketPriority" name="newTicketPriority" class="form-control" required>
                            <option selected>Low</option>
                            <option>Normal</option>
                            <option>Important!</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="newTicketLastname"><?php echo TOPIC ?></label>
                        <input type="text" id="newTicketTopic" class="form-control" name="newTicketTopic" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="newTicketMessage">Message</label>
                        <textarea class="form-control" id="newTicketMessage" name="newTicketMessage" rows="5" required></textarea>
                    </div>
                    <!--
                    <div class="form-group col-md-12">
                        <label for="newTicketFile">Files</label>
                        <input type="file" class="form-control-file" id="newTicketFile">
                    </div>
                    -->
                </div>
                <input class="btn btn-success" type="submit" value="Save" name="Save" />
                <button class="btn btn-danger" type="reset" value="Reset"><?php echo CANCEL ?></button>
            </form>
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