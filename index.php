<!DOCTYPE html>
<html>
<head>
    <title>Task List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .task {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 10px 0;
            padding: 15px;
            box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);
        }

        .task h2 {
            font-size: 24px;
            color: #3498db;
        }

        .task p {
            margin: 10px 0;
        }

        .task .options {
            display: flex;
            justify-content: space-between;
        }

        .task .options a {
            text-decoration: none;
            padding: 5px 10px;
            color: #3498db;
            border: 1px solid #3498db;
            border-radius: 3px;
        }

        .task .options a:hover {
            background-color: #3498db;
            color: white;
        }

        .nav {
            background-color: #3498db;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        .nav h1 {
            margin: 0;
        }

        .nav a {
            color: white;
            text-decoration: none;
        }

        .add-button {
            margin-top:-35px;
            float:right;
            background-color: #1976D2;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            text-decoration: none;
        }

        .add-button:hover {
            background-color: #1565C0;
        }
    </style>
</head>
<body>
    <div class="nav">
        <h1>Task List</h1>
        <a href="add_task.html" class="add-button">Add New Task</a>
    </div>

    <div class="container">
        <?php
        // Connect to the database (update database credentials)
        $db = new mysqli("localhost", "root", "", "db");

        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        // Fetch tasks from the database
        $query = "SELECT * FROM tasks";
        $result = $db->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='task'>";
                echo "<h2>" . $row["title"] . "</h2>";
                echo "<p>Due Date: " . $row["due_date"] . "</p>";
                echo "<p>Status: " . ($row["status"] ? "Completed" : "Not Completed") . "</p>";
                echo "<div class='options'>";
                echo "<a href='edit.php?id=" . $row["id"] . "'>Edit</a>";
                echo "<a href='delete_task.php?id=" . $row["id"] . "'>Delete</a>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "No tasks found";
        }

        $db->close();
        ?>
    </div>
</body>
</html>
