<?php

require_once 'database.php';

class NoteModel {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = (new Database())->pdo;
    }

    public function getNotes() {
        $stmt = $this->pdo->query("SELECT * FROM notes ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function createNote($title, $description) {
        $stmt = $this->pdo->prepare("INSERT INTO notes (title, description) VALUES (?, ?)");
        $stmt->execute([$title, $description]);
    }

    public function deleteNote($id) {
        $stmt = $this->pdo->prepare("DELETE FROM notes WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getNoteById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM notes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateNote($id, $title, $description) {
        $stmt = $this->pdo->prepare("UPDATE notes SET title=?, description=? WHERE id=?");
        $stmt->execute([$title, $description, $id]);
    }
}
