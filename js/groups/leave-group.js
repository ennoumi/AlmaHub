function leaveGroup() {
    document.getElementById('disiscrizione').addEventListener('submit', function(e) {
    e.preventDefault();

    // Conferma di uscita
    if (!confirm("Sei sicuro di voler uscire da questo gruppo?")) return;

    const formData = new FormData(this);

    fetch('process-quit.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.risultato) {
            alert("Hai abbandonato il gruppo con successo.");
            location.reload(); // Ricarica per aggiornamento numero iscritti, eliminazione chat e tasto di iscrizione
        } else {
            alert("Errore durante l'operazione di disiscrizione.");
        }
    })
    .catch(error => alert("Errore di connessione."));
    });
}