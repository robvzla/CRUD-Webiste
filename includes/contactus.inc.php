<!--
 * Student name: Jesus Roberto Cassino
 * Student number: 3049988
 *
 * LINK:    https://knuth.griffith.ie/~s3049988/ass03/index.php
-->

<?php

    //  Condition handles when user clicks Sign Up button in signUp.php, it gives a response back to user
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //  Creating variables for each input field the user fills in at registration
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];
        $date = date("Y-m-d");
        $isDuplicate = false;

         //  Importing the database connection and the functions
         require_once('db_conn.php');
         require_once('functions.inc.php');

        //  Sanitizing user input before inserting values into database
        $fname = Sanitization($fname);
        $lname = Sanitization($lname);
        $email = Sanitization($email);
        $phone = Sanitization($phone);
        $message = Sanitization($message);


        /*
        * The if statements below sends back the user to the contact us form
        * if one of the validation fails.
        */
        if (emptyContactForm($fname, $lname, $email, $phone, $message) !== false) 
        {
            header("location: ../contactUs.php?error=emptyinput");
            exit();
        }

        if (invalidEmail($email) !== false) 
        {
            header("location: ../contactUs.php?error=invalidemail");
            exit();
        }

        if (arrayInputContactForm($fname, $lname, $email, $phone, $message) !== false) 
        {
            header("location: ../contactUs.php?error=invalidinput");
            exit();
        }

        if (numericInput($fname, $lname) !== false) 
        {
            header("location: ../contactUs.php?error=invalidinput");
            exit();
        }
        //  After all validations are done and succesfully passed, we insert the message in the database
        sendInquiry($db_connection, $fname, $lname, $email, $phone, $message, $date);
    }
    else
    {
        //  Sends back the user to contact us form if the user tries to access a page without hitting the submit button
        header("location: ../contactUs.php");
        exit();
    }
?> 