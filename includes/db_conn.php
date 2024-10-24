<!--
 * Student name: Sirlei Gomes Lucio
 * Student number: 3043602
&
 * Student name: Jesus Roberto Cassino
 * Student number: 3049988
 *
 * LINK:    https://knuth.griffith.ie/~s3049988/ass03/index.php
-->

<?php
    //  Making connection parameters constant
    define('DB_USER', 's3049988');
    define('DB_HOST', 'localhost');
    define('DB_PASSWORD', 'oyawdigh');
    define('DB_NAME', 's3049988');

    //  Create connection
    $db_connection = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die("Could not connect to MySQL!".mysqli_connect_error());
    // Set the encoding
    mysqli_set_charset($db_connection, 'utf8'); 
?>
