<?php
require_once "NoteModel.php"; 
include "views/header.php";

$noteModel = new NoteModel();       
$notes = $noteModel->getNotes();    // fetch all notes
?>

<!-- Create Note Form -->
<form class="note-form" action="create.php" method="POST">
    <input type="text" name="title" placeholder="Note title" required>
    <textarea name="description" rows="3" placeholder="Note description..." required></textarea>
    <button class="btn-create">+ Create Note</button>
</form>

<!-- Notes List -->
<div class="notes-list">
    <?php foreach ($notes as $note): ?>
        <div class="note-card">
            <div class="note-header">
              <h3 class="note-title" data-id="<?= $note['id'] ?>">
    <?= htmlspecialchars($note['title']) ?>
</h3>


                <form action="delete.php" method="POST">
                    <input type="hidden" name="id" value="<?= $note['id'] ?>">
                    <button class="btn-close">×</button>
                </form>
            </div>

            <p class="note-text"><?= nl2br(htmlspecialchars($note['description'])) ?></p>
            <span class="note-date"><?= $note['created_at'] ?></span>

            <!-- Update Form -->
            <form action="update.php" method="POST" class="update-form">
                <input type="hidden" name="id" value="<?= $note['id'] ?>">
                <input type="text" name="title" value="<?= htmlspecialchars($note['title']) ?>" required>
                <textarea name="description" required><?= htmlspecialchars($note['description']) ?></textarea>
                <button class="btn-update">Update</button>
            </form>

        </div>
    <?php endforeach; ?>
</div>

<?php include "views/footer.php"; ?>
