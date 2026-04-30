<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membri</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/group-members.css">
</head>
<body>
    <?php include 'layout/header.php'; ?>

    <div class="group-members-body">
        <h1 class="gradient-text">Membri di <?php echo $gruppo['titolo']?></h1>
        <p class="dashboard-link"><a href="group-details.php?id=<?php echo $idGruppo; ?>"> Torna al Gruppo</a></p>
        <hr>
        <ul>
            <?php foreach($templateParams["membri"] as $m):?>
            <li>
                <p class="member-type <?php echo $m["ruolo"];?>"><?php echo $m["ruolo"];?></p>
                <p class="name"><?php echo $m["nome"] . ' ' . $m["cognome"];?></p>
                <p><?php echo $m["email"];?></p>
                <p class="profile-link btn btn-secondary"><a href="profile.php?user=<?php echo $m['id_utente'];?>">Profilo</a></p>
                <hr class="member-separator">
            </li>
            <?php endforeach;?>
        </ul>
    </div>
    
        <?php include 'layout/footer.php'; ?>
    </body>
</html>