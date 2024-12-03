document.addEventListener('DOMContentLoaded', function() {
    // Fetch NBA players from the API
    fetchPlayers();
});

function fetchPlayers() {
    fetch('/api/nba/players')
        .then(response => response.json())
        .then(data => {
            const playersContainer = document.getElementById('players-container');

            // Check if we got players data
            if (data && data.length > 0) {
                // Create a list of players
                const ul = document.createElement('ul');
                data.forEach(player => {
                    const li = document.createElement('li');
                    li.textContent = `${player.first_name} ${player.last_name} (${player.team.full_name})`;
                    ul.appendChild(li);
                });

                // Append the list to the container
                playersContainer.appendChild(ul);
            } else {
                // Display a message if no players are found
                playersContainer.innerHTML = '<p>No players available.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching players:', error);
        });
}
