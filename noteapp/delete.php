<?php
require_once "NoteModel.php"; // include the model

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"] ?? null;

    if ($id) {
        $noteModel = new NoteModel();   // create model instance
        $noteModel->deleteNote($id);   // call the delete method
    }
}

// redirect back to index
header("Location: index.php");
exit;
?>
