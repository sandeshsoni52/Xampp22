<!DOCTYPE html>
<html>

<head>
    <title>Delete Records</title>
</head>

<body>

    <form method="post">
        <button type="submit" name="st1">new table of ST allocated incomplete</button>
        <button type="submit" name="st2">Final ST allocated</button>
        <button type="submit" name="obc1">new table of obc allocated</button>
        <button type="submit" name="ntc">new table of NT-c allocated </button>
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

    // Handle ST two buttons
    if (isset($_POST['st1'])) {
        // query1/2
        $sql_cat1 = "CREATE TABLE allocatedST AS 
        SELECT * FROM unallocatedcommon";

        if ($conn->query($sql_cat1) === TRUE) {
            echo "New ST allocated table created successfully!";
        } else {
            echo "Error: " . $conn->error;
        }

        // query 2/2
        $sql_fish4 = "DELETE FROM allocatedST
        WHERE category <> 'ST'";

        if ($conn->query($sql_fish4) === TRUE) {
            echo " New ST allocated table created successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    if (isset($_POST['st2'])) {
        // SQL query to delete all rows except the top 3
        $sql = "DELETE FROM allocatedST 
                WHERE srno NOT IN (
                    SELECT srno FROM (
                        SELECT srno FROM allocatedST
                        ORDER BY srno 
                        LIMIT 3
                    ) AS temp
                )";

        if ($conn->query($sql) === TRUE) {
            echo "Records deleted successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    // Handle OBC button
    if (isset($_POST['obc1'])) {
        // query1/3
        $sql_cat1 = "CREATE TABLE allocatedOBC AS 
        SELECT * FROM unallocatedcommon";
        if ($conn->query($sql_cat1) === TRUE) {
            echo "New obc allocated table created successfully!";
        } else {
            echo "Error: " . $conn->error;
        }

        // query 2/3
        $sql_fish4 = "DELETE FROM allocatedOBC
        WHERE category <> 'OBC'";
        if ($conn->query($sql_fish4) === TRUE) {
            echo " all OBC table , successfully!";
        } else {
            echo "Error: " . $conn->error;
        }

        // query 3/3
        // SQL query to delete all rows except the top 4
        $sql = "DELETE FROM allocatedOBC 
                WHERE srno NOT IN (
                    SELECT srno FROM (
                        SELECT srno FROM allocatedOBC
                        ORDER BY srno 
                        LIMIT 4
                    ) AS temp
                )";
        if ($conn->query($sql) === TRUE) {
            echo "Records deleted successfully and proper OBC_allocated!";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    // Handle NTC button
    if (isset($_POST['ntc'])) {
        // query1/3
        $sql_cat1 = "CREATE TABLE allocatedNTC AS 
        SELECT * FROM unallocatedcommon";
        if ($conn->query($sql_cat1) === TRUE) {
            echo "New NTC allocated table created successfully!";
        } else {
            echo "Error: " . $conn->error;
        }

        // query 2/3
        $sql_fish4 = "DELETE FROM allocatedNTC
        WHERE category <> 'NTC'";
        if ($conn->query($sql_fish4) === TRUE) {
            echo " all NTC table , successfully!";
        } else {
            echo "Error: " . $conn->error;
        }

        // query 3/3
        // SQL query to delete all rows except the top 1
        $sql = "DELETE FROM allocatedNTC 
                WHERE srno NOT IN (
                    SELECT srno FROM (
                        SELECT srno FROM allocatedNTC
                        ORDER BY srno 
                        LIMIT 1
                    ) AS temp
                )";
        if ($conn->query($sql) === TRUE) {
            echo "Records deleted successfully and proper NT C_allocated!";
        } else {
            echo "Error: " . $conn->error;
        }
    }



    // Close connection
    $conn->close();

    ?>

</body>

</html>