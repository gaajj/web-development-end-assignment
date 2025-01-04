<div class="col-md-6">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">Profile Picture</h3>

            <?php if (!empty($statusMsgPfp)): ?>
                <div class="alert alert-<?php echo htmlspecialchars($statusMsgPfp['type']); ?> alert-dismissible fade show"
                    role="alert">
                    <?php echo htmlspecialchars($statusMsgPfp['message']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="/profile/<?php echo htmlspecialchars($username); ?>/picture" method="POST"
                enctype="multipart/form-data">
                <div class="d-flex mb-3 align-items-center">
                    <div class="d-flex justify-content-center"
                        style="width: 100px; height: 100px; overflow: hidden; border-radius: 50%; position: relative; margin-right: 15px;">
                        <img src="<?php echo $_SESSION['profile_picture']; ?>" alt="profile picture"
                            style="width: 100%; height: 100%; object-fit: cover;" />
                    </div>
                    <div>
                        <label for="picture" class="form-label">Select picture:</label>
                        <input type="file" name="picture" id="picture" class="form-control">
                    </div>
                </div>
                <div class="d-grid">
                    <input type="submit" name="submit" value="Upload" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>