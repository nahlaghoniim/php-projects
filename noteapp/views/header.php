<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App</title>
    <link rel="stylesheet" href="public/css/app.css">
</head>
<body>
<div class="container">
    <h1 class="app-title">My Notes</h1>
<script>
document.querySelectorAll('.note-title').forEach(title => {
    title.addEventListener('click', () => {
        const form = title.parentElement.querySelector('.update-form');
        form.style.display = form.style.display === 'none' ? 'flex' : 'none';
    });
});
</script>
    