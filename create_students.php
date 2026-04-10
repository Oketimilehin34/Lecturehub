<?php
include 'dbconnect.php';

// Sample students
$students = [
    ['username' => 'alice', 'password' => 'alice123'],
    ['username' => 'bob', 'password' => 'bob123'],
    ['username' => 'charlie', 'password' => 'charlie123'],
];

foreach ($students as $student) {
    $username = trim($student['username']);
    $password = password_hash(trim($student['password']), PASSWORD_DEFAULT); // Hash the password

    // Check if student already exists
    $check = $conn->prepare("SELECT id FROM students WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo " Skipped: Username '$username' already exists.<br>";
    } else {
        $stmt = $conn->prepare("INSERT INTO students (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            echo " Inserted: $username<br>";
        } else {
            echo " Error inserting $username: " . $stmt->error . "<br>";
        }
    }
    $check->close();
}

echo "<br>Process finished!";
?>
