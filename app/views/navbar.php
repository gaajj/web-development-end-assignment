<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4 fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">TechBlog</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
            </ul>
            <div class="d-flex">
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <a href="/admin" class="btn btn-outline-secondary me-2">Admin Panel</a>
                <?php endif; ?>
                <?php if (!empty($_SESSION['username'])): ?>
                    <a class="navbar-text nav-link me-2" href="/profile/<?php echo $_SESSION['username']; ?>">
                        <span>
                            <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </span>
                    </a>
                    <a href="/logout" class="btn btn-outline-secondary me-2">Logout</a>
                <?php else: ?>
                    <a href="/login" class="btn btn-outline-primary me-2">Login</a>
                    <a href="/register" class="btn btn-primary">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>