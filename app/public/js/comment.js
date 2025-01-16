document.addEventListener("DOMContentLoaded", function () {
    const commentContent = document.getElementById("commentContent");
    const charCounter = document.getElementById("charCounter");

    // Initialize the character counter
    function updateCharCounter() {
        const charCount = commentContent.value.length;
        charCounter.textContent = `${charCount} / 1000 characters`;

        if (charCount > 900) {
            charCounter.style.color = "red"; // Show warning when close to limit
        } else {
            charCounter.style.color = "gray";
        }

        if (charCount > 1000) {
            commentContent.value = commentContent.value.slice(0, 1000); // Truncate input to 1000 characters
            charCounter.textContent = `1000 / 1000 characters`; // Set counter to max
        }
    }

    commentContent.addEventListener("input", updateCharCounter);

    updateCharCounter(); // Initialize the counter on page load
});
