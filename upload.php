<?php
session_start();
if (!isset($_SESSION['lecturer'])) {
    header("Location: lecturer_login.php");
    exit();
}
include 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_code = $_POST['course_code'];
    $course_title = $_POST['course_title'];
    $lecture_no = $_POST['lecture_no'];
    $topics = $_POST['topics'];

    $filename = $_FILES['file']['name'];
    $target = "uploads/" . basename($filename);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
        $stmt = $conn->prepare("INSERT INTO lecture_materials (course_code, course_title, lecture_no, topics, file_name) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiss", $course_code, $course_title, $lecture_no, $topics, $filename);
        $stmt->execute();
    }
}
header("Location: lecturer_dashboard.php");
exit();
?>
