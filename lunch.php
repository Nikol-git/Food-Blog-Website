<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require "config.php";

// Guest-safe login check
$isLoggedIn = isset($_SESSION["Uname"], $_SESSION["UserID"]);
$username   = $isLoggedIn ? $_SESSION["Uname"] : null;
$userid     = $isLoggedIn ? (int)$_SESSION["UserID"] : null;

/* Logout */
if ($isLoggedIn && isset($_POST["logout"])) {
    session_destroy();
    header("Location: home.php"); // back to page as guest
    exit();
}

/* Handle Like/Unlike (only if logged in) */
if ($isLoggedIn && isset($_POST["like"], $_POST["rid"])) {
    $rid = (int)$_POST["rid"];

    $check = $conn->prepare("SELECT * FROM likes WHERE UserID=? AND RID=?");
    $check->bind_param("ii", $userid, $rid);
    $check->execute();
    $exists = $check->get_result()->num_rows;

    if ($exists) {
        $delete = $conn->prepare("DELETE FROM likes WHERE UserID=? AND RID=?");
        $delete->bind_param("ii", $userid, $rid);
        $delete->execute();
    } else {
        $insert = $conn->prepare("INSERT INTO likes (UserID, RID) VALUES (?, ?)");
        $insert->bind_param("ii", $userid, $rid);
        $insert->execute();
    }

    header("Location: lunch.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>JustATaste | Lunch Recipes</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<link rel="stylesheet" href="css/recipes.css">
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
        <?php if ($isLoggedIn): ?>
            <span class="welcome-text">Welcome, <?= htmlspecialchars($username) ?>!</span>
            <form method="post" class="logout-form">
                <button name="logout" class="logout-btn">Log Out</button>
            </form>
            <a href="profile.php" class="profile"><i class="bi bi-person-circle"></i></a>
        <?php else: ?>
            <a href="logIn.php" class="login-btn">Log In</a>
            
        <?php endif; ?>
    </div>
</nav>

<h1 class="page-title">Lunch Recipes</h1>

<div class="container recipes-container">

<?php
/* Fetch recipes with like count */
$stmt = $conn->prepare("
   SELECT r.*, u.Uname,
       (SELECT COUNT(*) FROM likes l WHERE l.RID = r.RID) AS like_count
   FROM recipes r
   JOIN users u ON r.userid = u.UserID
   WHERE r.RCategory = 'lunch'
");
$stmt->execute();
$result = $stmt->get_result();

/* Fetch user likes if logged in */
$liked_rids = [];
if ($isLoggedIn) {
    $likes_stmt = $conn->prepare("SELECT RID FROM likes WHERE UserID=?");
    $likes_stmt->bind_param("i", $userid);
    $likes_stmt->execute();
    $likes_res = $likes_stmt->get_result();

    while ($row = $likes_res->fetch_assoc()) {
        $liked_rids[] = $row["RID"];
    }
}

/* Display Recipes */
while ($row = $result->fetch_assoc()):
    $rID    = (int)$row["RID"];
    $rName  = htmlspecialchars($row["RName"]);
    $rDesc  = htmlspecialchars($row["RDecsr"]);
    $rImage = htmlspecialchars($row["Rimage"]);
    $rUser  = htmlspecialchars($row["Uname"]);
    $liked_class = in_array($rID, $liked_rids) ? "liked" : "";
    $likeCount = (int)$row['like_count'];
?>
    <div class="recipe-card">
        <img src="imgs/recipes/<?= $rImage ?>">
        <div class="recipe-info">
            <h3><?= $rName ?></h3>
            <p><?= $rDesc ?></p>
            <p class="text-muted">Uploaded by: <?= $rUser ?></p>

            <div class="recipe-actions">
                <?php if ($isLoggedIn): ?>
                    <form method="post" style="display:inline">
                        <input type="hidden" name="rid" value="<?= $rID ?>">
                        <button class="heart <?= $liked_class ?>" name="like">
                            <i class="fas fa-heart"></i> <?= $liked_class ? 'Liked' : 'Like' ?> (<?= $likeCount ?>)
                        </button>
                    </form>
                    <a href="comment.php?rid=<?= $rID ?>" class="comment-btn">
                        <i class="fas fa-comment"></i> Comment
                    </a>
                <?php else: ?>
                    <button class="heart disabled" onclick="showLoginMessage(this)">
                        <i class="fas fa-heart"></i> Like (<?= $likeCount ?>)
                    </button>
                    <button class="comment-btn disabled" onclick="showLoginMessage(this)">
                        <i class="fas fa-comment"></i> Comment
                    </button>
                    <span class="login-msg" style="color:red; display:none; margin-left:10px;"></span>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endwhile; ?>


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
function showLoginMessage(button) {
    const msgSpan = button.parentElement.querySelector('.login-msg');
    msgSpan.innerText = "You need to log in to comment/like.";
    msgSpan.style.display = "inline";

    setTimeout(() => {
        msgSpan.style.display = "none";
    }, 3000);
}
</script>

<script>
// Save scroll position before form submits
document.querySelectorAll("form").forEach(f => {
    f.addEventListener("submit", () => {
        localStorage.setItem("scrollPos", window.scrollY);
    });
});

// Restore scroll position after reload
window.addEventListener("load", () => {
    const pos = localStorage.getItem("scrollPos");
    if (pos) {
        window.scrollTo(0, pos);
        localStorage.removeItem("scrollPos");
    }
});
</script>
 

</body>
</html>
