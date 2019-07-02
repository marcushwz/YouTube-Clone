<?php 
require_once("includes/config.php");
require_once("includes/classes/formSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

$account = new Account($con);

if(isset($_POST["submitButton"])) {

    $username = formSanitizer::sanitizeFormString($_POST["username"]);
    $password = formSanitizer::sanitizeFormPassword($_POST["password"]);

    $wasSuccessful = $account->login($username, $password);

    if($wasSuccessful) {
        $_SESSION["userLoggedIn"] = $username;
        header("Location: index.php");
    }
}

function getInputValue($name) {
    if(isset($_POST[$name])) {
        echo $_POST[$name];
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title> VideoTube </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="assets/js/commonAction.js"></script>

    </head>
    <body>

        <div class="signInContainer">

            <div class="column">

                <div class="header">
                    <img src="assets/images/icons/VideoTubeLogo.png" title="logo" alt="site logo">
                    <h3>Sign In</h3>
                    <span>to continue to VideoTube</span>
                </div>


                <div class="loginForm">
                    <form action="signin.php" method="POST">

                        <?php echo $account->getError(Constants::$loginFailed); ?>
                        <input type="text" name="username" value="<?php getInputValue('username'); ?>" placeholder="Username" required autocomplete="off">
                        <input type="password" name="password" placeholder="Password" required>
                        <input type="submit" name="submitButton" value="SUBMIT">

                    </form>

                </div>

                <a class="signInMessage" href="signup.php">Need an account? Sign up here!</a>
            </div>

        </div>





    </body>

</html>

