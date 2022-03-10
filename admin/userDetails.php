<?php 
    session_start();

    //include Configs
    include "../config/config.php";
    include "../config/language.php";
    //Database connection
    $db_host = DB_HOST;
    $db_user = DB_USER;
    $db_password = DB_PASSWORD;
    $db_db = DB_DB;

    $id = $_GET['id'];

    $con = mysqli_connect($db_host, $db_user, $db_password, $db_db);
    $user = "SELECT * from tUser WHERE $id = useKey";
    $db_erg = mysqli_query($con, $user);
    $row = mysqli_fetch_array( $db_erg, MYSQLI_ASSOC);

    if(isset($_POST['save']))  {

        /**Formular Daten in Variabel speichern */
        $newUsername = $_POST['newUsername'];
        $newPassword = $_POST['newPassword'];
        $newFirstname = $_POST['newFirstname'];
        $newLastname = $_POST['newLastname'];
        $newMail = $_POST['newMail'];

        //Adress
        $newStreet = $_POST['newStreet'];
        $newZIP = $_POST['newZIP'];
        $newCity = $_POST['newCity'];
        $newState = $_POST['newState'];

        //Permission
        $newGroup = $_POST['newGroup'];

        $save = mysqli_query( $con, "UPDATE tuser SET useGroId = '$newGroup', useFirstname = '$newFirstname', useLastname = '$newLastname' , useUsername = '$newUsername', usePassword = '$newPassword', useMail = '$newMail', useStreet = '$newStreet', useZIP = '$newZIP', useCity = '$newCity', useState = '$newCity' WHERE $id = useKey");
        header('Location: userlist.php');

        } else {

        }

        if(isset($_POST['delete']))  {
            $delete = mysqli_query( $con, "DELETE FROM tuser WHERE $id = useKey");
            header( 'Location: userlist.php' );
            } else {
    
            }
?>

<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title><?php echo PAGE_NAME ?> | User Details</title>
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
            
            <div class="container" >
            <div>
                <div class="col-md-12 text-center">
                    <h2>Create a new user</h2>
                </div> 
                <hr>
                <h5>User details </h5>
                <hr>
                <?php echo '<form action="userDetails.php?id='. $row['useKey'] .'" method="POST">' ?>
                    <div class="row">
                    <input type="hidden" id="id" name="id" value="<?php echo $id?>">
                        <div class="form-group col-md-6">
                            <label for="newFirstname">Firstname</label>
                            <input type="text" class="form-control" id="newFirstname" name="newFirstname" value="<?php echo $row['useFirstname']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="newLastname">Lastname</label>
                            <input type="text" class="form-control" id="newLastname" name="newLastname" value="<?php echo $row['useLastname']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="newUsername">Username</label>
                            <input type="text" class="form-control" id="newUsername" name="newUsername" value="<?php echo $row['useUsername']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="newPassword">Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="newMail">Mail</label>
                            <input type="email" class="form-control" id="newMail" name="newMail" value="<?php echo $row['useMail']; ?>" required>
                        </div>
                        <hr>
                    </div>              
                    <h5>User adress</h5>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="newState">State</label>
                            <input type="text" class="form-control" id="newState" name="newState" value="<?php echo $row['useState']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="newZIP">ZIP</label>
                            <input type="text" class="form-control" id="newZIP" name="newZIP" value="<?php echo $row['useZIP']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="newCity">City</label>
                            <input type="text" class="form-control" id="newCity" name="newCity" value="<?php echo $row['useCity']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="newStreet">Street</label>
                            <input type="text" class="form-control" id="newStreet" name="newStreet" value="<?php echo $row['useStreet']; ?>" required>
                        </div>
                        <hr>
                    </div>
                    <h5>Permission</h5>
                    <hr>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="newGroup">Group</label>
                            <select id="newGroup" name="newGroup" class="form-control" value="<?php echo $row['useGroup']; ?>" required>
                                <option value="3" selected>Customer</option>
                                <option value="2" >Supporter</option>
                                <option value="1" >Administrator</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <input class="btn btn-success" type="submit" value="save" name="save" />
                    <input class="btn btn-danger" type="submit" value="delete" name="delete" />
                    </div>
                    <br>
                </div>
            </form>
        </div>
        </body>
    </html>