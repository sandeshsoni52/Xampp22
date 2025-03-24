<?php
include 'db_connect.php';
include 'functionsc.php';

// call SC function
if (isset($_POST['sc'])) {
    createAllocatedSCTable($conn);
}
// call NTC function
if (isset($_POST['ntc'])) {
    createAllocatedNTCTable($conn);
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
        <!-- <button type="submit" name="st1">new table of ST allocated incomplete</button>
        <button type="submit" name="st2">1347Final ST allocated</button>
        <button type="submit" name="obc1">new table of obc allocated</button> -->
        <button type="submit" name="ntc">new table of NT-c allocated </button>
        <button type="submit" name="sc">1435new table of SC allocated </button>
    </form>



</body>

</html>