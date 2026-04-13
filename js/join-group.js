function joinGroup() {
    document.getElementById('iscrizione').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('process-join.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.risultato === 0) {
            alert("Iscrizione avvenuta con successo!");
            location.reload(); // Ricarica per aggiornare il numero di iscritti
        } else if (data.risultato === 1) {
            alert("Il gruppo è pieno.");
        } else if (data.risultato === 2) {
            alert("Sei già iscritto a questo gruppo o richiesta già inviata.");
        } else if (data.risultato === 3) {
            alert("Richiesta di iscrizione inviata.");
        } else {
            alert("Errore durante l'iscrizione.");
        }
    })
    .catch(error => alert("Errore di connessione."));
    });
}