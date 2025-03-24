<?php
// functionsc.php

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
        echo "1459New NTC allocated table created successfully!";
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
