<?php
require_once 'includes/database.php';

if(isset ($_POST['submit'])) {
    $name = mysqli_escape_string($db, $_POST['name']);

    // valideer de data
    if ($taskName === '') {
        $error['task_name'] = 'Naam mag niet leeg zijn';
    }

    if ($day === '') {
        $error['day'] = 'Dag mag niet leeg zijn';
    }

    if ($time === '') {
        $error['time'] = 'Tijd mag niet leeg zijn';
    }

    $errors = [];

    if(empty($errors)){
        $query = "UPDATE robot_tasks SET task_name = '$taskName', day = '$day', time = '$time' WHERE id = $id";

        $result = mysqli_query($db, $query);
        if($result) {
            header('Location: index.php');
        }
    }
}

// Is het formulier verzonden?
    // Zo ja,
        // data ophalen uit inputvelden
        // data valideren
            //data is niet valide
                // errors tonen
                // formulier opnieuw tonen met de eerder ingevoerde gegevens
            //data is wel valide
                // data updaten in de database
                // terugsturen naar overzichtspagina (index.php)

// is het ID in de URL aanwezig?
if (isset($_GET['id'])) {
    echo ('id is aanwezig');
    $id = mysqli_escape_string($db, $_GET['id']);
    echo ($id);

    $query = "SELECT * FROM robot_tasks WHERE id = $id";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) === 1) {
        $product = mysqli_fetch_assoc($result);
        print_r($product);
    }
    // Zo ja, ID opvragen van het product uit de URL (GET)
        //info ophalen uit de database

        //query opbouwen met id
        //query uitvoeren
            // Is er een product aanwezig met dit ID?
                // Zo ja, gegevens in variabelen stoppen
                    // Formulier tonen met de gegevens uit de database
                // Zo nee, terugsturen naar overzichtspagina (index.php)
    // Zo nee, terugsturen naar overzichtspagina (index.php)
} else {
    echo ('id is niet aanwezig');
    // Terugsturen naar overzichtspagina (index.php)
}

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
    <h2>Edit van product <?= htmlentities($product['name']) ?> </h2>
        <form action="" method="post">
            <label for="name">Naam</label>
            <input type="text" id="name" name="name" value="<?= htmlentities($product['name']) ?>">

            <input type="button" id="submit" value="edit">
        </form>
</body>
</html>
