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
        <button type="submit" name="allocatedopen">iteration-1 Round-1 (related to First-Preference)</button>
        <button type="submit" name="Round1_i2">iteration-2 Round-1 (related to Second-Preference)</button>
    </form>
</body>

</html>