let userList = [];

document.addEventListener("DOMContentLoaded", function () {
    const userTableBody = document.querySelector("#userTableBody");
    const postTableBody = document.querySelector("#postTableBody");

    function fetchUsers() {
        return fetch("/api/users")
            .then((response) => response.json())
            .then((users) => {
                userList = users;
                userTableBody.innerHTML = "";
                users.forEach((user) => {
                    if (user.is_deleted == 0) {
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
                    }
                });
            });
    }

    function fetchPosts() {
        return fetch("/api/posts")
            .then((response) => response.json())
            .then((posts) => {
                postTableBody.innerHTML = "";
                posts.forEach((post) => {
                    const author = userList
                        ? userList.find((user) => user.id === post.author_id)
                        : null;
                    const authorName = author
                        ? `${author.username}`
                        : "Unknown Author";

                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${post.id}</td>
                        <td>${post.title}</td>
                        <td>${post.content}</td>
                        <td>${authorName}</td>
                        <td>
                            <a href="/post/view/${post.id}" class="btn btn-info btn-sm">View</a>
                            <a href="/post/view/${post.id}/delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                        </td>
                    `;
                    postTableBody.appendChild(row);
                });
            });
    }

    fetchUsers().then(() => fetchPosts());
});
