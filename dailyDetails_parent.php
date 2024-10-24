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
    require_once('includes/dailyparent.inc.php');
    $email = $_SESSION["email"];
    //  Create Query
    $query = "SELECT * FROM `registration` WHERE `email` = '$email';";

    //  Get Result
    $result = mysqli_query($db_connection, $query);

    //  Check if a match is found
    $resultCheck = mysqli_num_rows($result); 
    if($resultCheck > 0)
    {
        //  Assigns all the values as type associative array to var rows
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
?> 



<div class="wrapper">
    <section class="app-container child-details--content">
        <!--A <section> to wrap the page content-->
        <header class="child-details--header">
            <!--A main heading-->
            <h1 class="app-title_bright app-title">
                Child Daily Details
            </h1>
        </header>

        <!--Creating the daily details form search a date -->
        <form action="includes/dailyparent.inc.php" class="child-details--form" method="POST">

            <!--PHP statements handle the validation responses in the form page-->
            <?php
                /* 
                * If a validation fails it will send an error url. The error is handled by the statements below and displays the
                * the message back to the user in the sign in form.
                */ 
                if (isset($_GET["error"])) 
                {
                    if ($_GET["error"] == "childdoesnotexist") 
                    {
                        echo ("<p class='error'>Child is not registered yet!</p>");
                    }
                    elseif ($_GET["error"] == "sqlcodenotallowed") 
                    {
                        echo ("<p class='error'>SQL commands not allowed!</p>");
                    }
                    elseif ($_GET["error"] == "emptydate") 
                    {
                        echo ("<p class='error'>Date is Required!</p>");
                    }
                    elseif ($_GET["error"] == "norecords") 
                    {
                        echo ("<p class='error'>There is no Record for that date!</p>");
                    }
                }
            ?>

            <!--Field for Age Categories-->
            <label for="kidselect" class="form-label">Select your Kid:</label>
            <select id="kids" name="kidselect" class="classic">
                <?php
                    if ($resultCheck > 0) 
                    { 
                        ?>
                        <?php foreach ($rows as $row) 
                        { $completeName = $row['first_name']; $completeName .= " "; $completeName .= $row['last_name'];?>
                            <option value="<?php echo($completeName); ?>"> <?php echo($completeName); ?> </option>
                        <?php }  ?>
                <?php } ?> 

                <?php
                    if ($resultCheck === 0) 
                    { 
                        ?>
                        <option value="No child registered">No child registered</option>
                <?php } ?> 
            </select>

            <div>
                <!--Field for Date-->
                <label class="form-label" for="date">Date:</label>
                <input class="form-control" type="date" name="date" maxlength="12" >
            </div>
            <div> 
                <!--Search button-->
                <button  class="app-link_btn app-link_btn-dark" >Search</button>
            </div>
        </form>

        <!--Table tag to display the child information daily details -->
        <table class="table child-details--table">
            <thead>
                <!--Field for first name-->
                <th>First Name</th>
                <!--Field for last name-->
                <th>Last Name</th>
                <!--field for temperature -->
                <th>Temperature</th>
                <!--Field for breakfast-->
                <th>Breakfast</th>
                <!--Field for lunch-->
                <th>Lunch</th>
                <!--Field for activities-->
                <th>Activities</th>
            </thead>
            <tbody>
                <!--Field for first name-->
                <td><?php if (isset($_SESSION["kidfname"])) { echo($_SESSION["kidfname"]); $_SESSION["kidfname"]="none";} else { echo("none");} ?></td>
                <!--Field for last name-->
                <td><?php if (isset($_SESSION["kidlname"])) { echo($_SESSION["kidlname"]); $_SESSION["kidlname"]="none";} else { echo("none");} ?></td>
                <!--Field for temperature-->
                <td><?php if (isset($_SESSION["temperature"])) { echo($_SESSION["temperature"]); $_SESSION["temperature"]="none";} else{ echo("none");} ?></td>
                 <!--Field for breakfast-->
                <td><?php if (isset($_SESSION["breakfast"])) { echo($_SESSION["breakfast"]); $_SESSION["breakfast"]="none";} else { echo("none");} ?></td>
                 <!--Field for lunch-->
                <td><?php if (isset($_SESSION["lunch"])) { echo($_SESSION["lunch"]); $_SESSION["lunch"]="none";} else { echo("none");} ?></td>
                <!--Field for activities-->
                <td><?php if (isset($_SESSION["activities"])) { echo($_SESSION["activities"]); $_SESSION["activities"]="none";} else { echo("none");} ?></td>
            </tbody>
        </table>
            
    </section>
</div>

<!--Including the footer-->
<?php include_once "template/footer.php" ?>