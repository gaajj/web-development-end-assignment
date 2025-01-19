<?php include __DIR__ . '/../header.php'; ?>

<div class="container mt-4">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <h1 class="mb-3 text-primary">Welcome to TechBlog</h1>
        <p class="text-muted">Explore the latest posts from our community or share your thoughts by creating a new post.
        </p>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/post/create" class="btn btn-success">Create New Post</a>
        <?php endif; ?>
    </div>

    <!-- Posts Section -->
    <div>
        <h2 class="mb-4 text-secondary">Recent Posts</h2>
        <div class="row" id="posts-container">

        </div>
    </div>
</div>

<script src="/js/index.js"></script>
<?php include __DIR__ . '/../footer.php'; ?>