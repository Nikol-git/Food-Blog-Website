<?php
// recipe.php?id=...
$id = intval($_GET['id']);
include "config.php";

$stmt = $conn->prepare("SELECT RName, RDecsr, Rimage FROM recipes WHERE RID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row) {
    $imgPath = "imgs/recipes/" . $row['Rimage'];
    if (!file_exists($imgPath)) {
        $imgPath = "imgs/placeholder.png"; // fallback
    }
    ?>
    <div class="recipe-modal-content">
        <img src="<?= $imgPath ?>" alt="<?= htmlspecialchars($row['RName']) ?>" style="width:100%; border-radius:12px; margin-bottom:15px;">
        <h2><?= htmlspecialchars($row['RName']) ?></h2>
        <p><?= htmlspecialchars($row['RDecsr']) ?></p>
    </div>
<?php
} else {
    echo "<p>Recipe not found.</p>";
}
?>
