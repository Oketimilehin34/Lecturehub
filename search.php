<?php include 'dbconnect.php'; ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Search Results - Lecture Materials Hub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <i class="bi bi-mortarboard-fill" style="font-size: 1.5rem;"></i> Lecturers' Hub
    </a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="materials.php">Materials</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Search Results -->
<div class="container py-5">
  <h2 class="mb-4 text-center">Search Results</h2>
  <div class="row g-4">

<?php
if (isset($_GET['query'])) {
    $search = $conn->real_escape_string($_GET['query']);

    $sql = "SELECT * FROM lecture_materials 
            WHERE course_code LIKE '%$search%' 
            OR course_title LIKE '%$search%'";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
          <div class="card-body">
            <i class="bi bi-book" style="font-size: 2rem; color: #0d6efd;"></i>
            <h5 class="card-title"><?php echo $row['course_code'] . " - " . $row['course_title']; ?></h5>
            <p class="card-text">Lecture <?php echo $row['lecture_no'] . ": " . $row['topics']; ?></p>
            <a href="download.php?file=<?php echo urlencode($row['file_name']); ?>" class="btn btn-dark">Download</a>
          </div>
        </div>
      </div>
<?php
        }
    } else {
        echo "<p class='text-center'>No results found for '<strong>$search</strong>'.</p>";
    }
} else {
    echo "<p class='text-center'>No search term provided.</p>";
}
?>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
