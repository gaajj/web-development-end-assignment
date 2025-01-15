<?php include __DIR__ . '/../header.php'; ?>

<div class="container mt-4">
    <h1 class="text-center mb-4">Posts</h1>
    <ul class="list-group">
        <?php foreach ($posts as $post): ?>
            <li class="list-group-item">
                <div class="d-flex align-items-start">
                    <!--<img src="<?= htmlspecialchars($post->imageUrl) ?>" class="me-3 rounded" alt="<?= htmlspecialchars($card->title) ?>" style="width: 64px; height: 64px; object-fit: cover;"> -->
                    <div>
                        <h5 class="mb-1">
                            <a href="#" class="text-decoration-none text-dark"><?= htmlspecialchars($post->title) ?></a>
                        </h5>
                        <p class="mb-1 text-muted"><?= htmlspecialchars($post->content) ?></p>
                        <small class="text-muted">Posted on <?= htmlspecialchars($post->date_posted) ?></small>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php include __DIR__ . '/../footer.php'; ?>