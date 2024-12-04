let nextCursor = null;

document.addEventListener('DOMContentLoaded', function() {
    // Fetch NBA teams from the API
    fetchTeams(); // Fetch the first page of teams
});

function fetchTeams(cursor = null) {
    let url = 'http://localhost:8888/api/nba/teams';
    if (cursor) {
        url += `?cursor=${cursor}`; // Append cursor for pagination
    }

    fetch(url)
        .then(response => response.json())
        .then(data => {
            const teamsContainer = document.getElementById('teams-container');

            // Check if we got teams data
            if (data && data.data && data.data.length > 0) {
                // Create a list of teams
                const ul = document.createElement('ul');
                data.data.forEach(team => {
                    const li = document.createElement('li');
                    li.textContent = `${team.full_name} (${team.city})`;
                    ul.appendChild(li);
                });

                // Append the list to the container
                teamsContainer.appendChild(ul);

                // Update nextCursor for pagination
                nextCursor = data.meta && data.meta.next_cursor;
                if (nextCursor) {
                    showNextButton(); // Show the Next button if there's a next page
                } else {
                    hideNextButton(); // Hide the Next button if no next page
                }
            } else {
                // Display a message if no teams are found
                teamsContainer.innerHTML = '<p>No teams available.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching teams:', error);
            teamsContainer.innerHTML = '<p>Error fetching teams.</p>';
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
        fetchTeams(nextCursor); // Fetch the next page
    }
}

