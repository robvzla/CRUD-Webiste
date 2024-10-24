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
//  Logout starts a session and then destroy it and sends back the user to the index in the public level
session_start();
session_unset();
session_destroy();

header("location: ../index.php");
exit();
?>