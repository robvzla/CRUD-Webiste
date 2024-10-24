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
        <p class="form-title">There is no details for the kid in that specific date.</p>
        <p class="form-title">Add kid's daily detail.</p>

        <!--Creating the form and linking it to php response page-->
        <form action="includes/adddetails.inc.php" method="POST" class="signInForm">
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
                }
            ?>
            <p class="form-title">Add Details</p>
                <!--Field for first name-->
                <label for="fname" class="form-label">Kid First Name:</label>
                <div class="primary-keys">
                    <p><?php echo($_SESSION["kidfname"]); ?></p>
                </div>
                <!--Field for last name-->
                <label for="lname" class="form-label">Kid Last Name:</label>
                <div class="primary-keys">
                    <p><?php echo($_SESSION["kidlname"]); ?></p>
                </div>

                <!--field for temperature size-->
                <label for="temperature" class="form-label">Temperature:</label>
                <input type="number" name="temperature" min="10.0" max="100.0" step=".1" placeholder="e.g. 32.8" class="form-input">

                <!--Field for breakfast-->
                <label for="breakfast" class="form-label">Breakfast:</label>
                <input type="text" name="breakfast" placeholder="e.g. Omelet" class="form-input">

                <!--Field for lunch-->
                <label for="lunch" class="form-label">Lunch:</label>
                <input type="text" name="lunch" placeholder="e.g. Pasta" class="form-input">

                <!--Field for lunch-->
                <label for="activities" class="form-label">Activities:</label>
                <input type="text" name="activities" placeholder="e.g. Drawing, ..." class="form-input">

                <!--Sign In button-->
                <button type="submit" class="login-button">Add</button>
        </form>
    </div>
<!--Referencing footer in template folder-->
<?php include('template/footer.php'); ?>