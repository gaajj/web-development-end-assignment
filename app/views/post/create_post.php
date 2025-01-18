<?php include __DIR__ . '/../header.php'; ?>

<div class="container mt-4">
    <h1>Create a New Post</h1>

    <!-- Error Message Display -->
    <?php if (!empty($_SESSION['error_message'])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($_SESSION['error_message']) ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <!-- Post Creation Form -->
    <form method="POST" action="/post/create" class="mt-3">
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content:</label>
            <textarea name="content" id="content" rows="5" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>

<?php include __DIR__ . '/../footer.php'; ?>