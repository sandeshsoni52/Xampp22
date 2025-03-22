<!DOCTYPE html>
<html>

<head>
    <title>Delete Records</title>
</head>

<body>

    <form method="post">
        <button type="submit" name="insert">Insert New Record</button>
        <button type="submit" name="delete">Delete All Except Top 2</button>
    </form>

    <?php
    // Database connection details
    $host = "localhost"; // e.g., "localhost"
    $user = "root";
    $password = "";
    $database = "test_db";

    // Create connection
    $conn = new mysqli($host, $user, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle insert request
    if (isset($_POST['insert'])) {
        // Example: Insert a new record with dummy data
        $sql_cat1 = "CREATE TABLE tablecat2 AS 
        SELECT * FROM unallocatedcommon";

        if ($conn->query($sql_cat1) === TRUE) {
            echo "New ST allocated table created successfully!";
        } else {
            echo "Error: " . $conn->error;
        }

        // Example: Insert a new record with dummy data
        $sql_fish4 = "CREATE TABLE tablefish4 AS 
        SELECT * FROM unallocatedcommon";

        if ($conn->query($sql_fish4) === TRUE) {
            echo "New ST allocated table created successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    if (isset($_POST['delete'])) {
        // SQL query to delete all rows except the top 2
        $sql = "DELETE FROM allocatedNTC 
                WHERE srno NOT IN (
                    SELECT srno FROM (
                        SELECT srno FROM allocatedNTC 
                        ORDER BY srno 
                        LIMIT 2
                    ) AS temp
                )";

        if ($conn->query($sql) === TRUE) {
            echo "Records deleted successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }


    // Close connection
    $conn->close();

    ?>

</body>

</html>