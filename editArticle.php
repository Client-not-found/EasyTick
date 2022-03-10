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

    $id = $_GET['id'];
    $sql = "SELECT * FROM tLanguageToCategory JOIN tCategory on ltcCatId = catKey";
    $article ="SELECT * FROM tArticle where $id = artKey";
    $message ="SELECT artMessage FROM tArticle where $id = artKey";

    $db_erg = mysqli_query($con, $sql);
    $db_article = mysqli_query($con, $article);
    $db_message = mysqli_query($con, $article);
    $db_message = mysqli_query($con, $message);

    $row = mysqli_fetch_array( $db_article, MYSQLI_ASSOC);
    $row2 = mysqli_fetch_array( $db_message, MYSQLI_ASSOC);

    //Variabels for the navbar
    $dashboard = DASHBOARD;
    $create_a_ticket = CREATE_A_TICKET;
    $tickets = TICKETS;
    $knowledge_base = KNOWLEDGE_BASE;
    $administration = ADMINISTRATION;

    if(isset($_POST['Save']))  {

        $newArticleTopic = $_POST['newArticleTopic'];
        $newArticleMessage = $_POST['newArticleMessage'];
        $categoryId = $_POST['newArticleCategory'];

        $newInsert = mysqli_query( $con, "UPDATE tArticle SET artTopic = '$newArticleTopic', artMessage = '$newArticleMessage', artCatId = 'CategoryId' WHERE $id = artKey");
        /**Weiterleitung */
        header( 'Location: knowledgebase.php' );
        } else {

        }
    
?>

<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo PAGE_NAME ?> | <?php echo EDIT_ARTICLE ?></title>
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
            <h1 class="text-center"><?php echo EDIT_ARTICLE ?></h1>
            <?php echo '<form action="editArticle.php?id='. $row['artKey'] .'" method="POST">' ?>
                <div class="row">
                    <div class="from-group col-md-12">
                        <label for="newArticleTopic"><?php echo ARTICLE_TITLE ?></label>
                        <input type="text" id="newArticleTopic" name="newArticleTopic" class="form-control" value="<?php echo $row['artTopic']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="newArticleCategory"><?php echo ARTICLE_CATEGORY ?></label>
                        <select id="newArticleCategory" name="newArticleCategory" class="form-control">
                        <?php while($row = mysqli_fetch_array( $db_erg, MYSQLI_ASSOC)) { ?>
                            <option value="<?php $row['catKey'] ?>"><?php echo  $row['ltcName']  ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="newArticleMessage"><?php echo ARTICLE_MESSAGE ?></label>
                        <textarea class="form-control" id="newArticleMessage" name="newArticleMessage" rows="5" placeholder="<?php echo $row2['artMessage']; ?>" required></textarea>
                    </div>
                </div>
                <input class="btn btn-success" type="submit" value="Save" name="Save" />
                <button class="btn btn-danger" type="reset" value="Reset"><?php echo CANCEL ?></button>
            </form>
        </div>
    </body>

</html>