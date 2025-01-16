<?php include __DIR__ . '/../header.php'; ?>

<div class="container mt-5">
    <!-- Profile Picture Section -->
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <!-- Profile Picture -->
            <img src="<?= !empty($user->profile_picture) ? '/../../uploads/profiles/' . htmlspecialchars($user->profile_picture) : '/../../uploads/profiles/default.png' ?>"
                alt="Profile Picture" class="rounded-circle mb-3"
                style="width: 150px; height: 150px; object-fit: cover;">

            <!-- Username -->
            <h1 class="display-4 mb-1 fw-bold"><?= htmlspecialchars($user->username); ?></h1>

            <!-- Role (only if admin) -->
            <?php if ($user->role === 'admin'): ?>
                <p class="text-muted mb-3">(Admin)</p>
            <?php endif; ?>

            <!-- Email -->
            <p class="lead">Email: <?= htmlspecialchars($user->email); ?></p>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>