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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="container text-center">
        <!-- Greeting Section -->
        <div class="card shadow p-4">
            <div class="card-body">
                <?php if (!empty($_SESSION['user_id'])): ?>
                    <h1 class="card-title">Welcome, <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?>!</h1>
                <?php else: ?>
                    <h1 class="card-title">Welcome, Guest!</h1>
                <?php endif; ?>
            </div>
            <div class="mt-3">
                <a href="/login.php" class="btn btn-primary">Login</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-pE3ovC47Uugle4HU3Yg6XMwpWBcRrNar04r79PQ6nUcHqkMfSIFLRDYj4E5x0j8E" crossorigin="anonymous"></script>
</body>
</html>