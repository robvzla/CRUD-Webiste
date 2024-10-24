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
        $password = $_POST['password'];
        $type = "Member";
        $isDuplicate = false;

        //  Importing the database connection and the functions
        require_once('db_conn.php');
        require_once('functions.inc.php');

        //  Sanitizing user input before inserting values into database
        $fname = Sanitization($fname);
        $lname = Sanitization($lname);
        $email = Sanitization($email);
        $phone = Sanitization($phone);
        $password = Sanitization($password);


        /*
        * The if statements below sends back the user to the contact us form
        * if one of the validation fails.
        */
        if (emptyInputSignUpPhone($fname, $lname, $email, $password, $phone) !== false) 
        {
            header("location: ../signUp.php?error=emptyinput");
            exit();
        }

        if (invalidEmail($email) !== false) 
        {
            header("location: ../signUp.php?error=invalidemail");
            exit();
        }

        if (arrayInputPhone($fname, $lname, $email, $password, $phone) !== false) 
        {
            header("location: ../signUp.php?error=invalidinput");
            exit();
        }

        if (numericInput($fname, $lname) !== false) 
        {
            header("location: ../signUp.php?error=invalidinput");
            exit();
        }

        if (phoneValid($phone) === false) 
        {
            header("location: ../signUp.php?error=invalidphone");
            exit();
        }

        if (phoneLenght($phone) === false) 
        {
            header("location: ../signUp.php?error=phonelenghtincorrect");
            exit();
        }

        if (userExists($db_connection, $email) !== false) 
        {
            header("location: ../signUp.php?error=useralreadyexists");
            exit();
        }
        //  After all validations are done and succesfully passed, we insert the user in the database
        createUser($db_connection, $email, $fname, $lname, $password, $type, $phone);
    }
    else
    {
        //  Sends back the user to contact us form if the user tries to access a page without hitting the submit button
        header("location: ../signUp.php");
        exit();
    }
?> 