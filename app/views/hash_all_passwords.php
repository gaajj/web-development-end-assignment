<?php

namespace App;

use Exception;
use PDO;

try {
    // Database configuration
    $type = "mysql";
    $servername = "mysql";
    $username = "dev";
    $password = "dev";
    $dbname = "assignmentdb";

    // Create a new PDO connection
    $connection = new PDO("$type:host=$servername;dbname=$dbname", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all users
    $query = $connection->prepare("SELECT id, password FROM users");
    $query->execute();
    $users = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $user) {
        $id = $user['id'];
        $plainPassword = $user['password'];

        // Hash the plain-text password
        $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

        // Update the database with the hashed password
        $updateQuery = $connection->prepare("UPDATE users SET password = :hashedPassword WHERE id = :id");
        $updateQuery->bindParam(':hashedPassword', $hashedPassword, PDO::PARAM_STR);
        $updateQuery->bindParam(':id', $id, PDO::PARAM_INT);
        $updateQuery->execute();

        echo "Password for user ID $id has been hashed successfully.<br>";
    }

    echo "All passwords have been hashed.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
