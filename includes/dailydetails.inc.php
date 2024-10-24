<!--
 * Student name: Jesus Roberto Cassino
 * Student number: 3049988
 *
 * LINK:    https://knuth.griffith.ie/~s3049988/ass03/index.php
-->
<?php
    session_start();
?>
<?php
    //  Condition handles when user clicks Sign Up button in signUp.php, it gives a response back to user
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //  Creating variables for each input field the user fills in at registration
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $date = $_POST['date'];

        //  Importing the database connection and the functions
        require_once('db_conn.php');
        require_once('functions.inc.php');

        //  Sanitizing user input before inserting values into database
        $fname = Sanitization($fname);
        $lname = Sanitization($lname);
        
        /*
        * The if statements below sends back the user to the contact us form
        * if one of the validation fails.
        */
        if (emptyInputRegisterKid($fname, $lname) !== false) 
        {
            header("location: ../dailyDetails.php?error=emptyinput");
            exit();
        }

        if (arrayInputRegisterKid($fname, $lname) !== false) 
        {
            header("location: ../dailyDetails.php?error=invalidinput");
            exit();
        }

        if (numericInput($fname, $lname) !== false) 
        {
            header("location: ../dailyDetails.php?error=invalidinput");
            exit();
        }

        if (invalidEmail($email) !== false) 
        {
            header("location: ../dailyDetails.php?error=invalidemail");
            exit();
        }
      
        if (userExistsKid($db_connection, $email, $fname, $lname) === false) 
        {
            header("location: ../dailyDetails.php?error=childdoesnotexist");
            exit();
        }
        //  Get values for the requested child inside the database
        $db_child = userExistsKid($db_connection, $email, $fname, $lname);
        $db_id_child = $db_child["id_kid"];

        $db_detail = detailsExists($db_connection, $db_id_child, $fname, $lname, $date);

        $_SESSION["idkid"] = $db_child["id_kid"];
        $_SESSION["kidfname"] = $db_child["first_name"];
        $_SESSION["kidlname"] = $db_child["last_name"];
        $_SESSION["parentemail"] = $db_child["email"];
        $_SESSION["date"] = $date;

        $_SESSION["iddetail"] = $db_detail["id_details"];
        $_SESSION["temperaturedetail"] = $db_detail["temperature"];
        $_SESSION["breakfastdetail"] = $db_detail["breakfast"];
        $_SESSION["lunchdetail"] = $db_detail["lunch"];
        $_SESSION["activitiesdetail"] = $db_detail["activities"];

        //  Check if a detail is already set for the required date.
        if (detailsExists($db_connection, $db_id_child, $fname, $lname, $date) === false) 
        {
            header("location: ../addDetails.php");
            exit();
        }
        else
        {
            header("location: ../updateDetails.php");
            exit();
        }

        //  After all validations are done and succesfully passed, we insert the child in the database
        // registerChild($db_connection, $fname, $lname, $gender, $schoolDays, $_SESSION["email"], $db_id_category, $db_id_hours);
    }
    else
    {
        //  Sends back the user to daily detail form if the user tries to access a page without hitting the submit button
        header("location: ../dailyDetails.php");
        exit();
    }
?> 