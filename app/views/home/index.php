<?php include __DIR__ . '/../header.php'; ?>

<?php
if ($posts):
    echo "<h2>Recent Posts</h2>";
    echo "<ul>";
    foreach ($posts as $post):
        echo "<li>";
        echo "<strong>" . htmlspecialchars($post->title) . "</strong><br>";
        echo "<p>" . nl2br(htmlspecialchars($post->content)) . "</p>";
        echo "<small>Posted on: " . htmlspecialchars($post->date_posted) . "</small>";
        echo "</li><hr>";
    endforeach;
    echo "</ul>";
else:
    echo "<p>No posts available.</p>";
endif;

?>

<?php include __DIR__ . '/../footer.php'; ?>