document.addEventListener("DOMContentLoaded", function () {
    const userTableBody = document.querySelector("#userTableBody");

    function fetchUsers() {
        fetch("/api/users")
            .then((response) => response.json())
            .then((users) => {
                userTableBody.innerHTML = "";
                users.forEach((user) => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${user.id}</td>
                        <td>${user.username}</td>
                        <td>${user.email}</td>
                        <td>
                            <a href="/profile/${user.username}" class="btn btn-info btn-sm">View</a>
                            <a href="/profile/${user.username}/edit" class="btn btn-warning btn-sm">Edit</a>
                            <a href="/profile/${user.username}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        </td>
                    `;
                    userTableBody.appendChild(row);
                });
            })
            .catch((error) => console.error("Error fetching users:", error));
    }

    fetchUsers();
});
