<?php
include 'dbconnect.php';

// Test lecturer credentials
$username = "lecturer1";
$plain_password = "Timilehin001";
$username = "lecturer2";
$plain_password = "Timilehin002";

// Hash the password
$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

// Remove existing duplicate lecturer if exists
$stmt = $conn->prepare("DELETE FROM lecturers WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();

// Insert the new lecturer
$stmt = $conn->prepare("INSERT INTO lecturers (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashed_password);

if ($stmt->execute()) {
    echo "Lecturer created successfully!<br>";
    echo "Username: $username<br>";
    echo "Password: $plain_password";
} else {
    echo "Error: " . $stmt->error;
}
