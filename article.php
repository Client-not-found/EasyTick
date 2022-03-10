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

    //Variabels for the navbar
    $dashboard = DASHBOARD;
    $create_a_ticket = CREATE_A_TICKET;
    $tickets = TICKETS;
    $knowledge_base = KNOWLEDGE_BASE;
    $administration = ADMINISTRATION;

    //Variabels for Buttons
    $delete = DELETE;

    $sql = "SELECT * FROM tArticle JOIN tUser ON artUseId = useKey JOIN tGroup ON useGroId = groKey WHERE $id = artKey";
    $db_erg = mysqli_query($con, $sql);
    $row = mysqli_fetch_array( $db_erg, MYSQLI_ASSOC);

    $clientId = $row['useKey'];

    $count = "SELECT count(artKey) FROM tArticle JOIN tUser ON artUseId = useKey JOIN tGroup ON useGroId = groKey WHERE $clientId = artUseId";
    $count_erg = mysqli_query($con, $count);
    $count_row = mysqli_fetch_array( $count_erg, MYSQLI_ASSOC);

    if(isset($_GET['delete']))  {
        $delete = mysqli_query( $con, "DELETE FROM tArticle WHERE $id = artKey");
        header( 'Location: knowledgebase.php' );
    } else {
  
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo PAGE_NAME ?> | Article</title>
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
        <br>
            <div class="row">
            <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <b><p class="card-subtitle"><?php echo AUTHOR_PANEL ?></p></b>
                            <hr>
                            <b><p class="card-subtitle"><?php echo NAME ?></p></b>
                            <p class="card-text"><?php echo $row['useFirstname'] .' '. $row['useLastname'] ?></p>
                            <b><p class="card-subtitle"><?php echo RANK ?></p></b>
                            <p class="card-text"><?php echo $row['groName'] ?></p>
                            <b><p class="card-subtitle"><?php echo WRITTEN_ARTICLES ?></p></b>
                            <p class="card-text"><?php echo $count_row['count(artKey)'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" id="test">
                    <div class="card">
                        <div class="card-body">
                            <b><p class="card-subtitle"><?php echo $row['artTopic'] ?></p></b>
                            <hr>
                            <p class="card-text"><?php echo $row['artMessage'] ?></p>
                        </div>
                    </div>
                    <br>
                    <div id="test" class="cold-md-12"></div>
                </div>
                <?php if ($_SESSION['client']['useGroId'] == '1' || $_SESSION['client']['useGroId'] == '2') { ?>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <b><p class="card-subtitle"><?php echo ACTION ?></p></b>
                            <hr>
                                <div class="form-row">
                                    <div class="col-md-3">
                                    <?php echo '<a href="editArticle.php?id='. $id .'" class="btn btn-warning" >'. EDIT .'</a>' ?>
                                    </div>
                                    <div class="col-md-3">
                                    <form method="GET" action="article.php">
                                        <input type="hidden" id="id" name="id" value="<?php echo $id?>">
                                        <button class="btn btn-danger" type="submit" value="delete" name="delete"><?php echo DELETE ?></button>
                                    </div>
                                </div>
                                    <?php } ?>
                            </form>
                        </div>
                    </div>
                    <div id="text">
                    </div>   
                </div>
            </div>
        </div>
        <script src="Script.js">

        </script>   
    </body>
    <footer>
    <?php
      echo '<div id="footer">';
              include 'templates/footbar.php';
      echo '</div>';
    ?>
  </footer>
</html>