<?php

require_once 'includes/database.php';

if (!isset($db)) {
    die('Database connection ($db) not found in includes/database.php');
}

// Validate day from GET
$day = isset($_GET['day']) ? (int)$_GET['day'] : 0;
if ($day < 1 || $day > 7) exit('Invalid day');

// Map day integer to name
function dayName($n)
{
    $days = [
            1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday',
            4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 7 => 'Sunday',
    ];
    return $days[$n] ?? 'Unknown';
}

// Fetch tasks for the given day using prepared statement
$tasks = [];
$sql = "SELECT id, task_name, day, time FROM robot_tasks WHERE day = ? ORDER BY time";
if ($stmt = mysqli_prepare($db, $sql)) {
    mysqli_stmt_bind_param($stmt, 'i', $day);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        $tasks[] = $row;
    }
    mysqli_stmt_close($stmt);
} else {
    exit('Database error: ' . mysqli_error($db));
}

mysqli_close($db);

// Output only tasks content (AJAX-ready)
if (empty($tasks)) {
    echo '<div class="notification is-warning">No tasks scheduled for ' . htmlspecialchars(dayName($day)) . '</div>';
} else {
    echo '<table class="table is-fullwidth is-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Task Name</th>
                    <th>Time</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>';
    foreach ($tasks as $task) {
        echo '<tr>
                <td>' . (int)$task['id'] . '</td>
                <td>' . htmlspecialchars($task['task_name']) . '</td>
                <td>' . htmlspecialchars($task['time']) . '</td>
                <td><a class="button is-small is-info" href="edit.php?id=' . urlencode($task['id']) . '">Edit</a></td>
                <td><a class="button is-small is-danger" href="delete.php?id=' . urlencode($task['id']) . '">Delete</a></td>
              </tr>';
    }
    echo '</tbody></table>';
}

exit;
//require_once 'includes/database.php';
//
//if (!isset($db)) {
//    die('Database connection ($db) not found in includes/database.php');
//}
//
//// validate day from GET
//$day = isset($_GET['day']) ? (int) $_GET['day'] : 0;
//if ($day < 1 || $day > 7) {
//    header('Location: dashboard.php');
//    exit;
//}
//
//// map day integer to name
//function dayName($n) {
//    $days = [
//        1 => 'Monday',
//        2 => 'Tuesday',
//        3 => 'Wednesday',
//        4 => 'Thursday',
//        5 => 'Friday',
//        6 => 'Saturday',
//        7 => 'Sunday',
//    ];
//    $n = (int)$n;
//    return $days[$n] ?? 'Unknown';
//}
//
//// fetch tasks for the given day using prepared statement
//$tasks = [];
//$sql = "SELECT id, task_name, day, time FROM robot_tasks WHERE day = ? ORDER BY time";
//if ($stmt = mysqli_prepare($db, $sql)) {
//    mysqli_stmt_bind_param($stmt, 'i', $day);
//    mysqli_stmt_execute($stmt);
//    $result = mysqli_stmt_get_result($stmt);
//    while ($row = mysqli_fetch_assoc($result)) {
//        $tasks[] = $row;
//    }
//    mysqli_stmt_close($stmt);
//} else {
//    die('Database error: ' . mysqli_error($db));
//}
//
//mysqli_close($db);
//?>
<!--<!doctype html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
<!--    <title>Tasks for --><?php //= htmlspecialchars(dayName($day)) ?><!--</title>-->
<!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">-->
<!--</head>-->
<!--<body>-->
<!--<main class="container">-->
<!--    <section class="section">-->
<!--        <h1 class="title">Tasks for --><?php //= htmlspecialchars(dayName($day)) ?><!--</h1>-->
<!--        <p class="subtitle">Showing tasks scheduled for day --><?php //= (int)$day ?><!--</p>-->
<!---->
<!--        --><?php //if (empty($tasks)): ?>
<!--            <div class="notification is-warning">-->
<!--                No tasks scheduled for --><?php //= htmlspecialchars(dayName($day)) ?><!--.-->
<!--            </div>-->
<!--        --><?php //else: ?>
<!--            <table class="table is-fullwidth is-striped">-->
<!--                <thead>-->
<!--                <tr>-->
<!--                    <th>ID</th>-->
<!--                    <th>Task Name</th>-->
<!--                    <th>Time</th>-->
<!--                    <th>Edit</th>-->
<!--                    <th>Delete</th>-->
<!--                </tr>-->
<!--                </thead>-->
<!--                <tbody>-->
<!--                --><?php //foreach ($tasks as $task): ?>
<!--                    <tr>-->
<!--                        <td>--><?php //= (int)$task['id'] ?><!--</td>-->
<!--                        <td>--><?php //= htmlspecialchars($task['task_name']) ?><!--</td>-->
<!--                        <td>--><?php //= htmlspecialchars($task['time']) ?><!--</td>-->
<!--                        <td><a class="button is-small is-info" href="edit.php?id=--><?php //= urlencode($task['id']) ?><!--">Edit</a></td>-->
<!--                        <td><a class="button is-small is-danger" href="delete.php?id=--><?php //= urlencode($task['id']) ?><!--">Delete</a></td>-->
<!--                    </tr>-->
<!--                --><?php //endforeach; ?>
<!--                </tbody>-->
<!--            </table>-->
<!--        --><?php //endif; ?>
<!---->
<!--        <div class="mt-4">-->
<!--            <a class="button" href="dashboard.php">Back to Dashboard</a>-->
<!--        </div>-->
<!--    </section>-->
<!--</main>-->
<!--</body>-->
<!--</html>-->
