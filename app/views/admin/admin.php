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
            <tbody id="userTableBody">

            </tbody>
        </table>
    </div>
</div>

<script src="/js/admin.js"></script>
<?php include __DIR__ . '/../footer.php'; ?>