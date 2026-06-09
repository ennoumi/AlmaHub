function deleteGroup() {
    document.getElementById('eliminazione').addEventListener('submit', function(e) {
        e.preventDefault();

        if (!confirm("Eliminare questo gruppo e tutta la chat?")) {
            return;
        }

        const formData = new FormData(this);

        fetch('process-delete-group.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.risultato) {
                alert("Gruppo eliminato con successo.");
                window.location.href = "admin.php"; 
            } else {
                alert(data.errore);
            }
        })
        .catch(error => alert("Errore di connessione al server."));
    });
}