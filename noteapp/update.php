<?php
require_once "NoteModel.php"; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"] ?? null;
    $title = trim($_POST["title"] ?? '');
    $description = trim($_POST["description"] ?? '');

    if ($id && $title && $description) {
        $noteModel = new NoteModel();
        $noteModel->updateNote($id, $title, $description); 
    }
}

header("Location: index.php");
exit;
?>
