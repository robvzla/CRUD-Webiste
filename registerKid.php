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
            <form action="includes/registerkid.inc.php" method="POST" class="registerKid-form">
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
                        elseif ($_GET["error"] == "childalreadyexists") 
                        {
                            echo ("<p class='error'>Child already exists!</p>");
                        }
                        elseif ($_GET["error"] == "sqlcodenotallowed") 
                        {
                            echo ("<p class='error'>SQL commands not allowed!</p>");
                        }
                        elseif ($_GET["error"] == "none") 
                        {
                            echo ("<p class='error'>Thank you</p>");
                            echo ("<p class='error'>Your child has been registered!</p>");
                        }
                }
                ?>
                <p class="form-title">Register Child</p>
                    <!--Field for first name-->
                    <label for="fname" class="form-label">Child First Name:</label>
                    <input type="text" name="fname" placeholder="John" class="form-input">

                    <!--Field for last name-->
                    <label for="lname" class="form-label">Child Last Name:</label>
                    <input type="text" name="lname" placeholder="Smith" class="form-input">

                    <!--Field for kid's gender-->
                    <label for="gender" class="form-label">Gender:</label>
                    <select id="gender" name="gender" class="classic">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>

                    <!--Field for Age Categories-->
                    <label for="category" class="form-label">Age Category:</label>
                    <select id="category" name="category" class="classic" onChange="update()">
                        <option value="baby">Baby</option>
                        <option value="wobbler">Wobbler</option>
                        <option value="toddler">Toddler</option>
                        <option value="preschool">Preschool</option>
                    </select>

                    <!--Field for School Days-->
                    <label for="school-days" class="form-label">School Days:</label>
                    <div class="days-wrapper">
                        <div class="checkbox-container">
                            <input id="monday" type="checkbox" name="monday" value="monday" class="checkboxes" onclick="update()">
                            <label for="monday" class="label-days">Monday</label><br>
                        </div>

                        <div class="checkbox-container">
                            <input id="tuesday" type="checkbox" name="tuesday" value="tuesday" class="checkboxes" onclick="update()">
                            <label for="tuesday" class="label-days">Tuesday</label><br>
                        </div>

                        <div class="checkbox-container">
                            <input id="wednesday" type="checkbox" name="wednesday" value="wednesday" class="checkboxes" onclick="update()">
                            <label for="wednesday" class="label-days">Wednesday</label><br>
                        </div>

                        <div class="checkbox-container">
                            <input id="thursday" type="checkbox" name="thursday" value="thursday" class="checkboxes" onclick="update()">
                            <label for="thursday" class="label-days">Thursday</label><br>
                        </div>

                        <div class="checkbox-container">
                            <input id="friday" type="checkbox" name="friday" value="friday" class="checkboxes" onclick="update()">
                            <label for="friday" class="label-days">Friday</label><br>
                        </div>
                    </div>

                     <!--Field for School Hours-->
                    <label for="hours" class="form-label">School Hours:</label>
                    <select id="hours" name="hours" class="classic" onChange="update()">
                        <option value="half day">Half Day</option>
                        <option value="full day">Full Day</option>
                    </select>

                    <!--Field for Total Amount-->
                    <div class="total-container">
                        <label class="total-label">Total (EUR):</label><span id="amount" class="amount">€</span>
                    </div>

                    <!--Sign In button-->
                    <button type="submit" class="login-button">Submit</button>
            </form>
        </div>
    </div>
    <!--Javascript combines PHP and updates the Total amount section as User selects options in the child registration-->
    <script>
        function update() 
        {
            //  Saving Prices stored in Database into JS variables
            var cat1 = <?php echo $_SESSION['categoryPrice1']; ?>;
            var cat2 = <?php echo $_SESSION['categoryPrice2']; ?>;
            var cat3 = <?php echo $_SESSION['categoryPrice3']; ?>;
            var cat4 = <?php echo $_SESSION['categoryPrice4']; ?>;
            var hours1 = <?php echo $_SESSION['hoursPrice1']; ?>;
            var hours2 = <?php echo $_SESSION['hoursPrice2']; ?>;

            var cat_price = 0;
            var hr_price = 0;
            //  Referencing category section
            var selectCat = document.getElementById('category');
            var optionCat = selectCat.options[selectCat.selectedIndex].value;
            //  Updating total price
            if(optionCat === "baby") 
            {
                cat_price = cat1;
            }
            else if (optionCat === "wobbler")
            {
                cat_price = cat2;
            }
            else if (optionCat === "toddler")
            {
                cat_price = cat3;
            }
            else if (optionCat === "preschool")
            {
                cat_price = cat4;
            }
            //  Referencing school hours section
            var selectHr = document.getElementById('hours');
            var optionHr = selectHr.options[selectHr.selectedIndex].value;
            //  Updating total price
            if(optionHr === "half day") 
            {
                hr_price = hours1;
            }
            else if (optionHr === "full day")
            {
                hr_price = hours2;
            }
            //  Referencing days section
            var monday = document.getElementById("monday").checked
            var tuesday = document.getElementById("tuesday").checked
            var wednesday = document.getElementById("wednesday").checked
            var thursday = document.getElementById("thursday").checked
            var friday = document.getElementById("friday").checked
            var count = 0;
            //  Updating total price
            if (monday) {count++;}
            if (tuesday) {count++;}
            if (wednesday) {count++;}
            if (thursday) {count++;}
            if (friday) {count++;}
            //  Writting total price in HTML section
            document.getElementById('amount').innerHTML="€ "+((cat_price+hr_price)*count);
        }  
    </script>
<!--Referencing footer in template folder-->
<?php include('template/footer.php'); ?>