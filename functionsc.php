<?php
$ect = 'sixty';

// Function to handle SC table creation
function createAllocatedSCTable($conn)
{
    //query 1/3
    $sqlone = "CREATE TABLE allocatedSC 
    AS SELECT * FROM unallocatedcommon";

    if ($conn->query($sqlone) === TRUE) {
        echo "separate1448New SC allocated table created successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    // query 2/3
    $sqltwo = "DELETE FROM allocatedSC
            WHERE category <> 'SC'";

    if ($conn->query($sqltwo) === TRUE) {
        echo " all SC table , successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    // query 3/3
    // SQL query to delete all rows except the top 1
    $sqlthree = "DELETE FROM allocatedSC 
                    WHERE srno NOT IN (
                        SELECT srno FROM (
                            SELECT srno FROM allocatedSC
                            ORDER BY srno 
                            LIMIT 1
                        ) AS temp
                    )";
    //error handling
    if ($conn->query($sqlthree) === TRUE) {
        echo "Records deleted successfully and proper SC_allocated!";
    } else {
        echo "Error: " . $conn->error;
    }
}

function createAllocatedNTCTable($conn)
{
    // query1/3
    $sql_cat1 = "CREATE TABLE allocatedNTC AS 
        SELECT * FROM unallocatedcommon";
    if ($conn->query($sql_cat1) === TRUE) {
        echo "1540New NTC allocated table created successfully!";
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
    $ect = 'sixty';
    $result = $conn->query("SELECT $ect FROM calculation1 WHERE category='sc'");
    $row = $result->fetch_assoc();
    $ntc_value = isset($row[$ect]) ? (int)$row[$ect] : 0; // Ensure it's an integer

    // SQL query to delete all rows except the top 1
    $sql = "DELETE FROM allocatedNTC 
                WHERE srno NOT IN (
                    SELECT srno FROM (
                        SELECT srno FROM allocatedNTC
                        ORDER BY srno 
                        LIMIT $ntc_value
                    ) AS temp
                )";
    if ($conn->query($sql) === TRUE) {
        echo "1643Records deleted successfully and proper NT C_allocated!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Handle OBC button
function createAllocatedOBCTable($conn)
{
    // query1/3
    $sqlone = "CREATE TABLE allocatedOBC AS 
        SELECT * FROM unallocatedcommon";
    if ($conn->query($sqlone) === TRUE) {
        echo "1130New obc allocated table created successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    // query 2/3
    $sqltwo = "DELETE FROM allocatedOBC
        WHERE category <> 'OBC'";
    if ($conn->query($sqltwo) === TRUE) {
        echo " all OBC table , successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    // query 3/3
    global $ect;
    $result = $conn->query("SELECT $ect FROM calculation WHERE category='obc'");
    $row = $result->fetch_assoc();
    $obc_value = isset($row[$ect]) ? (int)$row[$ect] : 0;


    // SQL query to delete all rows except the top 4
    $sqlthree = "DELETE FROM allocatedOBC 
                WHERE srno NOT IN (
                    SELECT srno FROM (
                        SELECT srno FROM allocatedOBC
                        ORDER BY srno 
                        LIMIT $obc_value
                    ) AS temp
                )";
    if ($conn->query($sqlthree) === TRUE) {
        echo "Records deleted successfully and proper OBC_allocated!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// // Handle ST two buttons
// if (isset($_POST['st1'])) {
//     // query1/2
//     $sql_cat1 = "CREATE TABLE allocatedST AS 
//         SELECT * FROM unallocatedcommon";

//     if ($conn->query($sql_cat1) === TRUE) {
//         echo "New ST allocated table created successfully!";
//     } else {
//         echo "Error: " . $conn->error;
//     }

//     // query 2/2
//     $sql_fish4 = "DELETE FROM allocatedST
//         WHERE category <> 'ST'";

//     if ($conn->query($sql_fish4) === TRUE) {
//         echo " New ST allocated table created successfully!";
//     } else {
//         echo "Error: " . $conn->error;
//     }
// }

// if (isset($_POST['st2'])) {
//     // SQL query to delete all rows except the top 3
//     $sql = "DELETE FROM allocatedST 
//                 WHERE srno NOT IN (
//                     SELECT srno FROM (
//                         SELECT srno FROM allocatedST
//                         ORDER BY srno 
//                         LIMIT 3
//                     ) AS temp
//                 )";

//     if ($conn->query($sql) === TRUE) {
//         echo "Records deleted successfully!";
//     } else {
//         echo "Error: " . $conn->error;
//     }
// }
