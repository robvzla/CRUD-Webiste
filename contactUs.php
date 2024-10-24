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
        <div class="app-container wrapper-contact">
            <section class="Contact-text-container">
                <h1 class="app-title app-title_bright">Contact Us</h1>
                <p class="contact-text">Need to get in touch with us? Fill out the form with your inquiry and we will contact you as soon as possible.</p>
            </section>
            <!--Creating the form and linking it to php response page-->
            <form action="includes/contactus.inc.php" method="POST" class="contactUsForm">
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
                        elseif ($_GET["error"] == "failedsubmission") 
                        {
                            echo ("<p class='error'>Message was not sent!</p>");
                        }
                        elseif ($_GET["error"] == "sent") 
                        {
                            echo ("<p class='error'>Message successfully sent!</p>");
                        }
                    }
                ?>
                <p class="form-title">Contact Us</p>
                    <!--Field for first name-->
                    <label for="fname" class="form-label">First Name:</label>
                    <input type="text" name="fname" placeholder="John" class="form-input">

                    <!--Field for last name-->
                    <label for="lname" class="form-label">Last Name:</label>
                    <input type="text" name="lname" placeholder="Smith" class="form-input">

                    <!--Field for email address-->
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" placeholder="john.smith@hotmail.com" class="form-input">

                    <!--Field for phone number-->
                    <label for="phone" class="form-label">Phone:</label>
                    <input type="tel" name="phone" placeholder="0833984455" class="form-input">

                    <!--Field for message-->
                    <label for="message" class="form-label">Message:</label>
                    <textarea name="message" rows="5" placeholder="Type your inquiry ..."></textarea>

                    <!--Sign In button-->
                    <button type="submit" class="login-button">Submit</button>
            </form>
        </div>
    </div>
<!--Referencing footer in template folder-->
<?php include('template/footer.php'); ?>