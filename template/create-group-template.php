<!DOCTYPE html>
<html lang="it">
<head>
    <title>Crea Gruppo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/create-group.css">
</head>
<body>
    <?php include 'layout/header.php'; ?>
    <main>
        <form action="create-group.php" method="POST">
            <h1 class="gradient-text">Crea Nuovo Gruppo</h1>

            <?php if (!empty($templateParams['errore'])): ?>
                <p class="error"><?php echo $templateParams['errore']; ?></p>
            <?php endif; ?>
            <?php if (!empty($templateParams['conferma'])): ?>
                <p class="success"><?php echo $templateParams['conferma']; ?> 
                <a href = "dashboard.php">Torna alla dashboard</a></p>
            <?php endif; ?>

            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo">
                <option value="studio">Studio</option>
                <option value="elaborato">Elaborato</option>
            </select>

            <label for="titolo">Titolo:</label>
            <input type="text" id="titolo" name="titolo" placeholder="Es. Preparazione Analisi 1" required>

            <label for="corso">Corso:</label>
            <input type="text" name="corso" id="corso" placeholder="Es. Ingegneria informatica">

            <label for="descrizione">Descrizione:</label>
            <textarea name="descrizione" id="descrizione" rows="5" cols="50"></textarea>

            <label for="luogo">Luogo/Link</label>
            <input type="text" id="luogo" name="luogo" placeholder="Aula 3 o link zoom">

            <label for="orario">Orario</label>
            <input type="text" name="orario" id="orario" placeholder="Lun 14:00">

            <label for="maxMembri">Numero massimo di partecipanti</label>
            <input type="number" name="maxMembri" id="maxMembri" min="1" max="50" value="1">

            <button type="submit" class="btn btn-primary">Crea Gruppo</button>
        </form>
    </main>
    <?php include 'layout/footer.php'; ?>
</body>
</html>