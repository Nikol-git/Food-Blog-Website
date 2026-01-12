<?php
session_start();
require_once "config.php";

$error = ""; 

if (isset($_POST["signup"])) {

    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

    // Validate email format
    if (!$email) {
        $error = "Invalid email format.";
    }

    // Password strength validation
    elseif (strlen($password) < 8) {
        $error = "Password must be at least 8 characters long.";
    }
    elseif (!preg_match('/[A-Z]/', $password)) {
        $error = "Password must contain at least one uppercase letter.";
    }
    elseif (!preg_match('/[a-z]/', $password)) {
        $error = "Password must contain at least one lowercase letter.";
    }
    elseif (!preg_match('/[0-9]/', $password)) {
        $error = "Password must contain at least one number.";
    }
    elseif (!preg_match('/[\W]/', $password)) {
        $error = "Password must contain at least one special character.";
    } 
    else {

        // Check username exists
        $check = $conn->prepare("SELECT UserID FROM users WHERE Uname = ?");
        $check->bind_param("s", $username);
        $check->execute();
        $check_result = $check->get_result();

        if ($check_result->num_rows > 0) {
            $error = "Username already taken.";
        } else {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (Uname, UPass, UEmail) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $hashedPassword, $email);

            if ($stmt->execute()) {

                session_regenerate_id(true);
                $_SESSION["Uname"] = $username;

                header("Location: home.php");
                exit();
            } else {
                $error = "Registration unsuccessful. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>JustATaste | Register</title>
  <link rel="stylesheet" href="css/register.css" />
  <link rel="icon" href="imgs/slogo.png" />
</head>
<body>
  <div class="wrapper">
    <h1>Welcome To <br>JUST A TASTE</h1>
    <h2>Sign Up</h2>

    <?php if (!empty($error)): ?>
      <div class="error-box"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="register.php" autocomplete="off">
      <!-- Username -->
      <div class="input-box">
        <input type="text" name="username" id="username" placeholder="Username" required>
      </div>

      <!-- Password -->
      <div class="input-box">
        <div class="password-wrapper">
          <input type="password" name="password" id="password" placeholder="Enter password" required>
          <span id="togglePassword" class="toggle-password">👁 Show</span>
        </div>

        <!-- Compact Password Rules -->
      <div id="password-rules">
  <span id="rule-length">At least 8 chars</span>,
  <span id="rule-upper">Uppercase letter</span>,
  <span id="rule-lower">Lowercase letter</span>,
  <span id="rule-number">Number</span>,
  <span id="rule-special">Special char</span>
</div>

        <!-- Strength Bar -->
        <div id="strength-bar"><div id="strength-fill"></div></div>
      </div>

      <!-- Email -->
      <div class="input-box">
        <input type="email" name="email" id="email" placeholder="your@email.com" required>
      </div>

      <!-- Sign Up Button -->
      <button type="submit" name="signup" class="btn">Sign Up</button>

      <!-- Terms -->
      <div class="terms">
        <p>By signing up, you agree to our Terms, Privacy Policy, and Cookies Policy.</p>
        <label class="container">
          <input type="checkbox" required>
          <span class="agree">I agree</span>
        </label>
      </div>

      <!-- Login Link -->
      <div class="login-link">
        <p>Already have an account? <a href="logIn.php">Sign In</a></p>
      </div>
    </form>
  </div>

  <!-- JavaScript -->
  <script>
    const passwordInput = document.getElementById("password");
    const togglePass = document.getElementById("togglePassword");

    const rules = {
      length: document.getElementById("rule-length"),
      upper: document.getElementById("rule-upper"),
      lower: document.getElementById("rule-lower"),
      number: document.getElementById("rule-number"),
      special: document.getElementById("rule-special")
    };

    const strengthFill = document.getElementById("strength-fill");

    passwordInput.addEventListener("input", () => {
      const password = passwordInput.value;
      let strength = 0;

      // Length
      if (password.length >= 8) { rules.length.classList.add("valid"); strength++; } 
      else { rules.length.classList.remove("valid"); }

      // Uppercase
      if (/[A-Z]/.test(password)) { rules.upper.classList.add("valid"); strength++; } 
      else { rules.upper.classList.remove("valid"); }

      // Lowercase
      if (/[a-z]/.test(password)) { rules.lower.classList.add("valid"); strength++; } 
      else { rules.lower.classList.remove("valid"); }

      // Number
      if (/[0-9]/.test(password)) { rules.number.classList.add("valid"); strength++; } 
      else { rules.number.classList.remove("valid"); }

      // Special char
      if (/[\W]/.test(password)) { rules.special.classList.add("valid"); strength++; } 
      else { rules.special.classList.remove("valid"); }

      // Strength Bar
      const percent = (strength/5)*100;
      strengthFill.style.width = percent + "%";
      strengthFill.style.background = strength <= 2 ? "red" : (strength < 5 ? "orange" : "green");
    });

    // Show/hide toggle
    togglePass.addEventListener("click", () => {
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        togglePass.textContent = "⌣ Hide";
      } else {
        passwordInput.type = "password";
        togglePass.textContent = "👁 Show";
      }
    });
  </script>
</body>
</html>
