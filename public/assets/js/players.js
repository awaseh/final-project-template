let nextCursor = null;

document.addEventListener('DOMContentLoaded', function() {
    // Fetch NBA players from the API
    fetchPlayers(); // Fetch the first page of players
});

function fetchPlayers(cursor = null) {
    let url = 'http://localhost:8888/api/nba/players';
    if (cursor) {
        url += `?cursor=${cursor}`; // Append cursor for pagination
    }

    fetch(url)
        .then(response => response.json())
        .then(data => {
            const playersContainer = document.getElementById('players-container');

            // Check if we got players data
            if (data && data.data && data.data.length > 0) {
                // Create a list of players
                const ul = document.createElement('ul');
                data.data.forEach(player => {
                    const li = document.createElement('li');
                    li.textContent = `${player.first_name} ${player.last_name} (${player.team.full_name})`; // Directly adding the player name and team
                    ul.appendChild(li);
                });

                // Append the list to the container
                playersContainer.appendChild(ul);

                // Update nextCursor for pagination
                nextCursor = data.meta && data.meta.next_cursor;
                if (nextCursor) {
                    showNextButton(); // Show the Next button if there's a next page
                } else {
                    hideNextButton(); // Hide the Next button if no next page
                }
            } else {
                // Display a message if no players are found
                playersContainer.innerHTML = '<p>No players available.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching players:', error);
            playersContainer.innerHTML = '<p>Error fetching players.</p>';
        });
}

function showNextButton() {
    const nextButton = document.getElementById('next-button');
    nextButton.style.display = 'block';
}

function hideNextButton() {
    const nextButton = document.getElementById('next-button');
    nextButton.style.display = 'none';
}

function loadNextPage() {
    if (nextCursor) {
        fetchPlayers(nextCursor); // Fetch the next page
    }
}




