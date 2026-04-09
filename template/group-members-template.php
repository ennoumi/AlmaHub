<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membri</title>
</head>
<body>
    <?php include 'layout/header.php'; ?>
    <h1>Membri di: <?php echo $gruppo['titolo']?></h1>
        <p><a href="group-details.php?id=<?php echo $idGruppo; ?>"> Torna al Gruppo</a></p>
        <ul>
            <?php foreach($templateParams["membri"] as $m):?>
            <li>
                <p><?php echo $m["nome"]?></p>
                <p><?php echo $m["cognome"];?></p>
                <p><?php echo $m["email"];?></p>
                <p><?php echo $m["ruolo"];?></p>
                <a href="profile.php?user=<?php echo $m['id_utente'];?>">Profilo</a>
            </li>
            <?php endforeach;?>
        </ul>
        <?php include 'layout/footer.php'; ?>
    </body>
</html>