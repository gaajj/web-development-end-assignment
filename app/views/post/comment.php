<div class="comment-container mb-3 p-3" style="max-width: 75%; background-color: #f9f9f9; border-radius: 8px;">
    <div class="d-flex align-items-center">
        <!-- Profile picture -->
        <a href="/profile/<?= htmlspecialchars($comment->username) ?>" class="me-3">
            <img src="<?= !empty($user->profile_picture) ? '/../../uploads/profiles/' . htmlspecialchars($user->profile_picture) : '/../../uploads/profiles/default.png' ?>"
                alt="Profile Picture" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
        </a>
        <!-- Username -->
        <a href="/profile/<?= htmlspecialchars($comment->username) ?>">
            <h5 class="mb-1 text-primary"><?= htmlspecialchars($comment->username) ?></h5>
        </a>
    </div>
    <!-- Comment content -->
    <p class="mb-1" style="color: #555; word-wrap: break-word; overflow-wrap: break-word;">
        <?= nl2br(htmlspecialchars($comment->content)) ?>
    </p>
    <!-- Date -->
    <small class="text-muted">
        <i class="bi bi-clock"></i> Posted on <?= htmlspecialchars($comment->created_at) ?>
    </small>
</div>