<?php
require_once 'includes/database.php';

// Fetch the video ID from the query string
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Prevent SQL injection by using prepared statements
$query = "SELECT * FROM videos WHERE id = ?";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Fetch the video data
$videos = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($db);

// Check if the video exists
if (!$videos) {
    die('Video not found!');
}


?>
