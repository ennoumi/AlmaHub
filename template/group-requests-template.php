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

        <h2>Richieste in entrata:</h2>
        <ul>
            <?php foreach($dashboardParams["pending"] as $req):?>
            <li>
                <p><?php echo $req["tipo"]?></p>
                <p><?php echo $req["titolo"];?></p>
                <p><a href="group-details.php?id=<?php echo $req['id_gruppo']; ?>">Visualizza Gruppo</a></p>
                <button type="button" onclick="handleRequest(<?php echo $req['id_utente']; ?>, <?php echo $req['id_gruppo']; ?>, 'true')">
                    ACCETTA
                </button>
                <button type="button" onclick="handleRequest(<?php echo $req['id_utente']; ?>, <?php echo $req['id_gruppo']; ?>, 'false')">
                    RIFIUTA
                </button>
            </li>
            <?php endforeach;?>
        </ul>

        <h2>Richieste in uscita:</h2>
        <ul>
            <?php foreach($dashboardParams["sent"] as $req):?>
            <li>
                <p><?php echo $req["tipo"]?></p>
                <p><?php echo $req["titolo"];?></p>
                <p><a href="group-details.php?id=<?php echo $req['id_gruppo']; ?>">Visualizza Gruppo</a></p>
            </li>
            <?php endforeach;?>
        </ul>

        <script>
            function handleRequest(idUtente, idGruppo, azione) {

                const formData = new FormData();
                formData.append('id_utente', idUtente);
                formData.append('id_gruppo', idGruppo);
                formData.append('azione', azione);

                fetch('process-requests.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.risultato === 0) {
                        location.reload(); // Ricarica la pagina per eliminare la richiesta
                    } else if(data.risultato === 100){
                        alert("Login richiesto");
                    } else {
                        alert("Errore");
                    }
                });
            }
        </script>
        <?php include 'layout/footer.php'; ?>
    </body>
</html>