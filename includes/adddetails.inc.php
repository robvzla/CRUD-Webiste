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
        $temperature = $_POST['temperature'];
        $breakfast = $_POST['breakfast'];
        $lunch = $_POST['lunch'];
        $activities = $_POST['activities'];


        //  Importing the database connection and the functions
        require_once('db_conn.php');
        require_once('functions.inc.php');

        //  Sanitizing user input before inserting values into database
        $temperature = Sanitization($temperature);
        $breakfast = Sanitization($breakfast);
        $lunch = Sanitization($lunch);
        $activities = Sanitization($activities);
        
        /*
        * The if statements below sends back the user to the contact us form
        * if one of the validation fails.
        */
        if ((emptyInputSignUp($temperature, $breakfast, $lunch, $activities) !== false)) 
        {
            header("location: ../addDetails.php?error=emptyinput");
            exit();
        }

        if (arrayInput($temperature, $breakfast, $lunch, $activities) !== false) 
        {
            header("location: ../addDetails.php?error=invalidinput");
            exit();
        }

        if (numericInputDailyDetails($breakfast, $lunch, $activities) !== false) 
        {
            header("location: ../addDetails.php?error=invalidinput");
            exit();
        }

        if (numericInputDailyDetailsTemperature($temperature) !== true) 
        {
            header("location: ../addDetails.php?error=invalidinput");
            exit();
        }

        //  After all validations are done and succesfully passed, we insert the child daily details in the database
        addDailyDetail($db_connection, $_SESSION["idkid"], $_SESSION["kidfname"], $_SESSION["kidlname"], $temperature, $breakfast, $lunch, $activities, $_SESSION["date"]);
    }
    else
    {
        //  Sends back the user to register kid form if the user tries to access a page without hitting the submit button
        header("location: ../dailyDetails.php");
        exit();
    }
?> 