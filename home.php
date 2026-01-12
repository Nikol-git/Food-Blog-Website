<?php
// Check if a PHP session has NOT been started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start a new session
}

include "config.php"; // Include database connection and settings

// Check if the session variable 'Uname' exists
if (isset($_SESSION["Uname"])) {
    $isLoggedIn = true;            // User is logged in
    $username   = $_SESSION["Uname"]; // Store username from session
} else {
    $isLoggedIn = false;           // User is not logged in
    $username   = "";              // Empty username
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JustATaste | Home</title>
  <link rel="stylesheet" href="css/home.css">
  <link rel="icon" href="imgs/slogo.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">  <!-- Bootstrap Icons (used for profile icon) -->
</head>
<body>

<!-- NAVIGATION BAR -->
<nav class="navbar">
    <div class="nav-left">
        <a href="home.php">
            <img src="imgs/hlogo.png" alt="Logo" class="logo">
        </a>
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

        <?php if ($isLoggedIn): ?>

            <!-- Display welcome message with escaped username -->
            <span class="welcome-text">
                Welcome, <?= htmlspecialchars($username) ?>!
            </span>
            <form method="POST" class="logout-form">
                <button class="logout-btn" name="logout" type="submit">
                    Log Out
                </button>
            </form>
            <a href="profile.php" class="profile">
                <i class="bi bi-person-circle"></i>
            </a>
         <?php else: ?>
            <a href="logIn.php" class="login-btn">Log In</a>

        <?php endif; ?>

    </div>
</nav>


<!-- LOGOUT HANDLER -->
<?php
// Check if logout button was clicked
if (isset($_POST["logout"])) {
    session_destroy();          // Destroy all session data
    header("Location: logIn.php"); // Redirect to login page
    exit();                     // Stop script execution
}
?>


<!-- MAIN CONTENT -->
<main>
    <h1 class="cat-tittle">Categories</h1>
    <div class="image-container">
        <div>
            <a href="breakfast.php"><img src="imgs/breakfast.jpg" alt="Breakfast"></a>
            <p class="title">Breakfast</p>
        </div>
        <div>
            <a href="lunch.php"><img src="imgs/lunch.jpg" alt="Lunch"></a>
            <p class="title">Lunch</p>
        </div>
        <div>
            <a href="dinner.php"><img src="imgs/dinner.jpg" alt="Dinner"></a>
            <p class="title">Dinner</p>
        </div>
        <div>
            <a href="dessert.php"><img src="imgs/dessert.jpg" alt="Dessert"></a>
            <p class="title">Dessert</p>
        </div>
        <div>
            <a href="snack.php"><img src="imgs/snack.jpg" alt="Snack"></a>
            <p class="title">Snack</p>
        </div>
    </div>

    <h1 class="feat-tittle">Featured Recipes</h1>
    <section class="featured-recipes">

        <?php
        // IDs of recipes to feature on homepage
        $featured_ids = [1, 12, 7];

        // Create SQL placeholders (?, ?, ?)
        $placeholders = implode(',', array_fill(0, count($featured_ids), '?'));

        // Prepare SQL statement securely
        $stmt = $conn->prepare(
            "SELECT RID, RName, RDecsr, Rimage FROM recipes WHERE RID IN ($placeholders)"
        );

        // Create type string (i = integer)
        $types = str_repeat('i', count($featured_ids));

        // Bind recipe IDs dynamically
        $stmt->bind_param($types, ...$featured_ids);

        // Execute the query
        $stmt->execute();

        // Get query results
        $result = $stmt->get_result();

        // Loop through each recipe
        while ($row = $result->fetch_assoc()) {
        ?>

            <!-- Individual recipe card -->
            <div class="recipe-card">

                <!-- Recipe image -->
                <img src="imgs/recipes/<?= htmlspecialchars($row['Rimage']) ?>"
                     alt="<?= htmlspecialchars($row['RName']) ?>">

                <!-- Recipe name -->
                <h3><?= htmlspecialchars($row['RName']) ?></h3>

                <!-- Recipe description -->
                <p><?= htmlspecialchars($row['RDecsr']) ?></p>

                <!-- Button to open recipe modal -->
                <button class="bnt-feat" onclick="openRecipe(<?= $row['RID'] ?>)">
                    Read More
                </button>
            </div>

        <?php } ?>

    </section>
</main>


<!-- RECIPE MODAL -->
<div id="recipeModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="modalRecipeContent"></div>
    </div>
</div>

<!-- FOOTER -->
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
                    <img src="imgs/insta.png" alt="Instagram">
                    <p>JustATaste</p>
                </div>

                <div class="social-item">
                    <img src="imgs/face.png" alt="Facebook">
                    <p>JustATaste</p>
                </div>
            </div>
        </div>
    </div>
</footer>


<!-- JAVASCRIPT -->
<script>
// Open recipe modal and load content via AJAX
function openRecipe(id) {
    fetch("feat.php?id=" + id)        // Request recipe details
        .then(res => res.text())      // Convert response to text
        .then(data => {
            document.getElementById("modalRecipeContent").innerHTML = data;
            document.getElementById("recipeModal").style.display = "block";
        });
}

// Close modal when X is clicked
document.querySelector(".close").onclick = function () {
    document.getElementById("recipeModal").style.display = "none";
};

// Close modal when clicking outside the modal
window.onclick = function (event) {
    if (event.target === document.getElementById("recipeModal")) {
        document.getElementById("recipeModal").style.display = "none";
    }
};
</script>

</body>
</html>
