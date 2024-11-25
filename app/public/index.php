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
    <?php if (!empty($_SESSION['user_id'])): ?>
        <h1>Welcome <?php echo $_SESSION['username'] ?></h1>
    <?php else: ?>
        <h1>Welcome guest</h1>
    <?php endif; ?>

    <a href="/login.php"><input type="button" value="Login" /></a>
</body>

</html>