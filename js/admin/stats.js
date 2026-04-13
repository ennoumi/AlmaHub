function updateStats() {
    fetch('admin.php?ajax=stats')
        .then(response => response.json())
        .then(data => {
            document.getElementById('totale-gruppi').textContent = data.totale_gruppi;
            document.getElementById('totale-studenti').textContent = data.totale_studenti;
            document.getElementById('studenti-attivi').textContent = data.studenti_attivi;
            document.getElementById('studenti-disattivati').textContent = data.studenti_disattivati;
            document.getElementById('totale-messaggi').textContent = data.totale_messaggi;
        })
        .catch(error => {
            console.error(error);
        });
}