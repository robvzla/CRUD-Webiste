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
require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception; 
 //  Using the method to display errors, only for dev purposes
 ini_set('display_errors', 1);
/*
*  All the if statements below validates each input field of the form. It checks wether is empty or not and wether
*  the input is valid or not. If it is not valid, an error message is added to the errors array and is displayed.
*/

//  Checks for empty inputs
function emptyInputSignUp($fname, $lname, $email, $password)
{
    $result;
    if (empty($fname) || empty($lname) || empty($email) || empty($password)) 
    {
        $result = true;
    }
    else
    {
        $result = false; 
    }
    return $result;
}

//  Checks for invalid emails
function invalidEmail($email)
{
    $result;
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        $result = true;
    }
    else
    {
        $result = false; 
    }
    return $result;
}

//  Checks if the input is an array and can mess with the database
function arrayInput($fname, $lname, $email, $password)
{
    $result;
    if (is_array($fname) || is_array($lname) || is_array($email) || is_array($password)) 
    {
        $result = true;
    }
    else
    {
        $result = false; 
    }
    return $result;
}

function numericInput($fname, $lname)
{
    $result;
    if (is_numeric($fname) || is_numeric($lname)) 
    {
        $result = true;
    }
    else
    {
        $result = false; 
    }
    return $result;
}

