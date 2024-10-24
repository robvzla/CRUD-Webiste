<!--
 * Student name: Sirlei Gomes Lucio
 * Student number: 3043602
 *
 * LINK:    https://knuth.griffith.ie/~s3049988/ass03/index.php
-->

<!--Including the header-->
<?php include_once "template/header.php" ?>

<?php 

// Creating variable for input field 
$testimonials = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $statusList = isset($_POST["status"]) ? $_POST["status"] : [];

    // Connects with the database and stores the upadated user details
    //  Creating query to add the update fields into database
    $query = " UPDATE `testimonial` SET `status` = 0";
    $statement = mysqli_prepare($db_connection,$query);

    if ($statement == false){
        echo mysqli_error($db_connection);
    } else {
        // execute query 
        mysqli_stmt_execute($statement);

        //close statement 
        mysqli_stmt_close($statement);
    }

    foreach ($statusList as $id => $value) {
        // Connects with the database and stores the upadated user details
        //  Creating query to add the update fields into database
        $query = " UPDATE `testimonial` SET `status` = 1 WHERE `id_testimonials`= ?";
        $statement = mysqli_prepare($db_connection,$query);
    
        if ($statement == false){
            echo mysqli_error($db_connection);
        } else {
            mysqli_stmt_bind_param($statement, "i", $id);
            // execute query 
            mysqli_stmt_execute($statement);

            //close statement 
            mysqli_stmt_close($statement);
        }
    }

}

// Selecting everything from the testimonial table.
$query = "SELECT * FROM `testimonial`";

//  Get Result
$result = mysqli_query($db_connection, $query);
if (!$result) {
    die("Error" . mysqli_error($db_connection));
}

// Creating a array to hold the testimonial data.
$testimonials = [];
while ($row = mysqli_fetch_assoc($result)) {
    array_push($testimonials, $row);
}
?>

<div class="wrapper">
    <section class="app-container">
        <!--A <section> to wrap the page content-->
        <header>
            <!--A main heading-->
            <h1 class="app-title_bright testimonial-manage-main-header">
                Testimonials
            </h1>
                <!--If all the data is right, show to the user -->
                 <div class="form-wrapper--content">
                        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty(!$testimonials)): ?>
                            <div class="app-container">
                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">Updated!</h4>
                                    <p>Your information has been successfully update.</p>
                                </div>
                            </div>
                        <?php endif; ?>
                   </div>
        </header>
        <div>
            <form class="form-wrapper--form" method="POST">
                <!-- Section tag to display the user info -->
                <?php foreach ($testimonials as $testimonial) : ?>
                    <section class="background-content_testimonial">
                        <header class="content-testimonial-manage">
                            <span> <?= $testimonial['date'] ?> </span>
                            <h2><?= $testimonial['first_name'] ?> <?= $testimonial['last_name'] ?></h2>
                            <span><?= $testimonial['services'] ?></span>
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    name="status[<?= $testimonial["id_testimonials"] ?>]"
                                    type="checkbox"
                                    <?= $testimonial["status"] == 1 ? "checked" : "" ?>
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault"></label>
                            </div>
                        </header>
                        <p class="comment"><?= $testimonial['comment'] ?></p>
                    </section>
                <?php endforeach; ?>
                <div class="form--submit">
                    <!--Update button-->
                    <button class="app-link_btn app-link_btn-dark">Update</button>
                </div>
            </form>
    </section>
</div>
</section>
</div>


<!--Including the footer-->
<?php include_once "template/footer.php" ?>