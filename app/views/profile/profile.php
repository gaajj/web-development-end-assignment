<?php include __DIR__ . '/../header.php'; ?>

<div class="container mt-5">
    <!-- Profile Picture Section -->
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <h1 class="display-4 mb-3 fw-bold"><?php echo htmlspecialchars($user->username); ?></h1>
            <div class="mb-4">
                <img src="path/to/profile-pic.jpg" alt="Profile Picture" class="img-fluid rounded-circle"
                    style="width: 150px; height: 150px; object-fit: cover;">
            </div>
            <p class="lead">
                Email: <?php echo htmlspecialchars($user->email); ?>
            </p>

            <?php if ($user->id == $_SESSION['user_id']): ?>
                <a href="<?php echo htmlspecialchars($user->username); ?>/edit" class="btn btn-primary btn-lg">Edit
                    Profile</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>