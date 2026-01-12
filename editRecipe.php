<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require "config.php";

/* Check login */
$isLoggedIn = isset($_SESSION["Uname"], $_SESSION["UserID"]);
if (!$isLoggedIn) {
    header("Location: logIn.php");
    exit();
}

$username = $_SESSION["Uname"];
$userID   = (int)$_SESSION["UserID"];

/* Logout */
if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: home.php");
    exit();
}

/* Validate recipe ID */
if (!isset($_GET['rid']) || !is_numeric($_GET['rid'])) {
    header("Location: profile.php");
    exit();
}

$rid = (int)$_GET['rid'];

/* Fetch recipe (safe prepared statement) */
$stmt = $conn->prepare("SELECT RID, RName, RDecsr, Rimage FROM recipes WHERE RID = ? AND userid = ?");
$stmt->bind_param("ii", $rid, $userID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "Recipe not found or you don't have permission to edit it.";
    exit();
}

$recipe = $result->fetch_assoc();

/* Update form submitted */
$showPopup = false;

if (isset($_POST['update'])) {
    $title = trim($_POST['title']);
    $desc  = trim($_POST['desc']);

    // Default image
    $img = $recipe['Rimage'];

    // Image upload
    if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
        $imgName = basename($_FILES['image']['name']);
        $imgTmp  = $_FILES['image']['tmp_name'];
        $ext = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($ext, $allowed)) {
            $newName = time() . "_" . $imgName;

            if (!is_dir("imgs/recipes")) {
                mkdir("imgs/recipes", 0777, true);
            }

            move_uploaded_file($imgTmp, "imgs/recipes/$newName");
            $img = $newName;
        }
    }

    /* Update recipe */
    $update = $conn->prepare("
        UPDATE recipes 
        SET RName = ?, RDecsr = ?, Rimage = ?
        WHERE RID = ? AND userid = ?
    ");
    $update->bind_param("sssii", $title, $desc, $img, $rid, $userID);

    if ($update->execute()) {
        $showPopup = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>JustATaste | Dessert Recipes</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="css/edit.css">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar">
    <div class="nav-left">
        <a href="home.php"><img src="imgs/hlogo.png" class="logo"></a>
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

<div class="wrapper">
    <h1>Edit Recipe</h1>

    <form method="POST" action="" enctype="multipart/form-data">
        <div class="input-box">
            <input type="text" name="title" value="<?= htmlspecialchars($recipe['RName']) ?>" placeholder="Recipe Title" required>
        </div>

        <div class="input-box">
            <textarea name="desc" placeholder="Recipe Description" rows="5" required><?= htmlspecialchars($recipe['RDecsr']) ?></textarea>
        </div>

        <div class="input-box">
            <label>Change Image (optional)</label>
            <input type="file" name="image" accept="image/*">
        </div>

        <button type="submit" name="update" class="btn">Update Recipe</button>
    </form>

    <a href="profile.php" class="btn" style="margin-top:10px; display:block; text-align:center;">Back to Profile</a>
</div>

<!-- SUCCESS POPUP -->
<div class="popup" id="popup">
    <div class="popup-box">
        <h2>Recipe Updated!</h2>
        <p>Your recipe has been successfully updated.</p>
        <button id="closePopup">OK</button>
    </div>
</div>

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
                    <img src="imgs/insta.png">
                    <p>JustATaste</p>
                </div>
                <div class="social-item">
                    <img src="imgs/face.png">
                    <p>JustATaste</p>
                </div>
            </div>
        </div>
    </div>
</footer>


<script>
<?php if ($showPopup): ?>
document.getElementById("popup").style.display = "flex";
<?php endif; ?>

document.getElementById("closePopup").addEventListener("click", function () {
    document.getElementById("popup").style.display = "none";
    window.location.href = "profile.php?updated=1";
});
</script>

</body>
</html>
