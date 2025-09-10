<?php
require_once 'includes/database.php';

// Check if the ID is set in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Check if the user has confirmed deletion
    if (isset($_POST['confirm_delete'])) {
        // Prepare and execute the delete query
        $query = "DELETE FROM robot_tasks WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            // Redirect to the index page after successful deletion
            header('Location: dashboard.php');
            exit;
        } else {
            $error = 'Error deleting record: ' . $stmt->error;
        }

        $stmt->close();
    }

} else {
    // Redirect to index if no valid ID is provided
    header('Location: dashboard.php');
    exit;
}

mysqli_close($db);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete Task</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
</head>
<body>

<section class="section">
    <div class="container">
        <div class="notification is-warning">
            <h1 class="title">Are you sure?</h1>
            <p>Do you really want to delete this task? This action cannot be undone.</p>
        </div>

        <?php if (isset($error)): ?>
            <div class="notification is-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <button type="submit" name="confirm_delete" class="button is-danger">Delete</button>
            <a href="dashboard.php" class="button is-light">Cancel</a>
        </form>
    </div>
</section>

</body>
</html>
