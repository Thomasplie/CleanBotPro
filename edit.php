<?php
require_once 'includes/database.php';

// Ensure $db exists
if (!isset($db)) {
    die('Database connection ($db) not found in includes/database.php');
}

$errors = [];

// Get ID from GET and fetch the existing task
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = (int) $_GET['id'];

$query = "SELECT * FROM robot_tasks WHERE id = $id";
$result = mysqli_query($db, $query);

if (!$result || mysqli_num_rows($result) !== 1) {
    header('Location: index.php');
    exit;
}

$product = mysqli_fetch_assoc($result);

// Initialize variables from database so they're never undefined
$taskName = $product['task_name'] ?? '';
$day = $product['day'] ?? '';
$time = $product['time'] ?? '';

// Handle form submission
if (isset($_POST['submit'])) {
    // Use the same input names as the form below
    $taskName = trim(mysqli_real_escape_string($db, $_POST['robot_task'] ?? ''));
    $day = trim(mysqli_real_escape_string($db, $_POST['day'] ?? ''));
    $time = trim(mysqli_real_escape_string($db, $_POST['time'] ?? ''));

    // Validate
    if ($taskName === '') {
        $errors['task_name'] = 'Naam mag niet leeg zijn';
    }

    if ($day === '' || !in_array((int)$day, range(1, 7), true)) {
        $errors['day'] = 'Dag moet een getal tussen 1 en 7 zijn';
    }

    if ($time === '') {
        $errors['time'] = 'Tijd moet een geldig tijdstip zijn (HH:MM)';
    }

    if (empty($errors)) {
        // Safe update (basic escaping; consider prepared statements)
        $taskNameEsc = mysqli_real_escape_string($db, $taskName);
        $dayInt = (int) $day;
        $timeEsc = mysqli_real_escape_string($db, $time);

        $update = "UPDATE robot_tasks 
                   SET task_name = '$taskNameEsc', day = $dayInt, time = '$timeEsc' 
                   WHERE id = $id";

        if (mysqli_query($db, $update)) {
            header('Location: index.php');
            exit;
        } else {
            $errors['db'] = 'Database update failed: ' . mysqli_error($db);
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit task</title>
    <link href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css" rel="stylesheet">
</head>
<body>
<section class="section">
    <div class="container">
        <h2 class="title">Edit task <?= htmlentities($taskName ?? '') ?></h2>

        <?php if (!empty($errors)): ?>
            <div class="notification is-danger">
                <ul>
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlentities($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="" method="post">
            <div class="field">
                <label class="label" for="robot_task">Naam</label>
                <div class="control">
                    <input class="input" type="text" id="robot_task" name="robot_task" value="<?= htmlentities($taskName ?? '') ?>">
                </div>
            </div>

            <div class="field">
                <label class="label" for="day">Dag</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select id="day" name="day">
                            <option value="">Select a day</option>
                            <option value="1" <?= ((string)$day === '1') ? 'selected' : '' ?>>Monday</option>
                            <option value="2" <?= ((string)$day === '2') ? 'selected' : '' ?>>Tuesday</option>
                            <option value="3" <?= ((string)$day === '3') ? 'selected' : '' ?>>Wednesday</option>
                            <option value="4" <?= ((string)$day === '4') ? 'selected' : '' ?>>Thursday</option>
                            <option value="5" <?= ((string)$day === '5') ? 'selected' : '' ?>>Friday</option>
                            <option value="6" <?= ((string)$day === '6') ? 'selected' : '' ?>>Saturday</option>
                            <option value="7" <?= ((string)$day === '7') ? 'selected' : '' ?>>Sunday</option>
                        </select>
                    </div>
                </div>
                <?php if (!empty($errors['day'])): ?>
                    <p class="help is-danger"><?= htmlentities($errors['day']) ?></p>
                <?php endif; ?>
            </div>

            <div class="field">
                <label class="label" for="time">Tijd (HH:MM)</label>
                <div class="control">
                    <input class="input" type="time" id="time" name="time" value="<?= htmlentities($time ?? '') ?>">
                </div>
            </div>

            <div class="control">
                <button class="button is-primary" type="submit" name="submit">Save</button>
            </div>
        </form>
    </div>
</section>
</body>
</html>

