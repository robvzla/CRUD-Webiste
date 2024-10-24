<!--
 * Student name: Jesus Roberto Cassino
 * Student number: 3049988
 *
 * LINK:    https://knuth.griffith.ie/~s3049988/ass03/index.php
-->

<!--Referencing header in template folder-->
<?php include('template/header.php'); ?>
    <!--Main container for the html body-->
    <div class="wrapper">

        <!--Creating the form and linking it to php response page-->
        <form action="includes/signin.inc.php" method="POST" class="signInForm">
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
                    elseif ($_GET["error"] == "wrongpassword") 
                    {
                        echo ("<p class='error'>Wrong password!</p>");
                    }
                    elseif ($_GET["error"] == "userdonotexist") 
                    {
                        echo ("<p class='error'>User does not exist!</p>");
                    }
                }
                ?>
            <p class="form-title">Sign In</p>
                <!--Field for email address-->
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" placeholder="john.smith@hotmail.com" class="form-input">

                 <!--Field for password-->
                 <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" placeholder="Password" class="form-input">

                <!--Sign In button-->
                <button type="submit" class="login-button">Login</button>

                 <!--Re-directing user to Sign Up page-->
                 <label for="signUp" class="redirect-label">Don't have an account? </label>
                 <a class="redirect-reg" href="signUp.php">Sign Up</a>
        </form>
    </div>
<!--Referencing footer in template folder-->
<?php include('template/footer.php'); ?>