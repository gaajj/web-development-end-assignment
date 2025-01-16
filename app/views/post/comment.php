<div class="comment-container mb-3 p-3" style="max-width: 75%; background-color: #f9f9f9; border-radius: 8px;">
    <a href="/profile/<?= htmlspecialchars($comment->username) ?>" <h5
        class="mb-1 text-primary"><?= htmlspecialchars($comment->username) ?></h5></a>
    <p class="mb-1" style="color: #555; word-wrap: break-word; overflow-wrap: break-word;">
        <?= nl2br(htmlspecialchars($comment->content)) ?></p>
    <small class="text-muted">
        <i class="bi bi-clock"></i> Posted on <?= htmlspecialchars($comment->created_at) ?>
    </small>
</div>