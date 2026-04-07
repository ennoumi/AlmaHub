<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1><?php echo "Bentornato, " . $_SESSION['utente']['nome'];?></h1>
        <p><a href="profile.php">Profilo</a></p>
        <p><a href="logout.php">Logout</a></p>
        <a href="create-group.php">+ Crea Gruppo</a>

        <h2>I miei Gruppi</h2>
        <ul>
            <?php foreach($dashboardParams["userGroups"] as $gruppo):?>
            <li>
                <p><?php echo $gruppo["tipo"]?></p>
                <p><?php echo $gruppo["titolo"];?></p>
                <p><a href="group-details.php?id=<?php echo $gruppo['id_gruppo']; ?>">Visualizza dettagli</a></p>
            </li>
            <?php endforeach;?>
        </ul>

        <h2>Gruppi disponibili</h2>
        <ul>
            <?php foreach($dashboardParams["availableGroups"] as $gruppo):?>
            <li>
                <p><?php echo $gruppo["tipo"]?></p>
                <p><?php echo $gruppo["titolo"];?></p>
                <p><a href="group-details.php?id=<?php echo $gruppo['id_gruppo']; ?>">Visualizza dettagli</a></p>
            </li>
            <?php endforeach;?>
        </ul>
    </body>
</html>