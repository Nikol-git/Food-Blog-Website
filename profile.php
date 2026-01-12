<?php
session_start();
include "config.php";


$userID = $_SESSION['UserID'];
$username = $_SESSION['Uname']; // FIXED: this variable was missing
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JustATaste | Profile</title>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/profile.css">

    <link rel="icon" href="imgs/slogo.png">
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

<!-- ================= MAIN SECTION ================= -->
<h1 class="section-title">My Recipes</h1>

<div class="recipes-wrapper">

<?php
$query = "SELECT * FROM recipes WHERE userid = $userID ORDER BY RID DESC";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        $img   = htmlspecialchars($row["Rimage"]);
        $title = htmlspecialchars($row["RName"]);
        $desc  = htmlspecialchars($row["RDecsr"]);
        $rid   = intval($row["RID"]);

        echo "
        <div class='recipe-card'>
            <img src='imgs/recipes/$img' class='recipe-image' alt='$title'>

            <h3 class='recipe-title'>$title</h3>
            <p class='recipe-description'>$desc</p>

            <div class='card-actions'>
                <a href='editRecipe.php?rid=$rid' class='edit-btn'>Edit</a>
                <a href='deleteRecipe.php?rid=$rid' class='delete-btn' onclick=\"return confirm('Delete this recipe?');\">Delete</a>
            </div>
        </div>
        ";
    }

} else {
    echo "<p class='no-recipes'>You haven't uploaded any recipes yet.</p>";
}
?>

</div>

<!-- Upload Button -->
<a href="upload.php" class="button upload-btn">Upload a Recipe</a>



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
