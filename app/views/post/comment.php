<div class="comment-container mb-3 p-3"
    style="background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div class="d-flex align-items-center">
            <!-- Profile picture -->
            <a href="/profile/<?= htmlspecialchars($comment->username) ?>" class="me-3">
                <img src="<?= !empty($comment->profile_picture) ? '/../../uploads/profiles/' . htmlspecialchars($comment->profile_picture) : '/../../uploads/profiles/default.png' ?>"
                    alt="Profile Picture" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
            </a>
            <!-- Username -->
            <a href="/profile/<?= htmlspecialchars($comment->username) ?>">
                <h5 class="mb-0 text-primary"><?= htmlspecialchars($comment->username) ?></h5>
            </a>
        </div>
        <?php if ((isset($_SESSION['user_id']) && $_SESSION['user_id'] == $comment->user_id) || $_SESSION['role'] == 'admin'): ?>
            <form action="/post/view/<?= $post->id ?>/comment/<?= $comment->id ?>/delete" method="POST">
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
        <?php endif; ?>
    </div>
    <!-- Comment content -->
    <p class="mb-2" style="color: #555; word-wrap: break-word; overflow-wrap: break-word; font-size: 14px;">
        <?= nl2br(htmlspecialchars($comment->content)) ?>
    </p>
    <!-- Date -->
    <small class="text-muted" style="font-size: 12px;">
        <i class="bi bi-clock"></i> Posted on <?= htmlspecialchars($comment->created_at) ?>
    </small>
</div>