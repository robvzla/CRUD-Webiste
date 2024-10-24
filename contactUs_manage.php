<!--
 * Student name: Sirlei Gomes Lucio
 * Student number: 3043602
&
 * Student name: Jesus Roberto Cassino
 * Student number: 3049988
 *
 * LINK:    https://knuth.griffith.ie/~s3049988/ass03/index.php
-->

<!--Including the header-->
<?php include_once "template/header.php" ?>
<?php
    //  This will populate the dropdown list for the user to choose among its children.
    //  Importing the database connection and the functions
    require_once('includes/db_conn.php');
    require_once('includes/functions.inc.php');
    //  Create Query
    $query = "SELECT * FROM `contact`;";

    //  Get Result
    $result = mysqli_query($db_connection, $query);

    //  Check if a match is found
    $resultCheck = mysqli_num_rows($result); 
    if($resultCheck > 0)
    {
        //  Assigns all the values as type associative array to var rows
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    $count = 0;
?> 
<div class="wrapper">
    <section class="app-container">
        <!--A <section> to wrap the page content-->
        <header>
            <!--A main heading-->
            <h1 class="app-title_bright contact-main-header">
                Contact us Messages
            </h1>
        </header>

        <div class="content-contact-us">
            <?php
                    if ($resultCheck > 0) 
                    { 
                        ?>
                        <?php foreach ($rows as $row) 
                        { $completeName = $row['first_name']; $completeName .= " "; $completeName .= $row['last_name']; $count++;?>
                            <!-- Section tag to display the user info -->
                            <section class="background-content_contact ">
                                <header class="header-contact">
                                    <span><?php echo($row['date']); ?></span>
                                    <h2><?php echo($completeName); ?></h2>
                                    <button class="app-link_btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample<?php echo($count); ?>">Read</button>
                                </header>
                                <p>
                                <div class="collapse" id="collapseExample<?php echo($count); ?>" >
                                    <div class="card-body">
                                        <?php echo($row['message']); ?>
                                    </div>
                                </div>
                                </p>
                            </section>
                        <?php }  ?>
                <?php } ?> 

                <?php
                    if ($resultCheck === 0) 
                    { 
                        echo("<p class='error'>No messages!</p>");
                    } 
                ?> 
        </div>
    </section>
</div>

<!--Including the footer-->
<?php include_once "template/footer.php" ?>