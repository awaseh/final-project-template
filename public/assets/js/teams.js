document.addEventListener('DOMContentLoaded', function() {
    // Fetch NBA teams from the API
    fetchTeams();
});

function fetchTeams() {
    fetch('/api/nba/teams')
        .then(response => response.json())
        .then(data => {
            const teamsContainer = document.getElementById('teams-container');

            // Check if we got teams data
            if (data && data.length > 0) {
                // Create a list of teams
                const ul = document.createElement('ul');
                data.forEach(team => {
                    const li = document.createElement('li');
                    li.textContent = `${team.full_name} (${team.city})`;
                    ul.appendChild(li);
                });

                // Append the list to the container
                teamsContainer.appendChild(ul);
            } else {
                // Display a message if no teams are found
                teamsContainer.innerHTML = '<p>No teams available.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching teams:', error);
        });
}
