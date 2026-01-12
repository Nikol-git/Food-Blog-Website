<?php
session_start();
include "config.php"; // connect to your database

// Validate recipe ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid recipe ID.");
}

$id = intval($_GET['id']);

// Fetch the recipe
$stmt = $conn->prepare("SELECT * FROM recipes WHERE RID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$recipe = $result->fetch_assoc();

if (!$recipe) {
    die("Recipe not found.");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($recipe['RName']) ?></title>
    <link rel="stylesheet" href="css/rec-view.css">
</head>
<body>

<h1><?= htmlspecialchars($recipe['RName']) ?></h1>

<!-- Recipe Image -->
<?php if (!empty($recipe['Rimage'])): ?>
    <img src="imgs/<?= htmlspecialchars($recipe['Rimage']) ?>" 
         alt="<?= htmlspecialchars($recipe['RName']) ?>" 
         style="max-width:400px;">
<?php endif; ?>

<!-- Category -->
<p><strong>Category:</strong> <?= htmlspecialchars($recipe['RCategory']) ?></p>

<!-- Short Description -->
<p><?= nl2br(htmlspecialchars($recipe['RDecsr'])) ?></p>

</body>
</html>
