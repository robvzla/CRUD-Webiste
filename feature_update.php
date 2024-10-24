<!--
 * Student name: Sirlei Gomes Lucio
 * Student number: 3043602
 *
 * LINK:    https://knuth.griffith.ie/~s3049988/ass03/index.php
-->

<!--Including the header-->
<?php include_once "template/header.php" ?>

<?php

// show all the data about the server "dev"
// phpinfo();

// Sanitization and Validation: Checking if fields are empthy, if empthy trow a error, remove spaces and check if field have the right format.
$errors = [];

// Creating variables for each input field 
$title= "";
$image= "";
$description= "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //trim whitespace 
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
   

    if (empty($title)) {   // checking if is empty
        $errors["title"] = "Field title is required";
    } else {
        if (!preg_match("/^[a-zA-Z ]*$/", $title)) {
            $errors["first_name"] = "Invalid field! Use only letters "; //regular expression to check if input is letters
        }
    }
    // IMAGE File
    // Handle a upload error 
    try {
        switch ($_FILES['image'] ['error']){
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new Exception('No file uploaded');
                break;
            default:
                throw new Exception('An error occurred');
        }

        // array with the allowed image types
        $img_types = ['image/gif', 'image/png', 'image/jpeg'];
        $img_info = finfo_open(FILEINFO_MIME_TYPE);
        $img_type = finfo_file($img_info, $_FILES['image']['tmp_name']);
         // if upload any other type, gonna trow a error
        if(!in_array($img_type, $img_types)){
            throw new Exception('Invalid file type');
        }
        // Move the uploaded File into image folder 
        $image = $_FILES['image']['name'];
        $destination = "./images/" . $image;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)){
            echo " File uploaded successfully";
        } else {
            throw new Exception("Unable to move uploaded file");
        }

    } catch (Exception $e){
        echo $e -> getMessage();
        $errors['image'] = $e->getMessage();
    }

    if (empty($description)) {  // checking if is empty
        $errors["description"] = "Field description is required";
    }
}


// If there are no errors, insert the data on the database
if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)) {

    // Connects with the database and stores the feature information
    //  Creating query to add the testimonial fiells into database
    $query = "UPDATE `feature` SET `title`= ?, `image`= ?,`description` = ? WHERE `id_feature` = ?";
    $statement = mysqli_prepare($db_connection,$query);

    if ($statement == false){
        echo mysqli_error($db_connection);
    } else {
        mysqli_stmt_bind_param($statement, "sssi", $title,$image,$description,$_GET["id"]);
        // execute query 
        mysqli_stmt_execute($statement);

        printf("Error: %s.\n", mysqli_stmt_error($statement));

        //close statement 
        mysqli_stmt_close($statement);
    }
}else {
    // Selecting the data from the database.
    $query = "SELECT * FROM `feature` WHERE `id_feature` = ?";
    $statement = mysqli_prepare($db_connection, $query);

    if ($statement == false){
        echo mysqli_error($db_connection);
    } else {
        $id_feature = 1;
        mysqli_stmt_bind_param($statement, "i", $_GET['id']);
        // execute query 
        mysqli_stmt_execute($statement);
    }

    // Getting the result set from  statement
    $result = mysqli_stmt_get_result($statement);
     // fetching the result row as an associative array
     // Returns an array that corresponds to the fetched row 
    $feature = mysqli_fetch_array($result, MYSQLI_ASSOC);

    //close statement 
    mysqli_stmt_close($statement);
    $title = $feature["title"];
    $image = $feature["image"];
    $description = $feature["description"];
}

?>

<!--A div to wrap the index page-->
<div class="wrapper" id="feature-update">
    <!--If all the data is right, show to the user -->
    <div class="form-wrapper--content">
                <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($errors)): ?>
                    <div class="app-container">
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Updated!</h4>
                            <p>Your information has been successfully update.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
    <section class=" form-wrapper app-container">
        <!--A <section> to wrap the h1 and the img-->
        <header>
            <!--A main heading-->
            <h1 class="app-title_bright app-title">
                Update Feature
            </h1>
        </header>
        <div class="form-wrapper--content">
            <!--Using Ternary operator to decreases the length of code ex: (Condition) ? (Statement1) : (Statement2);
            This method is an alternative for using if-else. -->
             <!-- If there are errors in the fields, field is invalid(display error for the user), else print empathy string -->
            <!--Creating form to upadte feature -->
            <form class="form-wrapper--form" method="POST" enctype="multipart/form-data">

                <div class="form--field">
                    <!--Label for title-->
                    <label for="title" class="profile--form-label">Title:</label>
                    <input
                        class="form-control <?= isset($errors["title"]) ? "is-invalid" : "" ?> "
                        placeholder="Title..."
                        type="text"
                        name="title"
                        value="<?= $title?>"
                    >
                    <!--Field is invalid(display error for the user)-->
                    <?php if (isset($errors["title"])): ?>
                        <div class="invalid-feedback"><?= $errors["title"] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form--field form--field_feature" id="form-field_image">
                    <!--Label for image-->
                    <label for="image" class="profile--form-label">Image:</label>
                    <img class="form-field_image" src="images/<?= $image ?>" />
                    <input
                        class="form-control <?= isset($errors["image"]) ? "is-invalid" : "" ?>"
                        placeholder="Image..."
                        type="file"
                        name="image"
                        value="images/<?= $image?>"
                    >
                    <!--Field is invalid(display error for the user)-->
                    <?php if (isset($errors["image"])): ?>
                        <div class="invalid-feedback"><?= $errors["image"] ?></div>
                    <?php endif; ?>
                </div>

                <div class="form--field">
                    <!--Label for description-->
                    <label for="description" class="profile--form-label">Description:</label>
                    <textarea 
                        name="description" 
                        rows="5" 
                        class="form-control  <?= isset($errors["description"]) ? "is-invalid" : "" ?>" 
                        placeholder="Type your testimonial..."
                    ><?= $description?></textarea>
                    <!--Field is invalid(display error for the user)-->
                    <?php if (isset($errors["description"])): ?>
                        <div class="invalid-feedback"><?= $errors["description"] ?></div>
                    <?php endif; ?>
                </div>
                <div class="form--submit">
                    <!--Update button-->
                    <button class="app-link_btn app-link_btn-dark">Update</button>
                </div>
            </form>
        </div>
    </div>
    </section>
</div>


<!--Including the footer-->
<?php include_once "template/footer.php" ?>