document.addEventListener("DOMContentLoaded", function () {
    const postsContainer = document.querySelector("#posts-container");

    function fetchUsers() {
        fetch("/api/posts")
            .then((response) => response.json())
            .then((posts) => {
                postsContainer.innerHTML = "";
                posts.forEach((post) => {
                    const postCard = document.createElement("div");
                    postCard.className = "col-md-6 mb-4";
                    postCard.innerHTML = `
                    <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-primary">${
                                    post.title
                                }</h5>
                                <p class="card-text text-muted">
                                    ${
                                        post.content.length > 100
                                            ? post.content.substring(0, 100) +
                                              "..."
                                            : post.content
                                    }
                                </p>
                                <p class="text-muted mb-2">
                                    <small><i class="bi bi-clock"></i> Posted on ${
                                        post.date_posted
                                    }</small>
                                </p>
                                <a href="/post/view/${
                                    post.id
                                }" class="btn btn-outline-primary btn-sm">Read More</a>
                            </div>
                        </div>
                    `;
                    postsContainer.appendChild(postCard);
                });
            })
            .catch((error) => console.error("Error fetching posts:", error));
    }

    fetchUsers();
});
