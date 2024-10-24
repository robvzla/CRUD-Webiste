<!--
 * Student name: Sirlei Gomes Lucio
 * Student number: 3043602
 *
 * LINK:    https://knuth.griffith.ie/~s3049988/ass03/index.php
-->

<!--Including the header-->
<?php include_once "template/header.php" ?>

<!--A div to wrap the index page-->
<div class="services">
    <div class="app-container">
        <!--A <section> with a class for style.-->
        <div class="services--list">
            <section class="services--introduction">
                <!--A main heading-->
                <h1 class="app-title">
                    Services & Facilities
                </h1>

                <!--A paragraph-->
                <!--- https://cavanccc.ie/parents/types-of-childcare-services/ --->
                <p class="content-text">
                    Here you will be fully informed of the different types of childcare services we offer.
                    This can be a daunting task for any parent and the type of childcare that you need will depend on your needs, your child’s needs and the type of childcare that you prefer.
                    Here we offer a community or privately run, centre based in a childcare facility or home based in your or the carers home.
                </p>
            </section>

            <!--A figure and section tag to group the imagem and the text-->
            <section class="services--item">
                <!--A sub heading -->
                <h2 class="app-subtitle">Nanning Service</h2>
                <!--A photo -->
                <img src="images/nanny.jpg">
                <!-- Add a description to the imagem-->
                <figcaption>
                    <p class="content-text">
                        Find details and discover lots more about Nanning Service:
                        <!-- Hyperlink to activities page-->
                        <a href="nanning_service.php"  class="hyperlink-text" id="services-link">Nanning Service</a>
                    </p>
                </figcaption>
            </section>

            <!--A figure and section tag to group the imagem and the text-->
            <section class="services--item">
                <!--A sub heading -->
                <h2 class="app-subtitle">Nursery Service</h2>
                <!--A photo -->
                <img src="images/nursery.jpg">
                <!-- Add a description to the imagem-->
                <figcaption>
                    <p class="content-text">
                        Find details and discover lots more about Nursery Service:
                        <!-- Hyperlink to activities page-->
                        <a href="nursery_service.php"  class="hyperlink-text" id="services-link">Nursery Service</a>
                    </p>
                </figcaption>
            </section>

            <!--A figure and section tag to group the imagem and the text-->
            <section class="services--item">
                <!--A sub heading -->
                <h2 class="app-subtitle">Homebased Childcare Service</h2>
                <!--A photo -->
                <img src="images/home-base.jpg">
                <!-- Add a description to the imagem-->
                <figcaption>
                    <p class="content-text">
                        Find details and discover lots more about Homebased Childcare Service:
                        <!-- Hyperlink to services page-->
                        <a href="homebased_service.php"  class="hyperlink-text" id="services-link">Homebased Childcare Service</a>
                    </p>
                </figcaption>
            </section>
        </div>
    </div>
</div>

<!--Including the footer-->
<?php include_once "template/footer.php" ?>