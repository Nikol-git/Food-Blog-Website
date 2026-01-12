<?php
session_start();
include "config.php"; // IMPORTANT

$username = $_SESSION["Uname"];


if (!isset($_GET['rid'])) {
    die("No recipe selected.");
}

$rid = intval($_GET['rid']);

// Process comment BEFORE output
if (isset($_POST["post_comment"])) {

    if (!isset($_SESSION['UserID'])) {
        die("You must be logged in to comment.");
    }

    $userid = intval($_SESSION["UserID"]);
    $comment = mysqli_real_escape_string($conn, $_POST["comment"]);

    if (strlen(trim($comment)) == 0) {
        $msg = "<p class='error'>Comment cannot be empty.</p>";
    } else {
        $sql = "INSERT INTO comments (RID, UserID, CommentText) 
                VALUES ($rid, $userid, '$comment')";

        if (mysqli_query($conn, $sql)) {
            // Reload page to show the new comment
            header("Location: comment.php?rid=$rid");
            exit();
        } else {
            $msg = "<p class='error'>Error saving comment.</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comments</title>
    <link rel="stylesheet" href="css/comment.css">
</head>
<body>
<nav class="navbar">

    <div class="nav-left">
        <a href="home.php"><img src="imgs/hlogo.png" alt="Logo" class="logo"></a>
        <a href="home.php" class="nav-link">Home</a>

        <div class="dropdown">
            <a href="#" class="nav-link">Recipes</a>
            <div class="dropdown-content">
                <a href="breakfast.php">Breakfast</a>
                <a href="lunch.php">Lunch</a>
                <a href="dinner.php">Dinner</a>
                <a href="dessert.php">Dessert</a>
                <a href="snack.php">Snack</a>
            </div>
        </div>
    </div>

    <div class="nav-right">
        <span class="welcome-text">Welcome, <?= htmlspecialchars($username) ?>!</span>

        <form method="POST" action="home.php" class="logout-form">
            <button class="logout-btn" name="logout" type="submit">Log Out</button>
        </form>

        <a href="profile.php" class="profile">
            <i class="bi bi-person-circle"></i>
        </a>
    </div>

</nav>


<div id="comments" class="comments">

    <!-- COMMENT FORM (Fixed: Removed Name Input) -->
    <form action="" method="POST">
        <textarea placeholder="Your Comment" name="comment" required></textarea><br>
        <input type="submit" value="Submit" name="post_comment">
    </form>

    <?= $msg ?? '' ?>

    <hr>

    <!-- COMMENT LIST -->
    <?php
    $sql = "SELECT c.CommentText, c.CommentDate, u.Uname
            FROM comments c
            JOIN users u ON c.UserID = u.UserID
            WHERE c.RID = $rid
            ORDER BY c.CommentDate DESC";

    $result = mysqli_query($conn, $sql);

    echo "<div class='comment-list'>";

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "
                <div class='comment-item'>
                    <p><strong>" . htmlspecialchars($row['Uname']) . "</strong></p>
                    <p>" . htmlspecialchars($row['CommentText']) . "</p>
                    <small>" . $row['CommentDate'] . "</small>
                </div>
            ";
        }
    } else {
        echo "<p>No comments yet.</p>";
    }

    echo "</div>";
    ?>

</div>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <h3>Contact Us</h3>
            <ul>
                <li>123 Delicious St, Foodville</li>
                <li>Email: info@JustATaste.com</li>
                <li>Phone: 123-456-7890</li>
            </ul>
        </div>
        <div class="footer-social">
            <h3>Follow Us</h3>
           <div class="social-icons">
    <div class="social-item">
        <img src="imgs/insta.png" alt="instagram">
        <p>JustATaste</p>
    </div>

    <div class="social-item">
        <img src="imgs/face.png" alt="facebook">
        <p>JustATaste</p>
    </div>
</div>

        </div>
    </div>
    
</footer>

</body>
</html>
