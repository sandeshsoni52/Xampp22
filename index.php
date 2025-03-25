<?php
include 'db_connect.php';
include 'functionsc.php';

// call all_allocation_process function
if (isset($_POST['allocatedopen'])) {
    allocatedOpenTable($conn);
}
// call OBC function
if (isset($_POST['obc1'])) {
    createAllocatedOBCTable($conn);
}

// Close connection
$conn->close();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Delete Records</title>
</head>

<body>

    <form method="post">
        <button type="submit" name="allocatedopen">open allocated table okk</button>
        <button type="submit" name="obc1">new table of obc allocated</button>
    </form>



</body>

</html>