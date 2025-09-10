<?php
require_once 'includes/database.php';

// map day integer to name
function dayName($n) {
    $days = [
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
            7 => 'Sunday',
    ];
    $n = (int)$n;
    return $days[$n] ?? 'Unknown';
}

$query = "SELECT * FROM robot_tasks";

$result = mysqli_query($db, $query)
or die('Error '.mysqli_error($db).' with query '.$query);

$tasks = [];

while($row = mysqli_fetch_assoc($result))
{
    // elke rij (dit is een task) wordt aan de array 'task' toegevoegd.
    $tasks[] = $row;
}

mysqli_close($db);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<main class="container">
    <section class="section">
        <table class="table mx-auto">
            <thead>
            <tr>
                <th>id</th>
                <th>Task Name</th>
                <th>Day</th>
                <th>Time</th>
                <th>Details</th>
                <th>Edit</th>
                <th>DELETE</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <td colspan="6">&copy;  My Collection</td>
            </tr>
            </tfoot>
            <tbody>
            <!--        Loop through all videos in the database-->
            <?php
            foreach ($tasks as $task) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($task['id']) . "</td>";
                echo "<td>" . htmlspecialchars($task['task_name']) . "</td>";
                echo "<td>" . htmlspecialchars(dayName($task['day'])) . "</td>";
                echo "<td>" . htmlspecialchars($task['time']) . "</td>";
                echo "<td><a href='details.php?id=" . urlencode($task['id']) . "'>View Details</a></td>";
                echo "<td><a href='edit.php?id=" . urlencode($task['id']) . "'>Edit</a></td>";
                echo "<td><a href='delete.php?id=" . urlencode($task['id']) . "'>DELETE</a></td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </section>
</main>
</body>
</html>
