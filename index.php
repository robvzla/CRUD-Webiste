<!--
 * Student name: Sirlei Gomes Lucio
 * Student number: 3043602
 *
 * LINK:    https://knuth.griffith.ie/~s3049988/ass03/index.php
-->

<!--Including the header-->
<!--Including the database connection-->
<?php include_once "includes/db_conn.php" ?>
<?php include_once "template/header.php" ?>


<?php
    // Selecting everything from the testimonial table.
    $query = "SELECT * FROM `testimonial` WHERE `status` = 1 LIMIT 4";

    //  Get Result
    $result = mysqli_query($db_connection, $query);
    if (!$result) {
        die("Error" . mysqli_error($db_connection));
    }

    // Creating a array to hold the testimonial data.
    $testimonials = [];
    while($row = mysqli_fetch_assoc($result)) {
        array_push($testimonials, $row);
    }

    // Using array_rand(), gonna get a random testimonial everytime the page refresh;
    $randomIndex = array_rand($testimonials);
    $testimonial = $testimonials[$randomIndex];

?>

<?php
    // Selecting everything from the testimonial table.
    $query = "SELECT * FROM `feature`";

    //  Get Result
    $featureResult = mysqli_query($db_connection, $query);
    if (!$featureResult) {
        die("Error" . mysqli_error($db_connection));
    }

    // Creating a array to hold the testimonial data.
    $features = [];
    while($row = mysqli_fetch_assoc($featureResult)) {
        array_push($features, $row);
    }

?>

<!--A div to wrap the index page-->
<div class="index">
    <!--A <section> with a class content.-->
    <section class="content">
        <!--A main heading and div to style in css-->
        <div class="index-container--main app-container">
            <section class="index--introduction">
                <h1 class="app-title">Welcome to Children's Cloud</h1>

                <!--A paragraph-->
                <!--- https://www.earlychildhoodireland.ie/ --->
                <p class="content-text">
                    Join Children's Cloud today and become part of the leading childcare in the sector working to ensure quality experiences for children in early learning.
                    As an leading childcare, we are fully committed to supporting you to provide quality experiences for children.
                    Our strategies are based on professional experience and on national and international research, policy and best practice.
                    We combine the extensive knowledge and experiences of our membership with wider range of services and support.
                </p>
            </section>

            <?php foreach($features as $feature): ?>
                <!--A section to group the imagem and the text-->
                <section class="index--feature">
                    <!--A sub heading -->
                    <h2 class="index--feature-header app-subtitle"><?= $feature['title'] ?></h2>
                    <!--A photo -->
                    <img src="images/<?= $feature['image'] ?>">
                    <!-- Add a description to the imagem-->
                    <figcaption>
                        <p class="content-text">
                            <?= $feature['description'] ?>
                        </p>
                    </figcaption>
                     <!-- Footer tag for the link button -->
                    <footer>
                        <!-- Hyperlink to activities page-->
                        <a class="app-link_btn" href="<?= $feature["page_link"] ?>">Go to <?= $feature['title']?></a>
                    </footer>
                    <!-- If there is a user logged in with Admin credentials, then display update button-->
                   <?php if (isset($_SESSION["email"]) &&  ($_SESSION["type"] === "Admin")): ?>
                    <!-- Footer tag for the link button -->
                    <footer>
                        <!-- Hyperlink to  update page-->
                        <a class="app-link_btn" href="feature_update.php?id=<?= $feature["id_feature"]?>">
                            Update <?= $feature["title"] ?>
                        </a>
                    </footer>
                     <?php endif; ?>
                </section>
            <?php endforeach; ?>

        </div>

        <!--A div to style with css-->
        <div class="index-container--choose">
            <div class="app-container">
                <!--A sub heading -->
                <h2 class="app-title">Why choose us</h2>
                <!-- A paragraph -->
                <!-- https://www.earlychildhoodireland.ie/about/ --->
                <p class="content-text">
                    We have always believed that early childhood is a critical period for the nurturing of each individual child’s curiosity,
                    resilience, creativity, confidence and potential.
                    We also believe that play is a right and is a key learning pathway in the lives of children.
                    We are a professional and innovative membership organisation that works collaboratively with the relevant government departments,
                    agencies and academic institutions to champion our vision and realise our mission.
                </p>
            </div>
        </div>

        <!--A section to group the gallery images and title-->
        <section class="index--gallery">
            <header class="app-container">
                <!--A sub heading -->
                <h2 class="index--gallery-header app-title">Our Gallery</h2>
            </header>
            <!--A div to style with css-->
            <div class="index-container--gallery app-container">
                <!--A photo -->
                <img src="images/family-draw.jpg">
                <!--A photo -->
                <img src="images/kid-pool.jpg">
                <!--A photo -->
                <img src="images/kid-class.jpg">
                <!--A photo -->
                <img src="images/kids.jpg">
                <!--A photo -->
                <img src="images/Alices-adventures-in-wonderland.jpeg">
                <!--A photo -->
                <img src="images/home-base.jpg">
            </div>
        </section>

        <!--A div to style with css-->
        <div class="index-container--testimonial">
            <div class="app-container">
                <!--A sub heading -->
                <h2 class="app-title">Testimonials</h2>

                   <!--style with bootstrap; indicators to the carousel, alongside the controls buttons-->
                <div id="carouselTestimonialsIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php foreach ($testimonials as $testimonial => $index): ?>
                            <button
                                type="button"
                                data-bs-target="#carouselTestimonialsIndicators"
                                data-bs-slide-to="<?= $index ?>"
                                class="active"
                                aria-current="true"
                                aria-label="Slide <?= $index ?>"
                            ></button>
                        <?php endforeach; ?>
                    </div>
                    <div class="carousel-inner">
                        <?php foreach ($testimonials as $index => $testimonial): ?>
                            <div class="carousel-item <?= $index == 0 ? "active" : "" ?>">
                                <!-- A paragraph -->
                                <p class="testimonial--container">
                                    <!-- the tetimonial discription-->
                                    <span class="testimonial--title"><?= $testimonial["services"] ?></span>
                                    <span class="testimonial--content">"<?= $testimonial["comment"] ?>”</span>
                                    <!--A span for the member name -->
                                    <span>
                                        <strong><?= $testimonial["first_name"] . " " . $testimonial["last_name"] ?> - </strong> 
                                        <?= $testimonial["date"] ?>
                                    </span>
                                </p>

                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselTestimonialsIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselTestimonialsIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>

<!--Including the footer-->
<?php include_once "template/footer.php" ?>