<!-- Comment Section for Logged-In Users -->
<?php if (isset($_SESSION['username'])): ?>
<form action="/post/view/<?= htmlspecialchars($post->id) ?>" method="POST" class="mb-4">
    <div class="form-group mb-3">
        <textarea class="form-control" id="commentContent" name="content" rows="3"
            placeholder="Write your comment here..." required></textarea>
        <small id="charCounter" class="form-text text-muted">0 / 1000 characters</small>
    </div>
    <button type="submit" class="btn btn-primary">Submit Comment</button>
</form>
<?php else: ?>
<p class="text-muted">You must <a href="/login">log in</a> to post a comment.</p>
<?php endif; ?>

<!-- Display Comments -->
<?php if ($comments): ?>
<?php foreach ($comments as $comment): ?>
<?php include __DIR__ . '/comment.php'; ?>
<?php endforeach; ?>
<?php else: ?>
<p class="text-muted">No comments yet. Be the first to comment!</p>
<?php endif; ?>