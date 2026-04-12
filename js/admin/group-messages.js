function loadMessages() {

    const groupId = document.getElementById('groupSelect').value;

    fetch(`admin.php?ajax=messages&group_id=${groupId}`)
        .then(response => response.json())
        .then(data => {

            const container = document.getElementById('messages-container');

            if (data.length === 0) {
                container.innerHTML = "<p>Questo gruppo non ha messaggi.</p>";
                return;
            }

            let html = "<ul>";

            data.forEach(m => {
                html += `
                    <li>
                        ${m.data_invio} -
                        ${m.nome} ${m.cognome}<br>
                        ${m.corpo_messaggio}
                    </li>
                `;
            });

            html += "</ul>";

            container.innerHTML = html;
            updateStats();
        })
        .catch(error => {
            console.error(error);
        });
}