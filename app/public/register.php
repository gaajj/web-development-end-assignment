<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
}

require_once("dbconfig.php");
try {
    $connection = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    $checkUserQuery = $connection->prepare("SELECT id FROM users WHERE username=:username");
    $checkUserQuery->bindParam(':username', $username, PDO::PARAM_STR);
    $checkUserQuery->execute();
    $existingUser = $checkUserQuery->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        $_SESSION['message'] = "Username is already taken.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertUserQuery = $connection->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
        $insertUserQuery->bindParam(':username', $username, PDO::PARAM_STR);
        $insertUserQuery->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $insertUserQuery->bindParam(':email', $email, PDO::PARAM_STR);
        $insertUserQuery->execute();

        header("Location: login.php");
        exit();
    }
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<!-- Header -->
<?php include 'component/header.php'; ?>
<!-- Navbar -->
<?php include 'component/navbar.php'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Register</h3>
                    
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username<span class="text-danger">*</span>    :</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password<span class="text-danger">*</span>:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <a href="/login.php" class="btn btn-link">Already have an account?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include 'component/footer.php'; ?>