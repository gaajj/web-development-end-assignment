<?php
function renderCard($title, $description) {
    ?>
    <div class="card shadow-sm" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></h5>
            <p class="card-text"><?php echo htmlspecialchars($description, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    </div>
    <?php
}
?>