//  Checks if user exist, and if it does it sends all data from the user as a return
function userExists($db_connection, $email)
{
    $query = "SELECT * FROM `user` WHERE  `email` = ?;";
    $statement = mysqli_stmt_init($db_connection);
    if (!mysqli_stmt_prepare($statement, $query)) 
    {
        header("location: ../signUp.php?error=sqlcodenotallowed");
        exit();
    }
    
    mysqli_stmt_bind_param($statement, "s", $email);

    mysqli_stmt_execute($statement);

    $resultData = mysqli_stmt_get_result($statement);

    if ($row = mysqli_fetch_assoc($resultData)) 
    {
        return $row;
    }
    else
    {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($statement);
}

//  Gets all data in the Category table in the database
function getCategoryData($db_connection, $id)
{
    $query = "SELECT * FROM `category` WHERE  `id_categories` = ?;";
    $statement = mysqli_stmt_init($db_connection);
    if (!mysqli_stmt_prepare($statement, $query)) 
    {
        header("location: ../index.php?error=therewasanerror");
        exit();
    }
    
    mysqli_stmt_bind_param($statement, "i", $id);

    mysqli_stmt_execute($statement);

    $resultData = mysqli_stmt_get_result($statement);

    if ($row = mysqli_fetch_assoc($resultData)) 
    {
        return $row;
    }
    else
    {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($statement);
}

//  Gets all data in the Category table in the database
function getHoursData($db_connection, $id)
{
    $query = "SELECT * FROM `school_hour` WHERE  `id_school_hours` = ?;";
    $statement = mysqli_stmt_init($db_connection);
    if (!mysqli_stmt_prepare($statement, $query)) 
    {
        header("location: ../index.php?error=therewasanerror");
        exit();
    }
    
    mysqli_stmt_bind_param($statement, "i", $id);

    mysqli_stmt_execute($statement);

    $resultData = mysqli_stmt_get_result($statement);

    if ($row = mysqli_fetch_assoc($resultData)) 
    {
        return $row;
    }
    else
    {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($statement);
}

// Inserts the new user into the database
function createUser($db_connection, $email, $fname, $lname, $password, $type, $phone)
{
    //  Create Query to add a new user into database
    $query = "INSERT INTO `user` (`email`, `first_name`, `last_name`, `password`, `type`, `phone`) 
    VALUES (?, ?, ?, ?, ?, ?);";
    $statement = mysqli_stmt_init($db_connection);
    if (!mysqli_stmt_prepare($statement, $query)) 
    {
        header("location: ../signUp.php?error=sqlcodenotallowed");
        exit();
    }
    mysqli_stmt_bind_param($statement, "ssssss", $email, $fname, $lname, $password, $type, $phone);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    try
    {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'childrencloud6@gmail.com';                     //SMTP username
        $mail->Password   = '208953b5';                               //SMTP password
        $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
        $mail->Port       = 587; 

        //Sender
        $mail->setFrom('childrencloud6@gmail.com', 'Children Cloud');
        //Recipient
        $mail->addAddress($email); 
        // Body
        $body = "<h1>Welcome to Children Cloud</h1><p>Thank you for registering as a member in the best childcare facility in Europe</p>
        <p>Here is your login details:</p><p>Email: $email</p>
        <p>Password: $password</p>";
        //Parameters
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Welcome to Children Cloud';
        $mail->Body    = $body;
        $nohtml = strip_tags($body);
        $mail->AltBody = $nohtml;
        //Send mail
        $mail->send();
        $mail->smtpClose();
    }
    catch(Exception $e)
    {
        header("location: ../signUp.php?error=messagenotsent");
        exit();
    }
    //Return user back to sign up page
    header("location: ../signUp.php?error=none");
    exit();
}

//  Checks for empty inputs
function emptyInputLogin($email, $password)
{
    $result;
    if (empty($email) || empty($password)) 
    {
        $result = true;
    }
    else
    {
        $result = false; 
    }
    return $result;
}

//  Checks if the input is an array and can mess with the database
function arrayInputLogin($email, $password)
{
    $result;
    if (is_array($email) || is_array($password)) 
    {
        $result = true;
    }
    else
    {
        $result = false; 
    }
    return $result;
}

// Checks if user login correctly and then starts a session so it can be kept logged in.
function loginUser($db_connection, $email, $password)
{
    $userExists = userExists($db_connection, $email);
    $category1 = getCategoryData($db_connection, 1);
    $category2 = getCategoryData($db_connection, 2);
    $category3 = getCategoryData($db_connection, 3);
    $category4 = getCategoryData($db_connection, 4);
    $hours1 = getHoursData($db_connection, 1);
    $hours2 = getHoursData($db_connection, 2);

    // If returns false, it means the user does not exist in database
    if ($userExists === false) 
    {
        header("location: ../signIn.php?error=userdonotexist");
        exit();
    }

    $dbPassword = $userExists["password"];

    if ($dbPassword !== $password) 
    {
        header("location: ../signIn.php?error=wrongpassword");
        exit();
    }
    elseif ($dbPassword === $password) 
    {
        session_start();
        $_SESSION["user_id"] = $userExists["user_id"];
        $_SESSION["fname"] = $userExists["first_name"];
        $_SESSION["lname"] = $userExists["last_name"];
        $_SESSION["password"] = $userExists["password"];
        $_SESSION["email"] = $userExists["email"];
        $_SESSION["type"] = $userExists["type"];

        $_SESSION["categoryPrice1"] = $category1["price"];
        $_SESSION["categoryPrice2"] = $category2["price"];
        $_SESSION["categoryPrice3"] = $category3["price"];
        $_SESSION["categoryPrice4"] = $category4["price"];

        $_SESSION["hoursPrice1"] = $hours1["price"];
        $_SESSION["hoursPrice2"] = $hours2["price"];

        header("location: ../index.php");
        exit();
    }
}

/*
* Disables potential malicious code from data before processing it.
*/
function Sanitization($data)
{
    $data = trim($data);
    $data = strip_tags($data);
    $data = htmlentities($data);
    $data = stripslashes($data);
    return $data;
}

// Checks for empty inputs
function emptyContactForm($fname, $lname, $email, $phone, $message)
{
    $result;
    if (empty($fname) || empty($lname) || empty($email) || empty($phone) || empty($message)) 
    {
        $result = true;
    }
    else
    {
        $result = false; 
    }
    return $result;
}

// Checks if inputs have array that could mess with the database
function arrayInputContactForm($fname, $lname, $email, $phone, $message)
{
    $result;
    if (is_array($fname) || is_array($lname) || is_array($email) || is_array($phone) || is_array($message)) 
    {
        $result = true;
    }
    else
    {
        $result = false; 
    }
    return $result;
}

// Connects with the database and stores the details of the message sent in the contact us form
function sendInquiry($db_connection, $fname, $lname, $email, $phone, $message, $date)
{
    //  Create Query to add a new message into database
    $query = "INSERT INTO `contact` (`first_name`, `last_name`, `email`, `phone`, `message`, `date`) 
            VALUES (?, ?, ?, ?, ?, ?);";
    $statement = mysqli_stmt_init($db_connection);
    if (!mysqli_stmt_prepare($statement, $query)) 
    {
        header("location: ../contactUs.php?error=failedsubmission");
        exit();
    }
    mysqli_stmt_bind_param($statement, "ssssss", $fname, $lname, $email, $phone, $message, $date);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    
    header("location: ../contactUs.php?error=sent");
    exit();
}

// Checks if is a member
function isUserMember() {
    if (!isUserLoggedIn()) {
        return false;
    }
    return $_SESSION["type"] === "Member";
}

// Checks if is a adm
function isUserAdmin() {
    if (!isUserLoggedIn()) {
        return false;
    }
    return $_SESSION["type"] === "Admin";
}

// Checks if user is loggged in.
function isUserLoggedIn() {
    return isset($_SESSION["email"]);
}

function emptyInputRegisterKid($fname, $lname)
{
    $result;
    if (empty($fname) || empty($lname)) 
    {
        $result = true;
    }
    else
    {
        $result = false; 
    }
    return $result; 
}

function schoolDays($monday, $tuesday, $wednesday, $thursday, $friday)
{
    $days = 0;
    if (!empty($monday)) {
        $days++;
    }
    if (!empty($tuesday)) {
        $days++;
    }
    if (!empty($wednesday)) {
        $days++;
    }
    if (!empty($thursday)) {
        $days++;
    }
    if (!empty($friday)) {
        $days++;
    }
    return $days;
}

function arrayInputRegisterKid($fname, $lname)
{
    $result;
    if (is_array($fname) || is_array($lname)) 
    {
        $result = true;
    }
    else
    {
        $result = false; 
    }
    return $result;
}

function userExistsKid($db_connection, $email, $fname, $lname)
{
    $query = "SELECT * FROM `registration` WHERE  `email` = ? AND `first_name` = ? AND `last_name` = ?;";
    $statement = mysqli_stmt_init($db_connection);
    if (!mysqli_stmt_prepare($statement, $query)) 
    {
        header("location: ../registerKid.php?error=sqlcodenotallowed");
        exit();
    }
    mysqli_stmt_bind_param($statement, "sss", $email, $fname, $lname);

    mysqli_stmt_execute($statement);

    $resultData = mysqli_stmt_get_result($statement);

    if ($row = mysqli_fetch_assoc($resultData)) 
    {
        return $row;
    }
    else
    {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($statement); 
}

function registerChild($db_connection, $fname, $lname, $gender, $schoolDays, $email, $db_id_category, $db_id_hours)
{
    //  Create Query to add a new user into database
    $query = "INSERT INTO `registration` (`first_name`, `last_name`, `gender`, `school_days`, `email`, `id_categories`, `id_school_hours`) 
    VALUES (?, ?, ?, ?, ?, ?, ?);";
    $statement = mysqli_stmt_init($db_connection);
    if (!mysqli_stmt_prepare($statement, $query)) 
    {
        header("location: ../registerKid.php?error=sqlcodenotallowed");
        exit();
    }
    mysqli_stmt_bind_param($statement, "sssisii", $fname, $lname, $gender, $schoolDays, $email, $db_id_category, $db_id_hours);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    header("location: ../registerKid.php?error=none");
    exit();
}


function getCategory($db_connection, $category)
{
    $query = "SELECT * FROM `category` WHERE  `type` = ?;";
    $statement = mysqli_stmt_init($db_connection);
    if (!mysqli_stmt_prepare($statement, $query)) 
    {
        header("location: ../registerKid.php?error=sqlcodenotallowed");
        exit();
    }
    
    mysqli_stmt_bind_param($statement, "s", $category);

    mysqli_stmt_execute($statement);

    $resultData = mysqli_stmt_get_result($statement);

    if ($row = mysqli_fetch_assoc($resultData)) 
    {
        return $row;
    }
    else
    {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($statement); 
}

function getSchoolHours($db_connection, $hours)
{
    $query = "SELECT * FROM `school_hour` WHERE  `type` = ?;";
    $statement = mysqli_stmt_init($db_connection);
    if (!mysqli_stmt_prepare($statement, $query)) 
    {
        header("location: ../registerKid.php?error=sqlcodenotallowed");
        exit();
    }
    
    mysqli_stmt_bind_param($statement, "s", $hours);

    mysqli_stmt_execute($statement);

    $resultData = mysqli_stmt_get_result($statement);

    if ($row = mysqli_fetch_assoc($resultData)) 
    {
        return $row;
    }
    else
    {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($statement); 
}

function detailsExists($db_connection, $db_id_child, $fname, $lname, $date)
{
    $query = "SELECT * FROM `daily_detail` WHERE  `id_kid` = ? AND `first_name` = ? AND `last_name` = ? AND `date` = ?;";
    $statement = mysqli_stmt_init($db_connection);
    if (!mysqli_stmt_prepare($statement, $query)) 
    {
        header("location: ../dailyDetails.php?error=sqlcodenotallowed");
        exit();
    }
    
    mysqli_stmt_bind_param($statement, "isss", $db_id_child, $fname, $lname, $date);

    mysqli_stmt_execute($statement);

    $resultData = mysqli_stmt_get_result($statement);

    if ($row = mysqli_fetch_assoc($resultData)) 
    {
        return $row;
    }
    else
    {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($statement); 
}

function numericInputDailyDetails($breakfast, $lunch, $activities)
{
    $result;
    if (is_numeric($breakfast) || is_numeric($lunch) || is_numeric($activities)) 
    {
        $result = true;
    }
    else
    {
        $result = false; 
    }
    return $result;
}

function numericInputDailyDetailsTemperature($temperature)
{
    $result;
    if (is_numeric($temperature)) 
    {
        $result = true;
    }
    else
    {
        $result = false; 
    }
    return $result;
}

function addDailyDetail($db_connection, $idkid, $kidfname, $kidlname, $temperature, $breakfast, $lunch, $activities, $date)
{
    //  Create Query to add a new user into database
    $query = "INSERT INTO `daily_detail` (`id_kid`, `first_name`, `last_name`, `temperature`, `breakfast`, `lunch`, `activities`, `date`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
    $statement = mysqli_stmt_init($db_connection);
    if (!mysqli_stmt_prepare($statement, $query)) 
    {
        header("location: ../addDetails.php?error=sqlcodenotallowed");
        exit();
    }
    mysqli_stmt_bind_param($statement, "issdssss", $idkid, $kidfname, $kidlname, $temperature, $breakfast, $lunch, $activities, $date);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    header("location: ../dailyDetails.php?error=none");
    exit();
}

function updateDailyDetail($db_connection, $temperature, $breakfast, $lunch, $activities, $idkid, $date)
{
    //  Create Query to add a new user into database
    $query = "UPDATE `daily_detail` SET `temperature` = ?, `breakfast` = ?, `lunch` = ?, `activities` = ? WHERE `id_kid` = ? AND `date` = ?;";
    $statement = mysqli_stmt_init($db_connection);
    if (!mysqli_stmt_prepare($statement, $query)) 
    {
        header("location: ../addDetails.php?error=sqlcodenotallowed");
        exit();
    }
    mysqli_stmt_bind_param($statement, "dsssis", $temperature, $breakfast, $lunch, $activities, $idkid, $date);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);

    header("location: ../dailyDetails.php?error=update");
    exit();
}

function getKid($db_connection, $fname, $lname, $email)
{
    //  Create Query to add a new user into database
    $query = "SELECT * FROM `registration` WHERE  `first_name` = ? AND `last_name` = ? AND `email` = ?;";
    $statement = mysqli_stmt_init($db_connection);
    if (!mysqli_stmt_prepare($statement, $query)) 
    {
        header("location: ../dailyDetails_parent.php?error=sqlcodenotallowed");
        exit();
    }
    mysqli_stmt_bind_param($statement, "sss", $fname, $lname, $email);
    mysqli_stmt_execute($statement);

    $resultData = mysqli_stmt_get_result($statement);

    if ($row = mysqli_fetch_assoc($resultData)) 
    {
        return $row;
    }
    else
    {
        mysqli_stmt_close($statement);
        $result = false;
        return $result;
    }
}

function kidDetails($db_connection, $kidid, $date)
{
    $query = "SELECT * FROM `daily_detail` WHERE  `id_kid` = ? AND `date` = ?;";
    $statement = mysqli_stmt_init($db_connection);
    if (!mysqli_stmt_prepare($statement, $query)) 
    {
        header("location: ../signUp.php?error=sqlcodenotallowed");
        exit();
    }
    
    mysqli_stmt_bind_param($statement, "is", $kidid, $date);

    mysqli_stmt_execute($statement);

    $resultData = mysqli_stmt_get_result($statement);

    if ($row = mysqli_fetch_assoc($resultData)) 
    {
        return $row;
    }
    else
    {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($statement);
}

//  Checks for empty inputs
function emptyFees($cat1, $cat2, $cat3, $cat4, $hr1, $hr2)
{
    $result;
    if (empty($cat1) || empty($cat2) || empty($cat3) || empty($cat4) || empty($hr1) || empty($hr2)) 
    {
        $result = true;
    }
    else
    {
        $result = false; 
    }
    return $result;
}

//  Checks if the input is an array and can mess with the database
function arrayFees($cat1, $cat2, $cat3, $cat4, $hr1, $hr2)
{
    $result;
    if (is_array($cat1) || is_array($cat2) || is_array($cat3) || is_array($cat4) || is_array($hr1) || is_array($hr2)) 
    {
        $result = true;
    }
    else
    {
        $result = false; 
    }
    return $result;
}

function invalidFees($cat1, $cat2, $cat3, $cat4, $hr1, $hr2)
{
    $result;
    if (is_string($cat1) || is_string($cat2) || is_string($cat3) || is_string($cat4) || is_string($hr1) || is_string($hr2)) 
    {
        $result = true;
    }
    else
    {
        $result = false; 
    }
    return $result;
}

function updateFeesCategories($db_connection, $category, $id_category)
{
    //  Create Query to add a new user into database
    $query = "UPDATE `category` SET `price` = ? WHERE `id_categories` = ?;";
    $statement = mysqli_stmt_init($db_connection);
    if (!mysqli_stmt_prepare($statement, $query)) 
    {
        header("location: ../updateFees.php?error=sqlcodenotallowed");
        exit();
    }
    mysqli_stmt_bind_param($statement, "di", $category, $id_category);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
}

function updateFeesHours($db_connection, $hour, $id_hour)
{
    //  Create Query to add a new user into database
    $query = "UPDATE `school_hour` SET `price` = ? WHERE `id_school_hours` = ?;";
    $statement = mysqli_stmt_init($db_connection);
    if (!mysqli_stmt_prepare($statement, $query)) 
    {
        header("location: ../addDetails.php?error=sqlcodenotallowed");
        exit();
    }
    mysqli_stmt_bind_param($statement, "di", $hour, $id_hour);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
}

//  Checks for empty inputs
function emptyInputSignUpPhone($fname, $lname, $email, $password, $phone)
{
    $result;
    if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($phone)) 
    {
        $result = true;
    }
    else
    {
        $result = false; 
    }
    return $result;
}

//  Checks if the input is an array and can mess with the database
function arrayInputPhone($fname, $lname, $email, $password, $phone)
{
    $result;
    if (is_array($fname) || is_array($lname) || is_array($email) || is_array($password) || is_array($phone)) 
    {
        $result = true;
    }
    else
    {
        $result = false; 
    }
    return $result;
}

//  Checks if the input a valid phone numeric 
function phoneValid($phone)
{
    $result;
    if (is_numeric($phone)) 
    {
        $result = true;
    }
    else
    {
        $result = false; 
    }
    return $result;
}

function phoneLenght($phone)
{
    $result;
    if (strlen($phone) === 10) 
    {
        $result = true;
    }
    else
    {
        $result = false; 
    }
    return $result;
}

?>