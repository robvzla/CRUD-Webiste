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
        $gender = $_POST['gender'];
        $category = $_POST['category'];
        $monday = $_POST['monday'];
        $tuesday = $_POST['tuesday'];
        $wednesday = $_POST['wednesday'];
        $thursday = $_POST['thursday'];
        $friday = $_POST['friday'];
        $hours = $_POST['hours'];

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
        $schoolDays = schoolDays($monday, $tuesday, $wednesday, $thursday, $friday);
        if ((emptyInputRegisterKid($fname, $lname) !== false) || ($schoolDays === 0)) 
        {
            header("location: ../registerKid.php?error=emptyinput");
            exit();
        }

        if (arrayInputRegisterKid($fname, $lname) !== false) 
        {
            header("location: ../registerKid.php?error=invalidinput");
            exit();
        }

        if (numericInput($fname, $lname) !== false) 
        {
            header("location: ../registerKid.php?error=invalidinput");
            exit();
        }
      
        if (userExistsKid($db_connection, $_SESSION["email"], $fname, $lname) !== false) 
        {
            header("location: ../registerKid.php?error=childalreadyexists");
            exit();
        }
        //  Get values for for the school hours and categories inside the database
        $db_categories = getCategory($db_connection, $category);
        $db_id_category = $db_categories["id_categories"];
        $db_type_category = $db_categories["type"];
        $db_price_category = $db_categories["price"];

        $db_hours = getSchoolHours($db_connection, $hours);
        $db_id_hours = $db_hours["id_school_hours"];
        $db_type_hours = $db_hours["type"];
        $db_price_hours = $db_hours["price"];

        //  After all validations are done and succesfully passed, we insert the child in the database
        registerChild($db_connection, $fname, $lname, $gender, $schoolDays, $_SESSION["email"], $db_id_category, $db_id_hours);
    }
    else
    {
        //  Sends back the user to register kid form if the user tries to access a page without hitting the submit button
        header("location: ../registerKid.php");
        exit();
    }
?> 