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
        <div class="container-reg-form">
            <!--Creating the form and linking it to php response page-->
            <form action="includes/updatefees.inc.php" method="POST" class="registerKid-form">
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
                        elseif ($_GET["error"] == "sqlcodenotallowed") 
                        {
                            echo ("<p class='error'>SQL commands not allowed!</p>");
                        }
                        elseif ($_GET["error"] == "update") 
                        {
                            echo ("<p class='error'>Thank you</p>");
                            echo ("<p class='error'>The fees has been updated!</p>");
                        }
                }
                ?>
                <p class="form-title">Update Registration Fees</p>
                    <!--Fields for all categories-->
                    <label for="categories" class="form-label">Age Categories:</label>

                    <label for="categories" class="form-label">Baby:</label>
                    <input type="number" name="category1" placeholder="e.g. 200" value="<?php echo($_SESSION["categoryPrice1"]); ?>" class="form-input spacer">
                    <label for="categories" class="form-label">Wobbler:</label>
                    <input type="number" name="category2" placeholder="e.g. 200" value="<?php echo($_SESSION["categoryPrice2"]); ?>" class="form-input spacer">
                    <label for="categories" class="form-label">Toddler:</label>
                    <input type="number" name="category3" placeholder="e.g. 200" value="<?php echo($_SESSION["categoryPrice3"]); ?>" class="form-input spacer">
                    <label for="categories" class="form-label">Preeschool:</label>
                    <input type="number" name="category4" placeholder="e.g. 200" value="<?php echo($_SESSION["categoryPrice4"]); ?>" class="form-input spacer">

                    <!--Field for last name-->
                    <label for="lname" class="form-label">School Hours:</label>
                    <label for="categories" class="form-label">Half Day:</label>
                    <input type="number" name="hours1" placeholder="e.g. 200" value="<?php echo($_SESSION["hoursPrice1"]); ?>" class="form-input spacer">
                    <label for="categories" class="form-label">Full Day:</label>
                    <input type="number" name="hours2" placeholder="e.g. 200" value="<?php echo($_SESSION["hoursPrice2"]); ?>" class="form-input spacer">

                    <!--Sign In button-->
                    <button type="submit" class="login-button">Update</button>
            </form>
        </div>
    </div>

<!--Referencing footer in template folder-->
<?php include('template/footer.php'); ?>