<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = $_POST['task'];
    $sql = "INSERT INTO tasks (task) VALUES ('$task')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add New Task</h1>
        <form action="add_task.php" method="POST">
            <input type="text" name="task" placeholder="Enter your task" required>
            <button type="submit" class="btn">Add Task</button>
        </form>
        <a href="index.php" class="btn back-btn">Back to To-Do List</a>
    </div>
</body>
</html>
