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

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
</head>

<body>
    <?php if (!empty($message)): ?>
        <p style="color: red;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">
        <div class="form-field">
            <label>Username*:</label>
            <input type="text" name="username" required>
        </div>
        <div class="form-field">
            <label>Password*:</label>
            <input type="password" name="password" required>
        </div>
        <div class="form-field">
            <label>Email:</label>
            <input type="text" name="email">
        </div>
        <div class="form-field">
            <label>&nbsp;</label>
            <input type="submit" value="Register">
        </div>
    </form>

    <a href="/login.php"><input type="button" value="Login" /></a>
</body>

</html>