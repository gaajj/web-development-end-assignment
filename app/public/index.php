<?php
session_start();

require_once("dbconfig.php");
try {
    $connection = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
    exit();
}

?>

<!-- Header -->
<?php include 'component/header.php'; ?>
<!-- Navbar -->
<?php include 'component/navbar.php'; ?>

<div class="container text-center">
    <div class="card shadow p-4">
        <div class="card-body">
            <?php if (!empty($_SESSION['user_id'])): ?>
                <h1 class="card-title">Welcome, <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?>!</h1>
                </div>
                <div class="mt-3">
                    <a href="/logout.php" class="btn btn-secondary">Logout</a>
                </div>
            <?php else: ?>
                <h1 class="card-title">Welcome, Guest!</h1>
                </div>
                <div class="mt-3">
                    <a href="/login.php" class="btn btn-primary">Login</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include 'component/footer.php'; ?>