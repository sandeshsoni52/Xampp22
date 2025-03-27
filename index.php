<?php
include 'db_connect.php';
include 'functionsc.php';

$ect = 'sixty';

// call all_allocation_process function
if (isset($_POST['allocatedopen'])) {
    allocatedOpenTable($conn);
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
    </form>
</body>

</html>