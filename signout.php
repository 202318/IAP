<?php
session_start();

// Destroy all session data
$_SESSION = [];
session_destroy();

// Redirect to sign in page
header("Location: signin.php");
exit;
?>
