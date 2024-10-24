<!--
 * Student name: Sirlei Gomes Lucio
 * Student number: 3043602
 *
 * LINK:    https://knuth.griffith.ie/~s3049988/ass03/index.php
-->

<!--Including the header-->
<?php include_once "template/header.php" ?>

<?php
// Sanitization and Validation: Checking if fields are empthy, if empthy trow a error, remove spaces and check if field have the right format.
$errors = [];

// Creating variables for each input field 
$first_name = "";
$last_name = "";
$services= "";
$date= "";
$comment= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    var_dump($_POST);
    //trim whitespace 
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $services = trim($_POST['services']);
    $date = trim($_POST['date']);
    $comment = trim($_POST['comment']);

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

    if (empty($services)) {  // checking if is empty
        $errors["services"] = "Field services is required";
    } 

    if (empty($date)) {  // checking if is empty
        $errors["date"] = "Field date is required";
    } else {
        if (!preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/", $date)) {
            $errors["date"] = "Invalid field format!"; //regular expression to check if input is in the right format
        }
    }

    if (empty($comment)) {  // checking if is empty
        $errors["comment"] = "Field comment is required";
    }
}


// If there are no errors, insert the data on the database
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)) {
    // Connects with the database and stores the testimonial
    //  Creating query to add the testimonial fiells into database
    $query = "INSERT INTO `testimonial` (`first_name`,`last_name`,`services`,`date`,`comment`) VALUES (?,?,?,?,?);";
    $statement = mysqli_prepare($db_connection,$query);

    if ($statement == false){
        echo mysqli_error($db_connection);
    } else {
        mysqli_stmt_bind_param($statement, "sssss", $first_name, $last_name, $services, $date, $comment);
        // execute query 
        mysqli_stmt_execute($statement);

        printf("Error: %s.\n", mysqli_stmt_error($statement));

        //close statement 
        mysqli_stmt_close($statement);

        //Setting values to null after the testimonial is sent.
        $first_name = "";
        $last_name = "";
        $services = "";
        $date = "";
        $comment = "";

    }

}

?>

<!--A div to wrap the index page-->
<div class="profile wrapper">
    <section class=" form-wrapper app-container">
        <!--A <section> -->
        <header>
            <!--A main heading-->
            <h1 class="app-title_bright app-title">
                Testimonial
            </h1>
        </header>

        <div class="form-wrapper--content">
            <!--Using Ternary operator to decreases the length of code ex: (Condition) ? (Statement1) : (Statement2);
            This method is an alternative for using if-else. -->
             <!-- If there are errors in the fields, field is invalid(display error for the user), else print empathy string -->
            <!--Creating the add testimonial form-->
            <form class="form-wrapper--form" method="POST">

                <div class="form--field-group">
                    <div class="form--field">
                        <!--Label for first name-->
                        <label for="first_name" class="profile--form-label">First Name:</label>
                        <input
                            class="form-control <?= isset($errors["first_name"]) ? "is-invalid" : "" ?> "
                            placeholder="Last name..."
                            type="text"
                            name="first_name"
                            value="<?= $first_name ?>"
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
                            placeholder="Last name..."
                            type="text"
                            name="last_name"
                            value="<?= $last_name ?>"
                        >
                        <!--Field is invalid(display error for the user)-->
                        <?php if (isset($errors["last_name"])): ?>
                            <div class="invalid-feedback"><?= $errors["last_name"] ?></div>
                        <?php endif; ?>
                    </div>

                </div>

                <div class="form--field">
                    <!--Label for services name-->
                    <label for="services" class="profile--form-label">Services:</label>
                    <select 
                        id="services" 
                        name="services" 
                        placeholder="select an option..." 
                        class="form-select form-control <?= isset($errors["services"]) ? "is-invalid" : "" ?> "
                        value="<?= $services ?>"
                    >
                        <option value="Nanny">Nanny</option>
                        <option value="Nursery">Nursery</option>
                        <option value="Homebased Childcare">Homebased Childcare</option>
                    </select>
                        <!--Field is invalid(display error for the user)-->
                    <?php if (isset($errors["services"])): ?>
                        <div class="invalid-feedback"><?= $errors["services"] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form--field">
                    <!--Label for Date-->
                    <label class="form-label" for="date">Date:</label>
                    <input 
                        class="form-control <?= isset($errors["date"]) ? "is-invalid" : "" ?> " 
                        type="date" 
                        name="date" 
                        maxlength="12"
                        value="<?= $date ?>"
                    >
                    <!--Field is invalid(display error for the user)-->
                    <?php if (isset($errors["date"])): ?>
                        <div class="invalid-feedback"><?= $errors["date"] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form--field">
                    <!--Label for message-->
                    <label for="comment" class="profile--form-label">Comment:</label>
                    <textarea 
                        name="comment" 
                        rows="5" 
                        class="form-control  <?= isset($errors["comment"]) ? "is-invalid" : "" ?>" 
                        placeholder="Type your testimonial..."
                    ><?= $comment?></textarea>
                    <!--Field is invalid(display error for the user)-->
                    <?php if (isset($errors["comment"])): ?>
                        <div class="invalid-feedback"><?= $errors["comment"] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form--submit">
                    <!--Update button-->
                    <button class="app-link_btn app-link_btn-dark">Submit</button>
                </div>
            </form>
        </div>

        <div class="text-content-left">

        <!--If all the data is right, show to the user -->
        <div class="form-wrapper--content">
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)): ?>
                <div class="app-container">
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Submitted!</h4>
                        <p>Your testimonial has been successfully submitted.</p>
                    </div>
                </div>
            <?php endif; ?>

            <!--A sub heading -->
            <h2 class="index--feature-header app-subtitle"> Let us know your opinion about our services</h2>
            <!-- Add a description to the imagem-->
            <p class="content-text">
                Your experience is very important to us. Please let us know your opinion so we can improve our services.
            </p>
        </div>
    </section>
</div>


<!--Including the footer-->
<?php include_once "template/footer.php" ?>