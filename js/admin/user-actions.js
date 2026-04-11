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
            console.log("OK", data);
        } else {
            alert("Errore");
        }

    })
    .catch(error => {
        console.error(error);
        alert("Errore AJAX");
    });
}