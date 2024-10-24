<!--
 * Student name: Sirlei Gomes Lucio
 * Student number: 3043602
 *
 * LINK:    https://knuth.griffith.ie/~s3049988/ass03/index.php
-->

<!--Including the header-->
<?php include_once "template/header.php" ?>

<!--A div to wrap the activities page-->
<div class="activities">
    <!--A <section> to wrap the content in the page-->
    <section class="app-container background-content">
        <!--A main heading and div to style in css-->
        <div class="activities-container--main">
            <section class="main-tex">
                <h1 class="app-title">Activities</h1>
                <!--A paragraph-->
                <p class="content-text">
                    Play is one of the most important ways in which children learn. It underpins formal learning later in childhood, but also enables the individual child to develop their self-worth.
                    In fact the right to play is deemed so fundamental to children’s wellbeing, that it is enshrined by the UN as a universal children’s right.
                    It strengthens powers of concentration, essential for a successful future in the classroom, and underpins everything from learning social interactions and norms, to the beginnings of scientific thinking.
                </p>
                <!--A h2 tag for the  for lits of activities title-->
                <h2 class="app-subtitle">Here you find all the activities we offer at Children's Cloud</h2>
            </section>
        </div>

        <!--A div to group the imagem and the text-->
        <div class="activities-list dark">
            <!--A sub heading -->
            <h2 class="app-subtitle">Sand Play</h2>
            <!--A photo -->
            <img class="activities-list--image" src="images/kids.jpg">
            <!-- Add a description to the imagem-->
            <figcaption class="activities-list--text">
                <p class="content-text">
                    Sand play is a fantastic opportunity for the foundations of scientific learning,
                    and developing self-confidence and physical development. Scooping, digging, pouring and sifting teaches children how things work,
                    whilst also building their muscles and coordination. Done alongside a little pal, and it becomes about teamwork, sharing, and social skills.
                </p>
            </figcaption>
        </div>

        <!--A div to group the imagem and the text-->
        <div class="activities-list ">
            <!--A sub heading -->
            <h2 class="app-subtitle">Sensory Play</h2>
            <!--A photo -->
            <img lass="activities-list--image" src="images/play-sensory.jpg">
            <!-- Add a description to the imagem-->
            <figcaption class="activities-list--text">
                <p class="content-text">
                    In a nutshell, sensory play is any play activity which involves touch, smell, taste, sight and hearing.
                    This can be provided with a plate of jelly, aqua beads, ice, rice, or even small world tubs.
                    Sensory play stimulates exploration and the building blocks of science and investigation.
                </p>
            </figcaption>
        </div>

        <!--A div to group the imagem and the text-->
        <div class="activities-list dark">
            <!--A sub heading -->
            <h2 class="app-subtitle">Blocks and Shape Sorters</h2>
            <!--A photo -->
            <img lass="activities-list--image" src="images/play-sorts.jpg">
            <!-- Add a description to the imagem-->
            <figcaption class="activities-list--text">
                <p class="content-text">
                    Playing with blocks, jigsaws, and shape sorters all lay the foundations of spatial thinking,
                    logical reasoning, ordering, and recognising various shapes, sizes, and colours.
                </p>
            </figcaption>
        </div>

        <!--A div to group the imagem and the text-->
        <div class="activities-list">
            <!--A sub heading -->
            <h2 class="app-subtitle">Drawing and Painting</h2>
            <!--A photo -->
            <img  class="activities-list--image" src="images/activities-feature01.jpg">
            <!-- Add a description to the imagem-->
            <figcaption class="activities-list--text">
                <p class="content-text">
                    Letting children run wild with paints and drawing tools allows them to experience their world in a sensory way and develop self-expression,
                    whilst also developing pre-writing skills.
                    Furthermore, it’s an invitation to learn about colours, mixing and good-old tidying up!
                </p>
            </figcaption>
        </div>
    </section>
</div>

<!--Including the footer-->
<?php include_once "template/footer.php" ?>