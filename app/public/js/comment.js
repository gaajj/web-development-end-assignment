document.addEventListener("DOMContentLoaded", function () {
    const commentContent = document.getElementById("commentContent");
    const charCounter = document.getElementById("charCounter");

    // Initialize the character counter
    function updateCharCounter() {
        const charCount = commentContent.value.length;
        charCounter.textContent = `${charCount} / 1000 characters`;

        if (charCount > 1000) {
            commentContent.value = commentContent.value.slice(0, 1000);
            charCounter.textContent = `1000 / 1000 characters`;
        }
    }

    commentContent.addEventListener("input", updateCharCounter);

    updateCharCounter();
});
