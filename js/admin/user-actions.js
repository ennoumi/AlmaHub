function banUser(userId) {
    sendRequest(userId, 'ban_user');
}

function unbanUser(userId) {
    sendRequest(userId, 'unban_user');
}

function sendRequest(userId, action) {
    const formData = new FormData();
    formData.append('user_id', userId);
    formData.append(action, true);

    fetch('admin.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {

    if (data.success) {
        const row = document.getElementById(`user-${userId}`);
        const stato = row.querySelector('.stato');
        const azioni = row.querySelector('.azioni');
        if (data.action === 'ban') {
            stato.textContent = 'disattivato';
            azioni.innerHTML = `<button class="unban btn btn-primary" type="button" onclick="unbanUser(${userId})">Riattiva</button>`;

            const btn = azioni.querySelector('button');
            btn.style.padding = '15px 20px 15px 20px';
            btn.style.borderRadius = '5px';
        } else {
            stato.textContent = 'attivo';
            azioni.innerHTML = `<button class="ban btn btn-primary" type="button" onclick="banUser(${userId})">Disattiva</button>`;

            const btn = azioni.querySelector('button');
            btn.style.padding = '15px 20px 15px 20px';
            btn.style.borderRadius = '5px';
        }
        updateStats();
    } else {
        alert("Errore");
    }

    })
    .catch(error => {
        console.error(error);
        alert("Errore AJAX");
    });
}