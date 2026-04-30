<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Richieste</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/group-requests.css">
</head>
<body>
    <?php include 'layout/header.php'; ?>

    <div class="group-requests-body">
        <h1 class="gradient-text"><?php echo "Richieste in corso:"?></h1>

        <?php if (!empty($dashboardParams['pending'])): ?>
        <h2 class="requests-section-title">Richieste in entrata:</h2>

        <hr class="request-separator">
        <ul>
            <?php foreach($dashboardParams['pending'] as $req):?>
            <li>
                <p class="request-name"><?php echo $req["nome"] . ' ' . $req["cognome"];?></p>
                <p class="request-name"><?php echo $req["titolo"];?></p>
                <p>Data richiesta: <?php echo $req["data_adesione"];?></p>
                <div class="request-actions">
                    <button type="button" class="request-action accetta" onclick="handleRequest(<?php echo $req['id_utente']; ?>, <?php echo $req['id_gruppo']; ?>, 'accetta')">
                        ACCETTA
                    </button>
                    <button type="button" class="request-action rifiuta" onclick="handleRequest(<?php echo $req['id_utente']; ?>, <?php echo $req['id_gruppo']; ?>, 'rifiuta')">
                        RIFIUTA
                    </button>
                </div>

                <hr class="request-separator">
            </li>
            <?php endforeach;?>
        </ul>
        <?php endif; ?>

        <?php if (!empty($dashboardParams['sent'])): ?>
        <h2 class="requests-section-title">Richieste in uscita:</h2>
        <hr class="request-separator">
        <ul>
            <?php foreach($dashboardParams['sent'] as $req):?>
            <li>
                <p class="request-name"><?php echo $req["titolo"];?></p>
                <p>Data richiesta: <?php echo $req["data_adesione"];?></p>
                <hr class="request-separator">
            </li>
            <?php endforeach;?>
        </ul>
        <?php endif;?>
    </div>

        <script src="../js/groups/group-request-handler.js"></script>

        <?php include 'layout/footer.php'; ?>
    </body>
</html>