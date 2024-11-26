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

    <!-- Temp hardcoded -->
    <?php include 'components/card.php';
    $image = "https://data.maglr.com/3363/issues/37129/470998/assets/media/8a4e3b401bc646c566d2e2b5dbbca487453f648a076f32648c4ace721b7f7ad6.jpg";
    $title = "Title";
    $description = "Description babagjshaba";
    $upvotes = 10;
    $downvotes = 3;
    renderCard($image, $title, $description, $upvotes, $downvotes);
    ?>
</div>

<!-- Footer -->
<?php include 'component/footer.php'; ?>