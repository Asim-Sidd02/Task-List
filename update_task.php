<?php
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the task ID from the form
    $task_id = $_POST['task_id'];

    // Connect to the database (update database credentials)
    $db = new mysqli("localhost", "root", "", "db");

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Sanitize and retrieve form data
    $title = $db->real_escape_string($_POST['title']);
    $description = $db->real_escape_string($_POST['description']);
    $due_date = $_POST['due_date'];
    $status = $_POST['status'];

    // Update the task in the database
    $query = "UPDATE tasks SET title = '$title', description = '$description', due_date = '$due_date', status = '$status' WHERE id = $task_id";

    if ($db->query($query) === TRUE) {
        echo "Task updated successfully. <a href='index.php'>Go back to Task List</a>";
    } else {
        echo "Error updating task: " . $db->error;
    }

    $db->close();
} else {
    echo "Invalid request.";
}
?>
