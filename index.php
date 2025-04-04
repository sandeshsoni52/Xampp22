<?php
include 'db_connect.php';
include 'functionsc.php';

$ect = 'sixty';
$cse = 'twoforty';
$mech = 'sixty';

// call all_allocation_process function r1i1
if (isset($_POST['Round1_i1'])) {
    allocated_Ect_R1i1($conn);
    allocated_cse_r1i1($conn);
}

// call all_allocation_process function r1i2
if (isset($_POST['Round1_i2'])) {
    r1i2_prepare($conn);
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
        <button type="submit" name="Round1_i1">iteration-1 of Round-1 (related to First-Preference)</button>
        <button type="submit" name="Round1_i2">iteration-2 of Round-1 (related to Second-Preference)</button>
    </form>
</body>

</html>