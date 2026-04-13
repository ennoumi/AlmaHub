<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Richieste</title>
</head>
<body>
    <?php include 'layout/header.php'; ?>
    <h1><?php echo "Richieste in corso:"?></h1>

        <?php if (!empty($dashboardParams['pending'])): ?>
        <h2>Richieste in entrata:</h2>
        <ul>
            <?php foreach($dashboardParams['pending'] as $req):?>
            <li>
                <p><a href="group-details.php?id=<?php echo $req['id_gruppo']; ?>"><?php echo $req["titolo"];?></a></p>
                <a href="profile.php?user=<?php echo $req['id_utente'];?>"><?php echo $req["nome"] . ' ' . $req["cognome"];?></a>
                <p>Data adesione: <?php echo $req["data_adesione"];?></p>
                <button type="button" onclick="handleRequest(<?php echo $req['id_utente']; ?>, <?php echo $req['id_gruppo']; ?>, 'accetta')">
                    ACCETTA
                </button>
                <button type="button" onclick="handleRequest(<?php echo $req['id_utente']; ?>, <?php echo $req['id_gruppo']; ?>, 'rifiuta')">
                    RIFIUTA
                </button>
            </li>
            <?php endforeach;?>
        </ul>
        <?php endif; ?>

        <?php if (!empty($dashboardParams['sent'])): ?>
        <h2>Richieste in uscita:</h2>
        <ul>
            <?php foreach($dashboardParams['sent'] as $req):?>
            <li>
                <p><a href="group-details.php?id=<?php echo $req['id_gruppo']; ?>"><?php echo $req["titolo"];?></a></p>
                <p>Data adesione: <?php echo $req["data_adesione"];?></p>
            </li>
            <?php endforeach;?>
        </ul>
        <?php endif;?>

        <script src="../js/group-request-handler.js"></script>

        <?php include 'layout/footer.php'; ?>
    </body>
</html>