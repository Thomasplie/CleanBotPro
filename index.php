<?php
require_once 'includes/database.php';

// determine day: use GET param if present, otherwise today's weekday (1 = Monday)
$day = isset($_GET['day']) ? (int) $_GET['day'] : (int) date('N');
if ($day < 1 || $day > 7) {
    $day = (int) date('N');
}

function dayName($n) {
    $days = [
            1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday',
            4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 7 => 'Sunday',
    ];
    return $days[(int)$n] ?? 'Unknown';
}

// fetch tasks for the selected day
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
    echo '<div class="notification is-danger">Database error: ' . htmlspecialchars(mysqli_error($db)) . '</div>';
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="source/styles.css">
    <title>Document</title>
</head>
<body>

<div class="phone-container">
    <div class="phone design-1" id="phone">
        <!-- Header -->
        <div class="header-bar">
            <h1>CleanBotPRO</h1>
            <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
            </svg>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Upcoming Tasks -->
            <h2 class="section-title">Upcoming Tasks</h2>
            <div class="calendar-grid">
                <div class="calendar-day" data-day="1">
                    <div class="calendar-day-label">Mon</div>
                    <div class="calendar-date">10</div>
                </div>
                <div class="calendar-day" data-day="2">
                    <div class="calendar-day-label">Tue</div>
                    <div class="calendar-date">11</div>
                </div>
                <div class="calendar-day" data-day="3">
                    <div class="calendar-day-label">Wed</div>
                    <div class="calendar-date">12</div>
                </div>
                <div class="calendar-day" data-day="4">
                    <div class="calendar-day-label">Thu</div>
                    <div class="calendar-date">13</div>
                </div>
                <div class="calendar-day" data-day="5">
                    <div class="calendar-day-label">Fri</div>
                    <div class="calendar-date">14</div>
                </div>
                <div class="calendar-day" data-day="6">
                    <div class="calendar-day-label">Sat</div>
                    <div class="calendar-date">15</div>
                </div>
                <div class="calendar-day" data-day="7">
                    <div class="calendar-day-label">Sun</div>
                    <div class="calendar-date">16</div>
                </div>
            </div>

            <section class="box" id="tasks-box">
                <h3 class="title is-5">Tasks for <?= htmlspecialchars(dayName($day)) ?></h3>
                <?php if (empty($tasks)): ?>
                    <div class="notification is-warning">
                        No tasks scheduled for <?= htmlspecialchars(dayName($day)) ?>.
                    </div>
                <?php else: ?>
                    <table class="table is-fullwidth is-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Task Name</th>
                            <th>Time</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($tasks as $task): ?>
                            <tr>
                                <td><?= (int)$task['id'] ?></td>
                                <td><?= htmlspecialchars($task['task_name']) ?></td>
                                <td><?= htmlspecialchars($task['time']) ?></td>
                                <td><a class="button is-small is-info" href="edit.php?id=<?= urlencode($task['id']) ?>">Edit</a></td>
                                <td><a class="button is-small is-danger" href="delete.php?id=<?= urlencode($task['id']) ?>">Delete</a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </section>

            <!-- Ongoing Task -->
            <div class="progress-section">
                <div class="progress-header">
                    <h3 class="section-title">Ongoing Task</h3>
                    <span id="progressPercent" style="color: var(--accent-color, #67e8f9); font-weight: 500;"></span>
                </div>
                <div class="progress-bar">
                    <div id="progressFill" class="progress-fill"></div>
                </div>
                <p style="color: #cbd5e1;">Living Room Cleaning</p>
                <p id="status">Ready to start</p>
            </div>

            <!-- Main Grid -->
            <div class="main-grid">
                <!-- Pick a Task -->
                <div class="button-list">
                    <h3 class="section-title">Pick a Task</h3>
                    <button id="startBtn" class="start-button">
                        <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                        Start
                    </button>
                    <button id="startBtn" class="start-button">
                        <a href="create.php" style="text-decoration: none; color: inherit;">
                            <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                            Create new task
                    </button>
                </div>

                <!-- Status -->
                <div>
                    <h3 class="section-title">Status</h3>
                    <div class="status-item">
                        <span>Battery Health</span>
                        <span class="badge good">98%</span>
                    </div>
                    <div class="status-item">
                        <span>Maintenance</span>
                        <span class="badge warning">Needed</span>
                    </div>
                    <div class="status-item">
                        <span>Overall Health</span>
                        <span class="badge good">Good</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation -->
        <div class="bottom-nav">
            <a href="dashboard.php" style="text-decoration: none; color: inherit;">
                <div class="nav-item active">
                    <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/>
                    </svg>
                    <span class="nav-label">Tasks</span>
                </div>
            </a>
            <a href="home.php" style="text-decoration: none; color: inherit;">
                <div class="nav-item">
                    <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
                    </svg>
                    <span class="nav-label">Home</span>
                </div>
            </a>
            <a href="alerts.php" style="text-decoration: none; color: inherit;">
                <div class="nav-item">
                    <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
                    </svg>
                    <span class="nav-label">Alerts</span>
                </div>
            </a>
            <a href="history.php" style="text-decoration: none; color: inherit;">
                <div class="nav-item">
                    <svg class="nav-icon" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M13 3c-4.97 0-9 4.03-9 9H1l3.89 3.89.07.14L9 12H6c0-3.87 3.13-7 7-7s7 3.13 7 7-3.13 7-7 7c-1.93 0-3.68-.79-4.94-2.06l-1.42 1.42C8.27 19.99 10.51 21 13 21c4.97 0 9-4.03 9-9s-4.03-9-9-9zm-1 5v5l4.28 2.54.72-1.21-3.5-2.08V8H12z"/>
                    </svg>
                    <span class="nav-label">History</span>
                </div>
            </a>
        </div>
    </div>
</div>


<!--<header class="header-container">-->
<!---->
<!--    <section class="Dashboard-Title">-->
<!---->
<!--        <div class="big-brain">-->
<!---->
<!--        </div>-->
<!--        <div class="Title">-->
<!--            <h1>CleanBotPRO</h1>-->
<!--        </div>-->
<!---->
<!--        <div class="Settings-button">-->
<!--            This is gonna be an icon :3-->
<!--        </div>-->
<!---->
<!--    </section>-->
<!---->
<!--</header>-->
<!---->
<!--<main class="main-container">-->
<!---->
<!--    <section class="Upcoming-tasks">-->
<!--        <p>Hier komt de Schedule</p>-->
<!--    </section>-->
<!---->
<!--    <section class="Ongoing-tasks">-->
<!---->
<!--        <button id="startBtn">Start new Task</button>-->
<!---->
<!--        <div class="progress-container">-->
<!--            <div id="progressFill" class="progress-bar"></div>-->
<!--        </div>-->
<!--        <p id="status">Klaar om te beginnen</p>-->
<!---->
<!--        <script src="script.js"></script>-->
<!---->
<!--    </section>-->
<!---->
<!--    <section class="Task-Display">-->
<!---->
<!--    </section>-->
<!---->
<!--    <section class="Dashboard-Menu">-->
<!---->
<!--    </section>-->
<!---->
<!--</main>-->
<!---->
<!--<footer class="footer-container">-->
<!---->
<!--    <nav>-->
<!---->
<!--        <div class="dashboard-button">-->
<!--            <button>Bruh</button>-->
<!--            </div>-->
<!--        <div class="settings-button">-->
<!--            <button>Bruh</button>-->
<!--        </div>-->
<!---->
<!--    </nav>-->
<!---->
<!--</footer>-->
<!---->
<script src="script.js"></script>
</body>
</html>
