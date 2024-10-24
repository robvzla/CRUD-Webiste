<!--
 * Student name: Jesus Roberto Cassino
 * Student number: 3049988
 *
 * LINK:    https://knuth.griffith.ie/~s3049988/ass03/index.php
-->

<?php    //  Using the method to display errors, only for dev purposes
    ini_set('display_errors', 1); ?>
<!--Referencing header in template folder-->
<?php include('template/header.php'); ?>
    <!--Main container for the html body-->
    <div class="wrapper">

        <!--Creating the form and linking it to php response page-->
        <form action="includes/signup.inc.php" method="POST" class="signUpForm">
            <!--PHP statements handle the validation responses in the form page-->
            <?php
                /* 
                * If a validation fails it will send an error url. The error is handled by the statements below and displays the
                * the message back to the user in the sign in form.
                */ 
            if (isset($_GET["error"])) 
            {
                if ($_GET["error"] == "emptyinput") 
                {
                    echo ("<p class='error'>All fields are required!</p>");
                }
                elseif ($_GET["error"] == "invalidemail") 
                {
                    echo ("<p class='error'>Invalid Email!</p>");
                }
                elseif ($_GET["error"] == "invalidinput") 
                {
                    echo ("<p class='error'>Invalid input!</p>");
                }
                elseif ($_GET["error"] == "useralreadyexists") 
                {
                    echo ("<p class='error'>User already exists!</p>");
                }
                elseif ($_GET["error"] == "sqlcodenotallowed") 
                {
                    echo ("<p class='error'>SQL commands not allowed!</p>");
                }
                elseif ($_GET["error"] == "invalidphone") 
                {
                    echo ("<p class='error'>Invalid phone number!</p>");
                }
                elseif ($_GET["error"] == "phonelenghtincorrect") 
                {
                    echo ("<p class='error'>Phone lenght must be 10 numbers!</p>");
                }
                elseif ($_GET["error"] == "messagenotsent") 
                {
                    echo ("<p class='error'>Confirmation email could not be sent!</p>");
                }
                elseif ($_GET["error"] == "none") 
                {
                    echo ("<p class='error'>Successfully Signed Up!</p>");
                    echo ("<p class='error'>A confirmation email has been sent!</p>");
                }
            }
            ?>
            <p class="form-title">Sign Up</p>
                <!--Field for first name-->
                <label for="fname" class="form-label">First Name:</label>
                <input type="text" name="fname" placeholder="John" class="form-input">

                <!--Field for last name-->
                <label for="lname" class="form-label">Last Name:</label>
                <input type="text" name="lname" placeholder="Smith" class="form-input">
                <!--Field for email address-->
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" placeholder="john.smith@hotmail.com" class="form-input">

                <!--Field for phone-->
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" name="phone" placeholder="0833457722" class="form-input">

                 <!--Field for password-->
                 <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" placeholder="Password" class="form-input">

                <!--Sign In button-->
                <button type="submit" name="submit" class="login-button">Sign Up</button>

                 <!--Re-directing user to Sign Up page-->
                 <label for="password" class="redirect-label">Already a member? </label>
                 <a class="redirect-reg" href="signIn.php">Sign In</a>
        </form>
    </div>

<!--Referencing footer in template folder-->
<?php include('template/footer.php'); ?>