<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $description = $_POST["description"];
    $due_date = $_POST["due_date"];
    $status = isset($_POST["status"]) ? 1 : 0; // Check if the checkbox is checked

    // Connect to the database (update database credentials)
    $db = new mysqli("localhost", "root", "", "db");

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Insert the task into the database
    $query = "INSERT INTO tasks (title, description, due_date, status) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("sssi", $title, $description, $due_date, $status);

    if ($stmt->execute()) {
        echo "Task added successfully!";
    } else {
        echo "Error: " . $db->error;
    }

    $stmt->close();
    $db->close();
}
?>
