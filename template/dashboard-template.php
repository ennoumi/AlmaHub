<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/user-dashboard.css">
</head>
<body>
    <?php include 'layout/header.php'; ?>
    <?php if (isAdmin()): ?>
        <p><a href="admin.php">Pannello Admin</a></p>
    <?php endif; ?>
    <main class="dashboard">
        <h1 class="welcome"><?php echo "Bentornato, " . $_SESSION['utente']['nome'];?></h1>
        <a href="create-group.php" class="btn-create">+ Crea Gruppo</a>

        <h2>I miei Gruppi</h2>
        <ul class="group-list">
            <?php foreach($dashboardParams["userGroups"] as $gruppo):?>
            <li class="feature-card">
                <p><?php echo $gruppo["tipo"]?></p>
                <p><?php echo $gruppo["titolo"];?></p>
                <p><a href="group-details.php?id=<?php echo $gruppo['id_gruppo']; ?>">Visualizza dettagli</a></p>
            </li>
            <?php endforeach;?>
        </ul>

        <h2>Gruppi disponibili</h2>
        <input type="text" id="group-search" placeholder="Cerca gruppi per nome..." autocomplete="off">
        <ul id="available-groups-list" class="group-list">
            <?php foreach($dashboardParams["availableGroups"] as $gruppo):?>
            <li class="feature-card">
                <p><?php echo $gruppo["tipo"]?></p>
                <p><?php echo $gruppo["titolo"];?></p>
                <p><a href="group-details.php?id=<?php echo $gruppo['id_gruppo']; ?>">Visualizza dettagli</a></p>
            </li>
            <?php endforeach;?>
        </ul>
    </main>
    <?php include 'layout/footer.php'; ?>
    <script src="../js/groups/search-handler.js"></script>
    </body>
</html>