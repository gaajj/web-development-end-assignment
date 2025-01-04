<?php include __DIR__ . '/../header.php'; ?>

<div class="container">
    <div class="p-2 text-center" style="width: 100%;">
        <h1><?php echo $user->username; ?></h1>
    </div>

    <div class="row justify-content-center">
        <?php include_once('edit_picture.php'); ?>
        <?php include_once('edit_info.php'); ?>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>