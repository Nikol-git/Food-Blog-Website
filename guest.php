<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JustATaste/Home</title>
       
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="css/guest.css" >

    <link rel="icon" href="imgs/slogo.png">

</head>  

<body>
<nav class="navbar navbar-expand">
  <a class="navbar-brand" href="home.php"><img src="imgs/hlogo.png"></a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Recipes</a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="breakfast.php">Breakfast</a></li>
          <li><a class="dropdown-item" href="lunch.php">Lunch</a></li>
          <li><a class="dropdown-item" href="dinner.php">Dinner</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="dessert.php">Dessert</a></li>
          <li><a class="dropdown-item" href="snack.php">Snack</a></li>
        </ul>
      </li>
    </ul>
    <a href="login.php">
  <button class="btn" name="login" type="submit">Log Out</button>
</a>


  </form>
  
   
  </div>
</nav>  
<div class="container">
    <div class="row row-cols-1 g-4">
    <?php
    include "config.php"; 
    $sql = "SELECT * FROM recipes ";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        echo "<div class='col'>";
        echo "<div class='box'>";
        echo "<img src='imgs/recipes/".$row["Rimage"]. "' class='recipe'>";
        echo "<div class='recipe-info'>";
        echo "<div class='title'><h3>" .$row["RName"]. "</h3></div>";
        echo "<div class='description'><p>" .$row["RDecsr"]. "</p></div>";
        echo "</div>"; 
        echo "</div>"; 
        echo "</div>"; 
    }
?>
<footer class="footer ">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <div class="footer-content">
          <h3>Contact Us</h3>
          <ul>
            <li>123 Delicious St, Foodville</li>
            <li>Email: info@JustATaste.com</li>
            <li>Phone: 123-456-7890</li>
          </ul>
        </div>
      </div>
      <div class="col-md-6">
        <div class="footer-social">
          <h3>Follow Us</h3>
          <div class="social-icons">
            <img src="imgs/insta.png" alt="Instagram"><p>JustATaste</p>
            <img src="imgs/face.png" alt="Facebook"> <p>JustATaste</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>


</body>
</html>
