<?php include __DIR__ . '/../header.php'; ?>

<div class="container mt-4">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h1 class="card-title mb-4 text-primary"><?= htmlspecialchars($post->title) ?></h1>
            <p class="card-text"><?= nl2br(htmlspecialchars($post->content)) ?></p>
            <p class="text-muted mt-3">
                <small><i class="bi bi-clock"></i> Posted on <?= htmlspecialchars($post->date_posted) ?></small>
            </p>
            <?php if ($post->author_id == $_SESSION['user_id']): ?>
                <form action="/post/view/<?= $post->id ?>/delete" method="POST" style="display: inline;">
                    <button type="submit" class="btn btn-danger">Delete Post</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
    <div>
        <h3 class="mb-3 text-secondary">Comments</h3>

        <!-- Display any errors -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php include __DIR__ . '/comments.php'; ?>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>