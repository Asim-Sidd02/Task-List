<?php
if (isset($_GET['id'])) {
    $task_id = $_GET['id'];

    // Connect to the database (update database credentials)
    $db = new mysqli("localhost", "root", "", "db");

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // SQL query to delete the task
    $query = "DELETE FROM tasks WHERE id = $task_id";

    if ($db->query($query) === TRUE) {
        echo "Task deleted successfully. <a href='index.php'>Go back to Task List</a>";
    } else {
        echo "Error deleting task: " . $db->error;
    }

    $db->close();
} else {
    echo "Invalid task ID.";
}
?>
