<!--
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
        $email = $_POST['email'];
        $password = $_POST['password'];

        //  Importing the database connection and the functions
        require_once('db_conn.php');
        require_once('functions.inc.php');

        //  Sanitizing user input before inserting values into database
        $email = Sanitization($email);
        $password = Sanitization($password);


        /*
        * The if statements below sends back the user to the contact us form
        * if one of the validation fails.
        */
        if (emptyInputLogin($email, $password) !== false) 
        {
            header("location: ../signIn.php?error=emptyinput");
            exit();
        }

        if (invalidEmail($email) !== false) 
        {
            header("location: ../signUp.php?error=invalidemail");
            exit();
        }

        if (arrayInputLogin($email, $password) !== false) 
        {
            header("location: ../signUp.php?error=invalidinput");
            exit();
        }
        //  After all validations are done and succesfully passed, we login the user
        loginUser($db_connection, $email, $password);
    }
    else
    {
        //  Sends back the user to contact us form if the user tries to access a page without hitting the submit button
        header("location: ../signIn.php");
        exit();
    }
?> 