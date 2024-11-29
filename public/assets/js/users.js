document.addEventListener('DOMContentLoaded', function() {
    console.log('Document loaded. Initializing users management...');
    loadUsers();

    document.getElementById('addUserForm').addEventListener('submit', function(e) {
        e.preventDefault();
        addUser();
    });
});

function loadUsers() {
    console.log('Attempting to fetch users...');
    fetch('http://localhost:8888/api/users')
        .then(response => {
            console.log('Fetch response:', response);
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(users => {
            console.log('Fetched users:', users);
            const tableBody = document.getElementById('usersTableBody');
            tableBody.innerHTML = '';

            users.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${user.id}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>${user.created_at}</td>
                    <td><button class="btn btn-danger btn-sm" onclick="deleteUser(${user.id})">Delete</button></td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error fetching users:', error);
            alert('Error fetching users. Please try again.');
        });
}

function addUser() {
    const formData = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value
    };

    console.log('Adding user with data:', formData);

    fetch('http://localhost:8888/api/users', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        console.log('Add user response:', data);
        if (data.success) {
            alert('User added successfully!');
            document.getElementById('addUserForm').reset();
            loadUsers();
        } else {
            alert(data.message || 'Error adding user');
        }
    })
    .catch(error => {
        console.error('Error adding user:', error);
        alert('Error adding user. Please try again.');
    });
}

function deleteUser(userId) {
    if (!confirm('Are you sure you want to delete this user?')) return;

    console.log('Deleting user with ID:', userId);

    fetch('http://localhost:8888/api/users', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: userId })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Delete user response:', data);
        if (data.success) {
            alert('User deleted successfully!');
            loadUsers();
        } else {
            alert(data.message || 'Error deleting user');
        }
    })
    .catch(error => {
        console.error('Error deleting user:', error);
        alert('Error deleting user. Please try again.');
    });
}

