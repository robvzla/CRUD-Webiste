<!--
 * Student name: Sirlei Gomes Lucio
 * Student number: 3043602
 *
 * LINK:    https://knuth.griffith.ie/~s3049988/ass03/index.php
-->

<!--Including the header-->
<?php include_once "template/header.php" ?>

<?php
// Sanitization and Validation: Checking if fields are empathy, if empathy trow a error, remove while spaces and check if field have the right format.
$errors = [];

// Creating variables for each input field 
$first_name = "";
$last_name = "";
$phone = "";
$email = $_SESSION["email"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //trim whitespace 
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $phone = trim($_POST['phone']);

    if (empty($first_name)) {   // checking if is empty
        $errors["first_name"] = "Field first name is required";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $first_name)) {
            $errors["first_name"] = "Invalid field! Use only letters "; //regular expression to check if input is letters
        }
    }

    if (empty($last_name)) {  // checking if is empty
        $errors["last_name"] = "Field last name is required";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $last_name)) {
            $errors["last_name"] = "Invalid field! Use only letters "; //regular expression to check if input is letters
        }
    }

    if (empty($phone)) {  // checking if is empty
        $errors["phone"] = "Field phone is required";
    } else {
        if (!preg_match("/^[0-9]\d*$/", $phone)) {
            $errors["phone"] = "Invalid field! Use only numbers "; //regular expression to check if input is numbers
        }
    }

    // If there are no errors, update on the database
    if (empty($errors)) {
        // Connects with the database and stores the upadated user details
        //  Creating query to add the update fields into database
        $query = " UPDATE `user` SET `first_name` = ?, `last_name` = ?, `phone` = ? WHERE `email` = ?";
        $statement = mysqli_prepare($db_connection,$query);

        if ($statement == false){
            echo mysqli_error($db_connection);
        } else {
            mysqli_stmt_bind_param($statement, "ssss", $first_name, $last_name, $phone, $email);
            // execute query 
            mysqli_stmt_execute($statement);

            printf("Error: %s.\n", mysqli_stmt_error($statement));

            //close statement 
            mysqli_stmt_close($statement);
        }

    }
} else {
    // Selecting the data from user in the database.
    $query = "SELECT * FROM `user` WHERE `email` = ?";
    $statement = mysqli_prepare($db_connection, $query);

    if ($statement == false){
        echo mysqli_error($db_connection);
    } else {
        mysqli_stmt_bind_param($statement, "s", $email);
        // execute query 
        mysqli_stmt_execute($statement);
    }

    // Getting the result set from  statement
    $result = mysqli_stmt_get_result($statement);
     // fetching the result row as an associative array
     // Returns an array that corresponds to the fetched row 
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    //close statement 
    mysqli_stmt_close($statement);
    $first_name = $user["first_name"];
    $last_name = $user["last_name"];
    $phone = $user["phone"];
}
?>

<!--A div to wrap the index page-->
<div class="profile wrapper">
    <section class=" form-wrapper app-container">
        <!--A <section> to wrap the h1 and the img-->
        <header>
            <!--A photo icon -->
            <img class="profile--icon" src="./images/profile.png" alt="Profile icon">

            <!--A main heading-->
            <h1 class="app-title_bright app-title">
                My Profile
            </h1>
        </header>
    
         <!--If all the data is right, show message and the data to the user -->
        <div class="form-wrapper--content">
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)): ?>
                <div class="app-container">
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Updated!</h4>
                        <p>Your information has been successfully update.</p>
                    </div>
                </div>
            <?php endif; ?>
    
            <!--Using Ternary operator to decreases the length of code ex: (Condition) ? (Statement1) : (Statement2);
            This method is an alternative for using if-else. -->
             <!-- If there are errors in the fields, field is invalid(display error for the user), else print empathy string -->
            <!--Creating the profile form-->
            <form class="form-wrapper--form" method="POST">
    
                <div class="form--field-group">
                    <div class="form--field">
                        <!--Label for first name-->
                        <label for="first_name" class="profile--form-label">First Name:</label>
                        <input
                            class="form-control <?= isset($errors["first_name"]) ? "is-invalid" : "" ?> "
                            type="text" 
                            name="first_name"
                            value="<?= $first_name?> "
                        >
                        <!--Field is invalid(display error for the user)-->
                        <?php if (isset($errors["first_name"])): ?>
                            <div class="invalid-feedback"><?= $errors["first_name"] ?></div>
                        <?php endif; ?>
                    </div>
    
                    <div class="form--field">
                        <!--Label for last name-->
                        <label for="last_name" class="profile--form-label">Last Name:</label>
                        <input
                            class="form-control <?= isset($errors["last_name"]) ? "is-invalid" : "" ?>"
                            type="text" 
                            name="last_name" 
                            value="<?= $last_name?> "
                        >
                        <!--Field is invalid(display error for the user)-->
                        <?php if (isset($errors["last_name"])): ?>
                            <div class="invalid-feedback"><?= $errors["last_name"] ?></div>
                        <?php endif; ?>
                    </div>
    
                </div>
    
                <div class="form--field">
                    <!--Label for email address-->
                    <label for="email" class="profile--form-label">Email:</label>
                    <input class="form-control"
                     readonly 
                     type="email" 
                     name="email"
                     value="<?= $email ?>"
                    >
                </div>
    
                <div class="form--field">
                    <!--Label for phone number-->
                    <label for="phone" class="profile--form-label">Phone:</label>
                    <input 
                        class="form-control  <?= isset($errors["phone"]) ? "is-invalid" : "" ?> " 
                        type="tel" 
                        name="phone" 
                        value="<?=$phone?>"
                    >
                   <!--Field is invalid(display error for the user)-->
                   <?php if (isset($errors["phone"])): ?>
                            <div class="invalid-feedback"><?= $errors["phone"] ?></div>
                        <?php endif; ?>
                    </div>
    
                <div class="form--submit">
                    <!--Update button-->
                    <button class="app-link_btn app-link_btn-dark">Update</button>
                </div>
            </form>
        </div>

    </section>
</div> 

<!--Including the footer-->
<?php include_once "template/footer.php" ?>