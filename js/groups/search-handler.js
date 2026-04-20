const searchInput = document.getElementById('group-search');
const listContainer = document.getElementById('available-groups-list');

searchInput.addEventListener('input', function() {
        const query = this.value;

        fetch(`search-group.php?q=${encodeURIComponent(query)}`)
            .then(response => response.text())
            .then(html => {
                listContainer.innerHTML = html;
            })
            .catch(error => {
                console.error("Errore di connessione:", error);
            });
    });