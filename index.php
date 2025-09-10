<?php
require_once 'includes/database.php';

//
//$query = "SELECT * FROM tasks";
//
//$result = mysqli_query($db, $query)
//or die('Error '.mysqli_error($db).' with query '.$query);
//
//$tasks = [];
//while($row = mysqli_fetch_assoc($result)) {
//    $tasks[] = $row;
//}
//
//mysqli_close($db);
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


<header class="header-container">

    <section class="Dashboard-Title">

        <div class="big-brain">

        </div>
        <div class="Title">
            <h1>CleanBotPRO</h1>
        </div>

        <div class="Settings-button">
            This is gonna be an icon :3
        </div>

    </section>

</header>

<main class="main-container">

    <section class="Upcoming-tasks">
        <p>Hier komt de Schedule</p>
    </section>

    <section class="Ongoing-tasks">

        <button id="startBtn">Start new Task</button>

        <div class="progress-container">
            <div id="progressFill" class="progress-bar"></div>
        </div>
        <p id="status">Klaar om te beginnen</p>

        <script src="script.js"></script>

    </section>

    <section class="Task-Display">

    </section>

    <section class="Dashboard-Menu">

    </section>

</main>

<footer class="footer-container">

    <nav>

        <div class="dashboard-button">
            <button>Bruh</button>
            </div>
        <div class="settings-button">
            <button>Bruh</button>
        </div>

    </nav>

</footer>

</body>
</html>
