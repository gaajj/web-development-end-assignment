<?php include __DIR__ . '/../header.php'; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">User List</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users) && is_array($users)): ?>
                    <?php foreach ($users as $index => $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user->id); ?></td>
                            <td><?php echo htmlspecialchars($user->username); ?></td>
                            <td><?php echo htmlspecialchars($user->email); ?></td>
                            <td>
                                <a href="/profile/<?php echo htmlspecialchars($user->username); ?>"
                                    class="btn btn-info btn-sm">View</a>
                                <a href="/profile/<?php echo htmlspecialchars($user->username); ?>/edit"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <a href="/profile/<?php echo htmlspecialchars($user->username); ?>/delete"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>