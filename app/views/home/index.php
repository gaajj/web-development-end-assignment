<?php include __DIR__ . '/../header.php'; ?>

<div class="container mt-4">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <h1 class="mb-3 text-primary">Welcome to the Blog</h1>
        <p class="text-muted">Explore the latest posts from our community or share your thoughts by creating a new post.
        </p>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/post/create" class="btn btn-success">Create New Post</a>
        <?php endif; ?>
    </div>

    <!-- Posts Section -->
    <div>
        <h2 class="mb-4 text-secondary">Recent Posts</h2>
        <?php if (!empty($posts)): ?>
            <div class="row">
                <?php foreach ($posts as $post): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-primary"><?= htmlspecialchars($post->title) ?></h5>
                                <p class="card-text text-muted">
                                    <?= htmlspecialchars(strlen($post->content) > 100 ? substr($post->content, 0, 100) . '...' : $post->content) ?>
                                </p>
                                <p class="text-muted mb-2">
                                    <small><i class="bi bi-clock"></i> Posted on
                                        <?= htmlspecialchars($post->date_posted) ?></small>
                                </p>
                                <a href="post/view/<?= htmlspecialchars($post->id) ?>"
                                    class="btn btn-outline-primary btn-sm">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info text-center">
                <p>No posts available yet. Be the first to <a href="/post/create" class="alert-link">create a new post</a>!
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>