<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
 $x = 1;
while($x <= 5) {
  echo "The number is: $x <br>";
  $x++; 
} 
?>
</body>
</html>
<?php 
session_start();
if (!isset($_SESSION['student'])) {
    header("Location: login.php");
    exit();
}

include 'dbconnect.php';

$sql = "SELECT * FROM lecture_materials LIMIT 3";
$result = $conn->query($sql);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lecture Materials Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand d-flex align-items-center gap-2" href="#">
            <i class="bi bi-mortarboard-fill" style="font-size: 2rem;"></i>
            Lecturers' Hub
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
             <li class="nav-item active">
                <a class="nav-link text-gray" href="#">Home<span class="visually-hidden"></span></a>
             </li>
             <li class="nav-item">
                <a class="nav-link text-gray" href="materials.php">Materials</a>
             </li>
             <li class="nav-item">
                <a class="nav-link text-gray" href="logout.php">Logout</a>
             </li>
            </ul>
     </div>
 </nav>


<!-- Hero Section -->
<section class="bg-primary text-light py-5" id="home">
  <div class="container text-center">
     <div class="hero-content">
        <h1 class="display-4 fw-bold">Access Quality Lecture Materials</h1>
        <p class="lead mb-4">Organized, searchable, and always available. Empower your learning.</p>

        <form class="d-flex justify-content-center" action="search.php" method="GET">
            <input 
            type="text" 
            name="query" 
            class="form-control w-50 me-2" 
            placeholder="Search lecture materials" 
            required>
            <button type="submit" class="btn btn-light">Search</button>
        </form>
      </div>
  </div>
</section>

<!-- Materials Section -->
<section class="py-5 bg-light" id="features">
  <div class="container text-center">
    <h2 class="mb-4">Lecture_Materials</h2>
    <div class="row g-4">

    <?php
if ($result->num_rows > 0) {
  ?>

    <?php
  while ($row = $result->fetch_assoc()) {
    ?>
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body">
            <i class="bi bi-book" style="font-size: 2rem; color: #0d6efd;"></i>
            <h5 class="card-title"><?php echo $row['course_code']." - ".$row['course_title'];?></h5>
            <p class="card-text">Lecture <?php echo $row['lecture_no'].": ".$row['topics'];?></p>
            <a href="download.php?file=<?php echo urlencode($row['file_name']); ?>" class="btn btn-dark">Download</a>

          </div>
        </div>
      </div>
      <?php
  }
} else {
  echo "<p>No lectures found.</p>";
} 

// Helper for badge color
function badgeColor($type) {
  switch (strtolower($type)) {
    case "pdf": return "danger";
    case "ppt": return "warning text-dark";
    case "docx": return "primary";
    default: return "secondary";
  }
}
?>
  </div>

  <div class="mt-4 text-center">
    <a href="materials.php" class="btn btn-outline-primary">See More Materials</a>
  </div>
</section>

<!-- Footer Section -->
<footer class="bg-dark text-white py-4 mt-5">
  <div class="container text-center">
    <p class="mb-0">&copy; 2025 Lecturers' Materials Hub. All rights reserved.</p>
  </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>