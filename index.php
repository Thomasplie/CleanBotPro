<?php
// Gegevens voor de connectie
$host       = '127.0.0.1';
$username   = 'root';
$password   = '';
$database   = 'cleanbotpro';

$db = mysqli_connect($host, $username, $password, $database)
or die('Error: '.mysqli_connect_error());

$query = "SELECT * FROM tasks";

$result = mysqli_query($db, $query)
or die('Error '.mysqli_error($db).' with query '.$query);

$tasks = [];
while($row = mysqli_fetch_assoc($result)) {
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
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>


<header>

    <section class="Title">

    </section>

</header>

<main>

    <section class="Upcoming-tasks">

    </section>

    <section class="Ongoing-tasks">

    </section>

    <section class="Ongoing-tasks">

    </section>

</main>

<footer>

    <section>

    </section>

</footer>

</body>
</html>
