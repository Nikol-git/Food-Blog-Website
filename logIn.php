<?php
session_start();
include "config.php";

$error = "";

if (isset($_POST["signin"])) {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT UserID, Uname, UPass FROM users WHERE Uname = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['UPass'])) {
            session_regenerate_id(true);
            $_SESSION["UserID"] = $row['UserID'];
            $_SESSION["Uname"] = $row['Uname'];
            header("Location: home.php");
            exit();
        }
    }

    $error = "Wrong username or password.";

    var_dump($password, $row['UPass']);
if (password_verify($password, $row['UPass'])) {
    echo "Password match!";
} else {
    echo "Password did NOT match!";
}

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>JustATaste | Login</title>
<link rel="stylesheet" href="css/login.css">
<link rel="icon" href="imgs/slogo.png">
</head>
<body>
<div class="wrapper">
    <form method="POST" action="logIn.php">
        <h1>Welcome To <br>JUST A TASTE</h1><br>
        <h2>Sign In</h2>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
       <button type="submit" name="signin">Sign In</button>

    </form>

    <?php if(isset($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <div class="register">
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
</div>
</body>
</html>
