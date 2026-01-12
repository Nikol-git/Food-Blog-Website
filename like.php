<?php
session_start();
include "config.php";

if (!isset($_SESSION['UserID'])) {
    echo json_encode(['status' => 'error']);
    exit;
}

$userid = $_SESSION['UserID'];
$rid = intval($_POST['rid']);

// Check if already liked
$sql = "SELECT * FROM likes WHERE UserID = ? AND RID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $userid, $rid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Unlike
    $sql = "DELETE FROM likes WHERE UserID = ? AND RID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userid, $rid);
    $stmt->execute();

    echo json_encode(['status' => 'unliked']);
} else {
    // Like
    $sql = "INSERT INTO likes (UserID, RID) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userid, $rid);
    $stmt->execute();

    echo json_encode(['status' => 'liked']);
}
?>
