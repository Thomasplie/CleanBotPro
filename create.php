<?php
require_once 'includes/database.php';

$errors = [];

if (isset($_POST['submit'])) {
    // Retrieve and sanitize form data
    $taskName = isset($_POST['task_name']) ? mysqli_real_escape_string($db, $_POST['task_name']) : '';
    $day = isset($_POST['day']) ? mysqli_real_escape_string($db, $_POST['day']) : '';
    $time = isset($_POST['time']) ? $_POST['time'] : '';

    // Validate form data
    if (empty($taskName)) {
        $errors['task_name'] = "Title is required.";
    }

    if (empty($day)) {
        $errors['day'] = "Day is required.";
    }

    if (empty($time)) {
        $errors['time'] = "Time is required.";
    }

    if (empty($errors)) {
        $query = "INSERT INTO `robot_tasks` (task_name, day, time) 
                      VALUES ('$taskName', '$day', '$time')";

        $result = mysqli_query($db, $query)
                or die('Error ' . mysqli_error($db) . ' with query ' . $query);

        $tasks = [];

        header('Location: dashboard.php');
        mysqli_close($db);

    }


}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Create Task</title>
</head>
<body>
<section class="section">
    <div class="container">
        <h1 class="title">Create New Task</h1>

        <form method="POST" action="">
            <div class="field">
                <label class="label">Task Name</label>
                <div class="control">
                    <input class="input <?= isset($errors['task_name']) ? 'is-danger' : '' ?>"
                           type="text"
                           name="task_name"
                           value="<?= isset($taskName) ? htmlspecialchars($taskName) : '' ?>">
                </div>
                <?php if (isset($errors['task_name'])): ?>
                    <p class="help is-danger"><?= $errors['task_name'] ?></p>
                <?php endif; ?>
            </div>

            <div class="field">
                <label class="label">Day</label>
                <div class="control">
                    <div class="select <?= isset($errors['day']) ? 'is-danger' : '' ?>">
                        <select name="day">
                            <option value="">Select a day</option>
                            <option value="1">Monday</option>
                            <option value="2">Tuesday</option>
                            <option value="3">Wednesday</option>
                            <option value="4">Thursday</option>
                            <option value="5">Friday</option>
                            <option value="6">Saturday</option>
                            <option value="7">Sunday</option>
                        </select>
                    </div>
                </div>
                <?php if (isset($errors['day'])): ?>
                    <p class="help is-danger"><?= $errors['day'] ?></p>
                <?php endif; ?>
            </div>

            <div class="field">
                <label class="label">Time</label>
                <div class="control">
                    <input class="input <?= isset($errors['time']) ? 'is-danger' : '' ?>"
                           type="time"
                           name="time"
                           value="<?= isset($time) ? htmlspecialchars($time) : '' ?>">
                </div>
                <?php if (isset($errors['time'])): ?>
                    <p class="help is-danger"><?= $errors['time'] ?></p>
                <?php endif; ?>
            </div>

            <div class="field">
                <div class="control">
                    <button class="button is-primary" type="submit" name="submit">Create Task</button>
                </div>
            </div>
        </form>
    </div>
</section>
</body>
</html>

