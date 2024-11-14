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

$sql = "SELECT * FROM tasks ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>To-Do List Application</h1>
        
        <!-- Add New Task Form -->
        <form action="index.php" method="POST" class="task-form">
            <input type="text" name="task" placeholder="Enter a new task" required>
            <button type="submit" class="btn">Add Task</button>
        </form>

        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li>
                    <span><?php echo htmlspecialchars($row['task']); ?></span>
                    <div class="task-actions">
                        <a href="edit_task.php?id=<?php echo $row['id']; ?>" class="btn edit">Edit</a>
                        <a href="delete_task.php?id=<?php echo $row['id']; ?>" class="btn delete">Delete</a>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>
