<?php 
require_once("includes/config.php");
require_once("includes/classes/formSanitizer.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");

$account = new Account($con);

if(isset($_POST["submitButton"])) {
    $firstName = formSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = formSanitizer::sanitizeFormString($_POST["lastName"]);

    $username = formSanitizer::sanitizeFormUsername($_POST["username"]);

    $email = formSanitizer::sanitizeFormEmail($_POST["email"]);
    $email2 = formSanitizer::sanitizeFormEmail($_POST["email2"]);
    
    $password = formSanitizer::sanitizeFormPassword($_POST["password"]);
    $password2 = formSanitizer::sanitizeFormPassword($_POST["password2"]);

    $wasSuccessful = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);

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
                    <h3>Sign Up</h3>
                    <span>to continue to VideoTube</span>
                </div>


                <div class="loginForm">
                    <form action="signup.php" method="POST">

                        <?php echo $account->getError(Constants::$firstNameCharacters); ?>

                        <input type="text" name="firstName" value="<?php getInputValue('firstName'); ?>" placeholder="First name" autocomplete="off" required>    

                        <?php echo $account->getError(Constants::$lastNameCharacters); ?>

                        <input type="text" name="lastName" value="<?php getInputValue('lastName'); ?>" placeholder="Last name" autocomplete="off" required>    

                        <?php echo $account->getError(Constants::$usernameCharacters); ?>
                        <?php echo $account->getError(Constants::$usernameTaken); ?>

                        <input type="text" name="username" value="<?php getInputValue('username'); ?>" placeholder="Username" autocomplete="off" required>    

                        <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                        <?php echo $account->getError(Constants::$emailInvalid); ?>
                        <?php echo $account->getError(Constants::$emailTaken); ?>

                        <input type="email" name="email" value="<?php getInputValue('email'); ?>" placeholder="Email" autocomplete="off" required>    
                        <input type="email" name="email2" value="<?php getInputValue('email2'); ?>" placeholder="Confirm email" autocomplete="off" required>    

                        <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                        <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                        <?php echo $account->getError(Constants::$passwordLength); ?>
                        <input type="password" name="password" placeholder="Password" autocomplete="off" required>    
                        <input type="password" name="password2" placeholder="Confirm password" autocomplete="off" required>    

                        <input type="submit" name="submitButton" value="SUBMIT">

                    </form>

                </div>

                <a class="signInMessage" href="signin.php">Already have an account? Sign in here. </a>
            </div>

        </div>





    </body>

</html>

