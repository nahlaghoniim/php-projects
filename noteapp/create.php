<?php
require_once "NoteModel.php"; // include the model

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);

    if ($title && $description) {
        $noteModel = new NoteModel(); // create an instance of the model
        $noteModel->createNote($title, $description); // use the model method
    }
}

// redirect back to the main page
header("Location: index.php");
exit;
?>
