<?php include __DIR__ . '/../header.php'; ?>

<?php if (!empty($_SESSION['username'])): ?>
    <h1>Hello, <?= htmlspecialchars($_SESSION['username']); ?>!</h1>
<?php else: ?>
    <h1>You are not logged in.</h1>
<?php endif; ?>

<?php include __DIR__ . '/../footer.php'; ?>