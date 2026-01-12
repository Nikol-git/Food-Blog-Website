<?php
session_start();
include "config.php";

// Make sure user is logged in
if (!isset($_SESSION['UserID'])) {
    header("Location: logIn.php");
    exit();
}

if (isset($_GET['rid'])) {
    $rid = intval($_GET['rid']); // sanitize input
    $userID = $_SESSION['UserID'];

    // Only delete if this recipe belongs to the logged-in user
    $sql = "DELETE FROM recipes WHERE RID = $rid AND userid = $userID";
    
    if (mysqli_query($conn, $sql)) {
        // Redirect back to profile
        header("Location: profile.php?deleted=1");
        exit();
    } else {
        echo "Error deleting recipe: " . mysqli_error($conn);
    }
} else {
    header("Location: profile.php");
    exit();
}
?>
