</div>
<script>
document.querySelectorAll(".note-title").forEach(title => {
    title.addEventListener("click", () => {
        const card = title.closest(".note-card");
        const updateForm = card.querySelector(".update-form");
        const noteText = card.querySelector(".note-text");

        // Toggle
        updateForm.style.display =
            updateForm.style.display === "block" ? "none" : "block";

        noteText.style.display =
            noteText.style.display === "none" ? "block" : "none";
    });
});
</script>

</body>
</html>
