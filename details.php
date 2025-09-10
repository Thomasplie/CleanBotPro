<?php
require_once 'includes/database.php';

// Fetch the video ID from the query string
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Prevent SQL injection by using prepared statements
$query = "SELECT * FROM robot_tasks WHERE id = ?";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Fetch the video data
$tasks = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($db);

// Check if the video exists
if (!$tasks) {
    die('Video not found!');
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CleanBotPro - Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
</head>
<body>

<header class="hero is-info">
    <div class="hero-body">
        <p class="title">CleanBotPro</p>
        <p class="subtitle"><?= $tasks['task_name'] ?>
    </div>
</header>

<main class="container">
    <section class="section content">
        <ul>
            <li>Video Duration: <?= $tasks['day'] ?></li>
            <li>Year: <?= $tasks['time'] ?></li>
        </ul>
        <a class="button" href="dashboard.php">Go back to the list</a>
    </section>
</main>
</body>
</html>
