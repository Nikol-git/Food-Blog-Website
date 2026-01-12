<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require "config.php";

$username = $_SESSION['Uname'];
$userID   = $_SESSION['UserID'];

/* Logout */
if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: home.php");
    exit();
}

/* Handle Upload */
if (isset($_POST["insert"])) {
    $rname    = trim($_POST["rname"]);
    $rdescr   = trim($_POST["rdescr"]);
    $category = $_POST["category"];
    $image    = null;

    /* Image Upload */
    if (!empty($_FILES["rimg"]["name"])) {
        $allowed = ["jpg", "jpeg", "png", "webp"];
        $ext = strtolower(pathinfo($_FILES["rimg"]["name"], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            header("Location: upload.php?status=error");
            exit();
        }

        $image = uniqid("recipe_", true) . "." . $ext;
        move_uploaded_file($_FILES["rimg"]["tmp_name"], "imgs/recipes/" . $image);
    }

    /* Insert recipe */
    $stmt = $conn->prepare(
        "INSERT INTO recipes (RName, RDecsr, RCategory, RImage, UserID) 
         VALUES (?, ?, ?, ?, ?)"
    );

    $stmt->bind_param("ssssi", $rname, $rdescr, $category, $image, $userID);

    if ($stmt->execute()) {
        header("Location: profile.php?status=success");
        exit();
    } else {
        header("Location: upload.php?status=error");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JustATaste | Upload</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/upload.css">
    <link rel="icon" href="imgs/slogo.png">
</head>
<body>

<!-- Navbar -->
<nav class="navbar">
    <div class="nav-left">
        <a href="home.php"><img src="imgs/hlogo.png" class="logo" alt="Logo"></a>
        <a href="home.php" class="nav-link">Home</a>
        <div class="dropdown">
            <a class="nav-link">Recipes</a>
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
        <form method="post" class="logout-form">
            <button name="logout" class="logout-btn">Log Out</button>
        </form>
        <a href="profile.php" class="profile"><i class="bi bi-person-circle"></i></a>
    </div>
</nav>

<!-- Toast Popup -->
<div id="popup" class="popup"></div>

<!-- Upload Form -->
<div class="container-upload">
    <h3 class="mb-4 text-center">Upload a New Recipe</h3>
    <form class="row g-3" method="POST" enctype="multipart/form-data">
        <div class="col-md-6">
            <label class="form-label">Recipe Title</label>
            <input type="text" class="form-control" name="rname" placeholder="e.g., Chocolate Cake" required>
        </div>

        <div class="col-md-12">
            <label class="form-label">Description</label>
            <textarea name="rdescr" class="form-control" rows="6" placeholder="Enter ingredients and steps..." required></textarea>
        </div>

        <div class="col-md-12">
            <label class="form-label">Category</label>
            <select name="category" class="form-control" required>
                <option disabled selected>Choose category</option>
                <option value="breakfast">Breakfast</option>
                <option value="lunch">Lunch</option>
                <option value="dinner">Dinner</option>
                <option value="dessert">Dessert</option>
                <option value="snack">Snack</option>
            </select>
        </div>

        <div class="col-md-12">
            <label class="form-label">Recipe Image</label>
            <input type="file" class="form-control" name="rimg" accept="image/*">
        </div>

        <div class="col-md-12 d-grid mt-3">
            <input type="submit" name="insert" class="upload btn btn-primary" value="Upload Recipe">
        </div>
    </form>
</div>

<!-- Footer -->
<footer class="footer mt-5">
    <div class="container">
        <div class="footer-content mb-3">
            <h3>Contact Us</h3>
            <ul>
                <li>123 Delicious St, Foodville</li>
                <li>Email: info@JustATaste.com</li>
                <li>Phone: 123-456-7890</li>
            </ul>
        </div>

        <div class="footer-social">
            <h3>Follow Us</h3>
            <div class="social-icons d-flex gap-3">
                <div class="social-item d-flex align-items-center gap-2">
                    <img src="imgs/insta.png" alt="Instagram">
                    <p class="mb-0">JustATaste</p>
                </div>
                <div class="social-item d-flex align-items-center gap-2">
                    <img src="imgs/face.png" alt="Facebook">
                    <p class="mb-0">JustATaste</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Popup JS -->
<script>
window.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    const popup = document.getElementById('popup');

    if (!status) return;

    if (status === 'success') {
        popup.textContent = "🎉 Recipe uploaded successfully!";
        popup.classList.add('show', 'success');
    } else if (status === 'error') {
        popup.textContent = "❌ Upload failed. Please try again.";
        popup.classList.add('show', 'error');
    }

    // Auto hide after 4 seconds
    setTimeout(() => {
        popup.classList.remove('show');
    }, 4000);
});
</script>

</body>
</html>
