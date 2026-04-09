<!DOCTYPE html>
<html lang="it">
<head>
    <title>Crea Gruppo</title>
</head>
<body>
    <?php include 'layout/header.php'; ?>
    <main>
        <form action="create-group.php" method="POST">
            <h1>Crea Nuovo Gruppo</h1>

            <?php if (!empty($templateParams['errore'])): ?>
                <p style="color: red;"><?php echo $templateParams['errore']; ?></p>
            <?php endif; ?>
            <?php if (!empty($templateParams['conferma'])): ?>
                <p style="color: green;"><?php echo $templateParams['conferma']; ?> 
                <a href = "dashboard.php">Torna alla dashboard</a></p>
            <?php endif; ?>

            <label for="tipo">Tipo:</label><br/>
            <select name="tipo" id="tipo">
                <option value="studio">Studio</option>
                <option value="elaborato">Elaborato</option>
            </select><br/><br/>

            <label for="titolo">Titolo:</label><br/>
            <input type="text" id="titolo" name="titolo" placeholder="Es. Preparazione Analisi 1" required><br/><br/>

            <label for="corso">Corso:</label><br/>
            <input type="text" name="corso" id="corso" placeholder="Es. Ingegneria informatica"><br/><br/>

            <label for="descrizione">Descrizione:</label><br/>
            <textarea name="descrizione" id="descrizione" rows="5" cols="50"></textarea><br/><br/>

            <label for="luogo">Luogo/Link</label><br/>
            <input type="text" id="luogo" name="luogo" placeholder="Aula 3 o link zoom"><br/><br/>

            <label for="orario">Orario</label><br/>
            <input type="text" name="orario" id="orario" placeholder="Lun 14:00"><br/><br/>

            <label for="maxMembri">Numero massimo di partecipanti</label><br/>
            <input type="number" name="maxMembri" id="maxMembri" min="1" max="50" value="1"><br/><br/>

            <button type="submit">Crea Gruppo</button>
        </form>
    </main>
    <?php include 'layout/footer.php'; ?>
</body>
</html>