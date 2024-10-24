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
    //  Using the method to display errors, only for dev purposes
    ini_set('display_errors', 1);
    //  Condition handles when user clicks Sign Up button in signUp.php, it gives a response back to user
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $fullname = $_POST['kidselect'];
        if ($fullname === "No child registered") 
        {
            header("location: ../dailyDetails_parent.php?error=childdoesnotexist");
            exit();
        } 
        else 
        {          
            //  Creating variables for each input field the user fills in at registration
            $separate = explode(" ", $fullname);
            $fname = $separate[0];
            $lname = $separate[1];
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
            if (empty($date) === true) 
            {
                header("location: ../dailyDetails_parent.php?error=emptydate");
                exit();
            }

            //  Get kid details
            $kid = getKid($db_connection, $fname, $lname, $_SESSION["email"]);
            $kidid = $kid["id_kid"];
            $kidfname = $kid["first_name"];
            $kidlname = $kid["last_name"];
            if (kidDetails($db_connection, $kidid, $date) === false) 
            {
                header("location: ../dailyDetails_parent.php?error=norecords");
                exit();
            }
            //  After all validations are done and succesfully passed, we store all data in variable
            $kidDetails = kidDetails($db_connection, $kidid, $date);
            $_SESSION["kidfname"] = $fname;
            $_SESSION["kidlname"] = $lname;
            $_SESSION["temperature"] = $kidDetails["temperature"];
            $_SESSION["breakfast"] = $kidDetails["breakfast"];
            $_SESSION["lunch"] = $kidDetails["lunch"];
            $_SESSION["activities"] = $kidDetails["activities"];
            
            header("location: ../dailyDetails_parent.php");
            exit();
        }
    }
?> 