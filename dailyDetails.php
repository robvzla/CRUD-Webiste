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
        <form action="includes/dailydetails.inc.php" method="POST" class="searchForm">
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
                    elseif ($_GET["error"] == "childdoesnotexist") 
                    {
                        echo ("<p class='error'>Child does not exists!</p>");
                    }
                    elseif ($_GET["error"] == "sqlcodenotallowed") 
                    {
                        echo ("<p class='error'>SQL commands not allowed!</p>");
                    }
                    elseif ($_GET["error"] == "none") 
                    {
                        echo ("<p class='error'>Daily Detail Succesfully added!</p>");
                    }
                    elseif ($_GET["error"] == "update") 
                    {
                        echo ("<p class='error'>Daily Detail Succesfully updated!</p>");
                    }
                }
                ?>
            <p class="form-title">Search Day Details</p>
                <!--Field for first name-->
                <label for="fname" class="form-label">Kid First Name:</label>
                <input type="text" name="fname" placeholder="Diane" class="form-input">

                <!--Field for last name-->
                <label for="lname" class="form-label">Kid Last Name:</label>
                <input type="text" name="lname" placeholder="Smith" class="form-input">

                <!--Field for email address-->
                <label for="email" class="form-label">Parent's Email:</label>
                <input type="email" name="email" placeholder="john.smith@hotmail.com" class="form-input">

                 <!--Field for Date-->
                <label for="date" class="form-label">Date:</label>
                <input type="date" name="date" maxlength="12" class="form-input">

                <!--Sign In button-->
                <button type="submit" class="login-button bg">Search</button>
        </form>
    </div>
<!--Referencing footer in template folder-->
<?php include('template/footer.php'); ?>