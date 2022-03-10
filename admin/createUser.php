<?php
        //include Configs
        include "../config/config.php";

        if(isset($_POST['Save']))  {
            //Database connection
            $db_host = DB_HOST;
            $db_user = DB_USER;
            $db_password = DB_PASSWORD;
            $db_db = DB_DB;

            $con = mysqli_connect($db_host, $db_user, $db_password, $db_db);

            /**Formular Daten in Variabel speichern */
            $newUsername = $_POST['newUsername'];
            $newPassword = $_POST['newPassword'];
            $newFirstname = $_POST['newFirstname'];
            $newLastname = $_POST['newLastname'];
            $newMail = $_POST['newMail'];

            //Adress
            $newStreet = $_POST['newStreet'];
            $newZip = $_POST['newZIP'];
            $newCity = $_POST['newCity'];
            $newState = $_POST['newState'];

            //Permission
            $newGroup = $_POST['newGroup'];

            $insert = mysqli_query( $con, "INSERT INTO tuser(useLanId, useGroId, useUsername, useFirstname, useLastname, usePassword, useMail, useStreet, useZIP, useCity, useState) VALUES ('2', '$newGroup', '$newUsername', '$newFirstname', '$newLastname', '$newPassword', '$newMail', '$newStreet', '$newZip', '$newCity', '$newState')");

            $username = $_SESSION['client']['useUsername'];
            $password = $_SESSION['client']['usePassword'];

            /**Weiterleitung */
            header( 'Location: userlist.php' );
            } else {
    
            }
        
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo PAGE_NAME ?> | Create a User</title>
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

        <!-- Form -->
        <div class="container" >
            <div>
                <div class="col-md-12 text-center">
                    <h2>Create a new user</h2>
                </div> 
                <hr>
                <h5>User details </h5>
                <hr>
                <form method="POST" action="createUser.php ">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="newFirstname">Firstname</label>
                            <input type="text" class="form-control" id="newFirstname" name="newFirstname" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="newLastname">Lastname</label>
                            <input type="text" class="form-control" id="newLastname" name="newLastname" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="newUsername">Username</label>
                            <input type="text" class="form-control" id="newUsername" name="newUsername" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="newPassword">Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="newMail">Mail</label>
                            <input type="email" class="form-control" id="newMail" name="newMail" required>
                        </div>
                        <hr>
                    </div>              
                    <h5>User adress</h5>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="newState">State</label>
                            <input type="text" class="form-control" id="newState" name="newState" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="newZIP">ZIP</label>
                            <input type="text" class="form-control" id="newZIP" name="newZIP" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="newCity">City</label>
                            <input type="text" class="form-control" id="newCity" name="newCity" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="newStreet">Street</label>
                            <input type="text" class="form-control" id="newStreet" name="newStreet" required>
                        </div>
                        <hr>
                    </div>
                    <h5>Permission</h5>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="newGroup">Group</label>
                            <select id="newGroup" name="newGroup" class="form-control" required>
                                <option value="3" selected>Customer</option>
                                <option value="2">Supporter</option>
                                <option value="1">Administrator</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                        <input class="btn btn-success" type="submit" value="Save" name="Save" />
                        </div>
                    </div>
                    <br>
                </div>
            </form>
        </div>
    </body>
</html>