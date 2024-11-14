<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tasks WHERE id = $id";
    $result = $conn->query($sql);
    $task = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_task = $_POST['task'];
        $update_sql = "UPDATE tasks SET task = '$new_task' WHERE id = $id";
        if ($conn->query($update_sql) === TRUE) {
            header("Location: index.php");
            exit;
        } else {
            echo "Error updating task: " . $conn->error;
        }
    }
} else {
    echo "No task ID provided.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Task</h1>
        <form action="edit_task.php?id=<?php echo $task['id']; ?>" method="POST">
            <input type="text" name="task" value="<?php echo htmlspecialchars($task['task']); ?>" required>
            <button type="submit" class="btn">Update Task</button>
        </form>
        <a href="index.php" class="btn back-btn">Back to To-Do List</a>
    </div>
</body>
</html>
