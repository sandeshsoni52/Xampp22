<!DOCTYPE html>
<html>

<head>
    <title>Delete Records</title>
</head>

<body>

    <form method="post">
        <button type="submit" name="sc">new table of SC allocated </button>
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


    // Handle SC button
    if (isset($_POST['sc'])) {
        // query1/3
        $sql_cat1 = "CREATE TABLE allocatedSC AS 
            SELECT * FROM unallocatedcommon";
        if ($conn->query($sql_cat1) === TRUE) {
            echo "New SC allocated table created successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }


    // Close connection
    $conn->close();

    ?>

</body>

</html>