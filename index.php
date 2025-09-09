<?php
// Gegevens voor de connectie
//$host       = '127.0.0.1';
//$username   = 'root';
//$password   = '';
//$database   = 'cleanbotpro';
//
//$db = mysqli_connect($host, $username, $password, $database)
//or die('Error: '.mysqli_connect_error());
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
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>


<header>

    <section class="Dashboard-Title">

        <div class="Title">

        </div>

        <div class="Settings-button">

        </div>

    </section>

</header>

<main>

    <section class="Upcoming-tasks">

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

<footer>

    <nav>

        <section class="Nav-buttons">
            <div>

            </div>
        </section>

    </nav>

</footer>

</body>
</html>
