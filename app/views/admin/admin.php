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
                <!-- User rows will be populated by JavaScript -->
            </tbody>
        </table>
    </div>

    <h2 class="text-center mb-4">Post List</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Author ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="postTableBody">
                <!-- Post rows will be populated by JavaScript -->
            </tbody>
        </table>
    </div>
</div>

<script src="/js/admin.js"></script>
<?php include __DIR__ . '/../footer.php'; ?>