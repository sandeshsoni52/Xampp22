<!DOCTYPE html>
<html>
<head>
    <title>Delete Records</title>
</head>
<body>

    <form method="post">
        <button type="submit" name="delete">Delete All Except Top 4</button>
    </form>

    <?php
    if (isset($_POST['delete'])) {
        // Database connection details
        $host = "your_host"; // e.g., "localhost"
        $user = "your_username"; 
        $password = "your_password";
        $database = "your_database";

        // Create connection
        $conn = new mysqli($host, $user, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to delete all rows except the top 4
        $sql = "DELETE FROM allocatedOBC 
                WHERE id NOT IN (
                    SELECT id FROM (
                        SELECT id FROM allocatedOBC 
                        ORDER BY id 
                        LIMIT 4
                    ) AS temp
                )";

        if ($conn->query($sql) === TRUE) {
            echo "Records deleted successfully!";
        } else {
            echo "Error: " . $conn->error;
        }

        // Close connection
        $conn->close();
    }
    ?>

</body>
</html>
