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