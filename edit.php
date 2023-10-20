<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <link rel="stylesheet" type="text/css" href="edit.css">
</head>
<body>
    <nav>
        <h1>Update Task</h1>
        <a href="index.php" class="nav-button">Task List</a>
    </nav>

    <div class="container">
        <?php
        if (isset($_GET['id'])) {
            $task_id = $_GET['id'];

            // Connect to the database (update database credentials)
            $db = new mysqli("localhost", "root", "", "db");

            if ($db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }

            // Fetch the task details by ID
            $query = "SELECT * FROM tasks WHERE id = $task_id";
            $result = $db->query($query);

            if ($result->num_rows === 1) {
                $task = $result->fetch_assoc();
        ?>
                <form action="update_task.php" method="post">
                    <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
                    <label for="title">Title:</label>
                    <input type="text" name="title" value="<?php echo $task['title']; ?>" required><br><br>

                    <label for="description">Description:</label>
                    <textarea name="description" rows="4" cols="50"><?php echo $task['description']; ?></textarea><br><br>

                    <label for="due_date">Due Date:</label>
                    <input type="date" name="due_date" value="<?php echo $task['due_date']; ?>"><br><br>

                    <label for="status">Status:</label>
                    <select name="status" required>
                        <option value="Complete" <?php echo $task['status'] == 'Complete' ? 'selected' : ''; ?>>Complete</option>
                        <option value="Incomplete" <?php echo $task['status'] == 'Incomplete' ? 'selected' : ''; ?>>Incomplete</option>
                    </select><br><br>

                    <input type="submit" value="Update Task">
                </form>
        <?php
            } else {
                echo "Task not found.";
            }

            $db->close();
        } else {
            echo "Invalid task ID.";
        }
        ?>
    </div>
</body>
</html>
