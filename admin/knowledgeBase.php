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

    $username = $_SESSION['client']['useUsername'];
    $password = $_SESSION['client']['usePassword'];

    if(isset($_POST['delete']))  {
      $id = $_GET['id'];

      $delete = mysqli_query( $con, "DELETE FROM tCategory WHERE $id = catKey");
      $delete2 = mysqli_query( $con, "DELETE FROM tLanguageToCategory WHERE $id = ltcKey");
      header( 'Location: knowledgeBase.php' );
  } else {

  }

  if(isset($_POST['disable']))  {
    $id = $_GET['id'];
    $update = mysqli_query($con, "UPDATE tCategory SET catActive = 0 WHERE $id = catKey");

    header( 'Location: knowledgeBase.php' );
  }   if(isset($_POST['enable']))  {
    $id = $_GET['id'];
    
    $update = mysqli_query($con, "UPDATE tCategory SET catActive = 1 WHERE $id = catKey");
  }

  if(isset($_GET['save']))  {
    $id = $_GET['id'];
    $name = $_GET['category'];

    $save = mysqli_query($con, "INSERT INTO tCategory (catActive) VALUES (true)");
    $last_id = mysqli_insert_id($con);
    $save2 = mysqli_query($con, "INSERT INTO tLanguageToCategory (ltcCatId, ltcLanId, ltcName) VALUES ($last_id, 2, '$name')");

    header( 'Location: knowledgeBase.php' );
  }

    if( !$_SESSION['loggedIn'] ) {
    header( 'Location: index.php' );
    }

        $sql = "SELECT * from tLanguageToCategory JOIN tCategory ON ltcCatId = catKey";

        $db_erg = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo PAGE_NAME ?> | Create a category</title>
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
          <a class="nav-link" href="userlist.php">User list</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="knowledgeBase.php">Knowledge base</a>
        </li>
      </ul>

      <div class="container" >
        <div>
          <div class="col-md-12 text-center">
            <h2>Category</h2>
          </div> 
          <hr>
          <h5>All cateogries</h5>

          <table class="table col-md-12">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">#</th>
                <th scope="col">#</th>     
              </tr>
            </thead>
            <?php while($row = mysqli_fetch_array( $db_erg, MYSQLI_ASSOC)) {

            echo    '<tbody>';
            echo        '<tr>';
            echo            '<th>'. $row['ltcKey'].'</th>';
            echo            '<td>'. $row['ltcName'].'</td>';
            if($row['catActive'] == '1') {
            echo           '<form action="knowledgeBase.php?id='. $row['ltcKey'] .'" method="POST">';
            echo              '<td><input class="btn btn-danger" type="submit" value="disable" name="disable" /></td>';
            echo           '</form>';
            } if($row['catActive'] == '0'){
              echo         '<form action="knowledgeBase.php?id='. $row['ltcKey'] .'" method="POST">';
              echo            '<td><input class="btn btn-success" type="submit" value="enable" name="enable" /></td>';
              echo         '</form>';
            }
            echo          '<form action="knowledgeBase.php?id='. $row['ltcKey'] .'" method="POST">';
            echo            '<td><input class="btn btn-danger" type="submit" value="delete" name="delete" /></td>';
            echo          '</form>';
            echo        '</tr>';
            echo    '</tbody>'; 
            }
          echo '</table>';
          echo '<hr>';
          echo '<h5>New category</h5>';
          echo '<hr>';
          ?>
            <div class="form-group">
            <form method="GET" action="knowledgeBase.php">
              <input type="hidden" id="id" name="id" value="<?php echo $id?>">
                <div class="form-group col-md-6">
                  <label for="category">Name</label>
                  <input type="text" class="form-control" id="category" name="category">
                </div>
                <div class="col-md-3">
                  <button class="btn btn-success" type="submit" value="save" name="save"><?php echo SAVE ?></button>
                </div>
            </form>
        </div>
      </div>  
  </body>
</html>