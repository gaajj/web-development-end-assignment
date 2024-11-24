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

    $loginQuery = $connection->prepare("SELECT id, username, password, email FROM users WHERE username=:username");
    $loginQuery->bindParam(':username', $username, PDO::PARAM_STR);
    $loginQuery->execute();
    $user = $loginQuery->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];

        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION['message'] =  "Invalid username or password";

        header("Location: " . $_SERVER['PHP_SELF']);
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
            <label>Username:</label>
            <input type="text" name="username" required>
        </div>
        <div class="form-field">
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <div class="form-field">
            <label>&nbsp;</label>
            <input type="submit" value="Login">
        </div>
    </form>

    <a href="/register.php"><input type="button" value="Register" /></a>
</body>

</html>