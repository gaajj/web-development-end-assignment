<?php include __DIR__ . '/../header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-center mb-0">Posts</h1>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/post/create" class="btn btn-success">Create New Post</a>
        <?php endif; ?>
    </div>
    <ul class="list-group">
        <?php foreach ($posts as $post): ?>
            <li class="list-group-item p-0">
                <a href="post/view/<?= htmlspecialchars($post->id) ?>" class="d-block text-decoration-none text-dark">
                    <div class="d-flex align-items-start p-3">
                        <!--<img src="<?= htmlspecialchars($post->imageUrl) ?>" class="me-3 rounded" alt="<?= htmlspecialchars($post->title) ?>" style="width: 64px; height: 64px; object-fit: cover;"> -->
                        <div>
                            <h5 class="mb-1"><?= htmlspecialchars($post->title) ?></h5>
                            <p class="mb-1 text-muted"><?= htmlspecialchars($post->content) ?></p>
                            <small class="text-muted">Posted on <?= htmlspecialchars($post->date_posted) ?></small>
                        </div>
                    </div>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php include __DIR__ . '/../footer.php'; ?>