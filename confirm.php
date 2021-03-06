<!DOCTYPE html>
<!--This page is to confirm that a user has registered-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="registerStyles.css">
        <title>BibTex</title>
    </head>
    <body>
        <?php
            
            session_start();
            //see if there is a session variable with logged in data. If there is redirect to home.php
            //as when someone is already logged in they should be redirected to the home page
            include('database.php');
            if(isset($_SESSION['user_email'])){
                header("Location: home.php");
                exit;
            }
            
            //include the connection information for the database
            include("database.php");
            //take the registration code and if it is the same as the one stored in the database then 
            //set the registration code to null, indicating this is a confirmed user
            $RegCode = filter_input(INPUT_GET, 'RegCode');
            $setRegCode = $connection->prepare("UPDATE user SET reg_code=NULL WHERE reg_code=:reg_code");
            $setRegCode->bindParam(':reg_code', $RegCode);
            $execute = $setRegCode->execute();
            if($execute){
                $message = "<p>Your account has been confirmed!</p>";
            }   else{
                $message = "<p class=\"error\">There was an error registering your account!</p>";
            }

        ?>
        <div id="header" >
            <span><a href="index.php">Login</a></span>&nbsp;|&nbsp;<span><a href="register.php">Register</a></span>
            <span class="right">BibTex!</span>
        </div>
        
        <div class="centerForm">
            <?php echo $message; ?>
            <p>Please login now:</p>
            <a href="index.php">Login</a>
        </div>
    </body>
</html>