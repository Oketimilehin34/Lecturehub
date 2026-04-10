<?php
session_start();
if (!isset($_SESSION['lecturer'])) {
    header("Location: lecturer_login.php");
    exit();
}
include 'dbconnect.php';

// Fetch all materials
$result = $conn->query("SELECT * FROM lecture_materials ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Lecturer Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-primary">
  <div class="container-fluid">
    <span class="navbar-brand">Lecturers' Dashboard</span>
    <a href="lecturer_logout.php" class="btn btn-danger">Logout</a>
  </div>
</nav>

<div class="container mt-4">
    <h3>Upload New Material</h3>
    <form action="upload.php" method="POST" enctype="multipart/form-data" class="row g-3">
        <div class="col-md-4">
            <input type="text" name="course_code" class="form-control" placeholder="Course Code" required>
        </div>
        <div class="col-md-6">
            <input type="file" name="file" class="form-control" accept=".pdf,.ppt,.pptx,.docx" required>
        </div>
        <div class="col-md-4">
            <input type="text" name="course_title" class="form-control" placeholder="Course Title" required>
        </div>
        
        <div class="col-md-6">
            <input type="text" name="topics" class="form-control" placeholder="Topics" required>
        </div>
        <div class="col-md-2">
            <input type="number" name="lecture_no" class="form-control" placeholder="Lecture No" required>
        </div>
        
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
    </form>

    <hr>
    <h3>Manage Materials</h3>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Title</th>
                <th>Lecture No</th>
                <th>Topics</th>
                <th>File</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['course_code'] ?></td>
                <td><?= $row['course_title'] ?></td>
                <td><?= $row['lecture_no'] ?></td>
                <td><?= $row['topics'] ?></td>
                <td><?= $row['file_name'] ?></td>
                <td>
                    <form action="delete.php" method="POST" onsubmit="return confirm('Delete this material?');">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
