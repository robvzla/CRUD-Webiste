<!--
 * Student name: Sirlei Gomes Lucio
 * Student number: 3043602
-->

<!--Including the database connection-->
<?php include_once "includes/db_conn.php" ?>
<?php include_once "includes/functions.inc.php" ?>

<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Add a meta viewport to set a reponsive design-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--A title for the childcare name-->
    <title>Children's Cloud</title>

    <!--Bootstrap and JS CDNs-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!--CSS links-->
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300&family=Nova+Flat&display=swap" rel="stylesheet">
</head>

<body>
    <!-- A main tag to group the main content-->
    <main>
    <!-- The navigation bar-->
<!--nav tag for navigation bar and a class to be able to style in css -->
<nav class="app-navigation navbar">
    <!-- A div to wrap the logo and the nav-->
    <div class="app-container app-header">
        <!-- A div to wrap the logo-->
        <div class="header-logo">
            <a href="index.php" class="nav-logo">
                <img src="images/logo.JPG" alt="logo">
            </a>
        </div>

        <!--ul tag for nav menu and a class to style-->
        <ul class="nav justify-content-end nav-menu">
            <!--li and a tag to link to each page in the nav manu -->
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <!--li and a tag to link to each page in the  nav manu -->
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="services.php">Services</a>
            </li>

            <?php if ((isset($_SESSION["email"]) &&  ($_SESSION["type"] === "Member")) || (!isset($_SESSION["email"]))):  ?>
                <!--li and a tag to link to each page in the nav manu -->
                <li class="nav-item">
                    <a class="nav-link" href="contactUs.php">Contact us</a>
                </li>
            <?php endif; ?>

              <!--Nav with a "More" dropdrown to add the testimonial for member level -->
                <!-- If there is a user logged in with Member credentials, then display member Navegation bar-->
            <?php if (isset($_SESSION["email"]) &&  ($_SESSION["type"] === "Member")): ?>
                <li class='nav-item'><a class='nav-link' href='registerKid.php'>Registration</a></li>
                <!--li and a tag to link to each page in the nav manu -->
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown"
                    >
                        More
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="testimonial_add.php">Add Testimonial</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="dailyDetails_parent.php">Daily Details</a>
                        </li>
                    </ul>
                </li>
                <li class='nav-item dropdown'>
                    <a
                        class='nav-link dropdown-toggle'
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown"
                    >
                        Profile
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="profile.php">Update Profile</a></li>
                        <li><a class='dropdown-item' href='includes/logout.inc.php'>Logout</a></li>
                    </ul>
                </li>
            <?php endif; ?>

               <!--Nav with a "More" dropdrown for Admin level -->
               <!-- If there is a user logged in with Admin credentials, then display Admin Navegation bar-->
               <?php if (isset($_SESSION["email"]) &&  ($_SESSION["type"] === "Admin")): ?>
                <!--li and a tag to link to each page in the nav manu -->
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown"
                    >
                        More
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="dailyDetails.php">Update Daily Details</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="contactUs_manage.php">Manage Contact us</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="updateFees.php">Update Prices</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="testimonial_manage.php">Manage Testimonials</a>
                        </li>
                    </ul>
                </li>
                <li class='nav-item dropdown'>
                    <a
                        class='nav-link dropdown-toggle'
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown"
                    >
                        Profile
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="profile.php">Edit Profile</a></li>
                        <li><a class='dropdown-item' href='includes/logout.inc.php'>Logout</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            <!-- If there is no user logged in yet, then display login form-->
            <?php if (!isset($_SESSION["email"])):  ?>
                <li class='nav-item'><a class='nav-link' href='signIn.php'>Login</a></li>
            <?php endif; ?>
        </ul>
        <div class="hamburger">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </div>
    <!-- End of navigation bar-->
</nav>