<?php include __DIR__ . '/../header.php'; ?>

<h1>Create a New Post</h1>

<?php if (!empty($_SESSION['error_message'])): ?>
    <p style="color: red;"><?= htmlspecialchars($_SESSION['error_message']) ?></p>
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>

<form method="POST" action="/post/create">
    <label for="title">Title:</label><br>
    <input type="text" name="title" id="title" required><br><br>

    <label for="content">Content:</label><br>
    <textarea name="content" id="content" rows="5" required></textarea><br><br>

    <button type="submit">Create Post</button>
</form>

<?php include __DIR__ . '/../footer.php'; ?>