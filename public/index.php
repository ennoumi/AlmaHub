<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AlmaHub - Benvenuto</title>
  <link rel="stylesheet" href="../css/base.css">
  <link rel="stylesheet" href="../css/index.css">
</head>

<body>
  <main class="container">

    <section class="intro">
    <h1 class="logo-text gradient-text">ALMAHUB</h1>

      <p class="intro-text">
        Unisciti a gruppi di studio e collabora ai tuoi progetti universitari
        in modo semplice e accessibile.
      </p>
      
      <div class="buttons">
        <a href="login.php" class="btn btn-primary">Accedi</a>
        <a href="register.php" class="btn btn-secondary">Registrati</a>
      </div>
    </section>

    <section class="features">
      <h2>Perché scegliere AlmaHub?</h2>

      <div class="features-container">

        <article class="feature-card">
          <h3>Gruppi di Studio</h3>
          <p>Connettiti con i colleghi del tuo corso in pochi tap.</p>
        </article>

        <article class="feature-card">
          <h3>Progetti comuni</h3>
          <p>Gestisci documenti e scadenze dei tuoi lavori di gruppo.</p>
        </article>

        <article class="feature-card">
          <h3>Design Inclusivo</h3>
          <p>Interfaccia ad alto contrasto ottimizzata per l’accessibilità.</p>
        </article>

      </div>
    </section>

  </main>

  <?php include '../template/layout/footer.php'; ?>

</body>
</html>