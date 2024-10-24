<!--
 * Student name: Sirlei Gomes Lucio
 * Student number: 3043602
&
 * Student name: Jesus Roberto Cassino
 * Student number: 3049988
 *
 * LINK:    https://knuth.griffith.ie/~s3049988/ass03/index.php
-->

<?php
    //  Using the method to display errors, only for dev purposes
    ini_set('display_errors', 1);
    //  Condition handles when user clicks Sign Up button in signUp.php, it gives a response back to user
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //  Creating variables for each input field the user fills in at registration
        $cat1 = $_POST['category1'];
        $cat2 = $_POST['category2'];
        $cat3 = $_POST['category3'];
        $cat4 = $_POST['category4'];
        $hr1 = $_POST['hours1'];
        $hr2 = $_POST['hours2'];

        //  Importing the database connection and the functions
        require_once('db_conn.php');
        require_once('functions.inc.php');

        //  Sanitizing user input before inserting values into database
        $cat1 = Sanitization($cat1);
        $cat2 = Sanitization($cat2);
        $cat3 = Sanitization($cat3);
        $cat4 = Sanitization($cat4);
        $hr1 = Sanitization($hr1);
        $hr2 = Sanitization($hr2);


        /*
        * The if statements below sends back the user to the contact us form
        * if one of the validation fails.
        */
        if (emptyFees($cat1, $cat2, $cat3, $cat4, $hr1, $hr2) !== false) 
        {
            header("location: ../updateFees.php?error=emptyinput");
            exit();
        }

        if (invalidFees($cat1, $cat2, $cat3, $cat4, $hr1, $hr2) === 1) 
        {
            header("location: ../updateFees.php?error=invalidinput");
            exit();
        }

        if (arrayFees($cat1, $cat2, $cat3, $cat4, $hr1, $hr2) !== false) 
        {
            header("location: ../updateFees.php?error=invalidinput");
            exit();
        }
        //  After all validations are done and succesfully passed, we update fees table in database
        updateFeesCategories($db_connection, $cat1, 1);
        updateFeesCategories($db_connection, $cat2, 2);
        updateFeesCategories($db_connection, $cat3, 3);
        updateFeesCategories($db_connection, $cat4, 4);
        updateFeesHours($db_connection, $hr1, 1);
        updateFeesHours($db_connection, $hr2, 2);

        header("location: ../updateFees.php?error=update");
        exit();
    }
    else
    {
        //  Sends back the user to contact us form if the user tries to access a page without hitting the submit button
        header("location: ../updateFees.php");
        exit();
    }
?> 