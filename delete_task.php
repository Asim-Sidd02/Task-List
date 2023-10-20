<?php
if (isset($_GET['id'])) {
    $task_id = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Task</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function confirmDelete() {
            var result = confirm("Are you sure you want to delete this task?");
            if (result) {
                // If the user confirms, redirect to the actual delete action
                window.location.href = "delete_task_action.php?id=<?php echo $task_id; ?>";
            } else {
                // If the user cancels, return to the task list
                window.location.href = "index.php";
            }
        }
    </script>
</head>
<body>
    <div class="nav">
        <h1>Delete Task</h1>
        <a href="index.php" class="nav-button">Task List</a>
    </div>

    <div class="container">
        <button onclick="confirmDelete()">Delete Task</button>
    </div>
</body>
</html>
<?php
} else {
    echo "Invalid task ID.";
}
?>
