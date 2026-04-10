<?php
session_start();
if (!isset($_SESSION['lecturer'])) {
    header("Location: lecturer_login.php");
    exit();
}
include 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    // Find file name
    $stmt = $conn->prepare("SELECT file_name FROM lecture_materials WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $file = "uploads/" . $row['file_name'];
        if (file_exists($file)) unlink($file);
    }

    // Delete record
    $stmt = $conn->prepare("DELETE FROM lecture_materials WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
header("Location: lecturer_dashboard.php");
exit();
?>
