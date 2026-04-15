function chatBox(nomeUtente) {
    const chatBox = document.getElementById('chat-box');
    const chatForm = document.getElementById('chat-form');

    chatBox.scrollTop = chatBox.scrollHeight; // Scorre in basso la chat

    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('process-chat.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const p = document.createElement('p');
                p.innerHTML = `<strong>${nomeUtente}:</strong> ${formData.get('messaggio')}`;
                chatBox.appendChild(p); // Aggiunge il messaggio alla chat
                this.reset(); // Svuota il form del messaggio
                chatBox.scrollTop = chatBox.scrollHeight; // Scorre in basso la chat
            }
        });
    });
}