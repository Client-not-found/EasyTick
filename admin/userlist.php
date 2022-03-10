<?php
    /**Session Handling Container erstellen */
    session_start();
    //include Configs
    include "../config/config.php";
    include "../config/language.php";

    //Database connection
    $db_host = DB_HOST;
    $db_user = DB_USER;
    $db_password = DB_PASSWORD;
    $db_db = DB_DB;

    $con = mysqli_connect($db_host, $db_user, $db_password, $db_db);

    function getMessageUserDeleted() {
      echo '<div class="alert alert-success" role="alert">User successfully deleted</div>';
    }

    $username = $_SESSION['client']['useUsername'];
    $password = $_SESSION['client']['usePassword'];

    if(isset($_POST['delete']))  {
      $delete = mysqli_query( $con, "DELETE FROM tUser WHERE $id = useKey");
      header( 'Location: dashboard.php' );
  } else {

  }

    If( !$_SESSION['loggedIn'] ) {
        header( 'Location: index.php' );
    }

        $sql = "SELECT * from tuser";

        $db_erg = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo PAGE_NAME ?> | Edit a user</title>
      <!-- Get Bootstrap -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  </head>


  <body>
  <?php include 'navbar.php'; ?>
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">Info</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="userlist.php">User list</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="knowledgeBase.php">Knowledge base</a>
      </li>
    </ul>

      <!-- Container -->
      <div class="container">
        <h1 class="text-center">User list</h1><br>
              <form method="POST" action="editUser.php ">
                <table class="table col-md-12">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Firstname</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">View</th>   
                    </tr>
                </thead>
                <?php while($row = mysqli_fetch_array( $db_erg, MYSQLI_ASSOC)) {

                echo    '<tbody>';
                echo        '<tr>';
                echo            "<th id='useKey' name='useKey'>".$row['useKey']."</th>";
                echo            '<td>'. $row['useFirstname'].'</td>';
                echo            '<td>'. $row['useLastname'].'</td>';
                echo            '<td><a href="userDetails.php?id='. $row['useKey'] .'" class="btn btn-info" >'. VIEW .'</a></td>';
                echo    '</tbody>'; 
                }
                echo '</table>';
                echo    '<a href="createUser.php" class="btn btn-success table col-md-12" >'. ADD_USER .'</a>';
                mysqli_free_result( $db_erg );
                ?>
            </form>
        </div>
    </body>
</html>