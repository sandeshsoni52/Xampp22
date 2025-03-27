<?php

//allocated_open_category_seats
function allocatedOpenTable($conn)
{
    //query 1
    global $ect;
    $result = $conn->query("SELECT $ect FROM calculation WHERE category='open'");
    $row = $result->fetch_assoc();
    $open_value = isset($row[$ect]) ? (int)$row[$ect] : 0;
    $sqlone = "CREATE TABLE allocatedopen AS SELECT * FROM meritlist LIMIT $open_value;";
    if ($conn->query($sqlone) === TRUE) {
        echo "open category , allocation";
    } else {
        echo "Error: " . $conn->error;
    }
    //query 2
    $sqlone = "CREATE TABLE unallocatedcommon AS 
                SELECT * FROM meritlist;";

    if ($conn->query($sqlone) === TRUE) {
        echo "q2";
    } else {
        echo "Error: " . $conn->error;
    }
    //query 3
    $sqlone = "DELETE FROM unallocatedcommon 
        WHERE srno IN (SELECT srno FROM allocatedopen); ";

    if ($conn->query($sqlone) === TRUE) {
        echo "q3";
    } else {
        echo "Error: " . $conn->error;
    }

    //query 1/3 SC
    $sqlone = "CREATE TABLE allocatedSC 
        AS SELECT * FROM unallocatedcommon";

    if ($conn->query($sqlone) === TRUE) {
        echo "separate1448New SC allocated table created successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    // query 2/3 SC
    $sqltwo = "DELETE FROM allocatedSC
                WHERE category <> 'SC'";

    if ($conn->query($sqltwo) === TRUE) {
        echo " all SC table , successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    // query 3/3 SC
    global $ect;
    $result = $conn->query("SELECT $ect FROM calculation WHERE category='sc'");
    $row = $result->fetch_assoc();
    $sc_value = isset($row[$ect]) ? (int)$row[$ect] : 0;
    // SQL query to delete all rows except the top 1
    $sqlthree = "DELETE FROM allocatedSC WHERE srno NOT IN (SELECT srno FROM (SELECT srno FROM allocatedSC ORDER BY srno LIMIT $sc_value) AS temp )";
    //error handling
    if ($conn->query($sqlthree) === TRUE) {
        echo "Records deleted successfully and proper SC_allocated!";
    } else {
        echo "Error: " . $conn->error;
    }

    // query1/3 ST
    $sqlone = "CREATE TABLE allocatedST AS SELECT * FROM unallocatedcommon";
    if ($conn->query($sqlone) === TRUE) {
        echo "1504New ST allocated table created successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    // query 2/3
    $sqltwo = "DELETE FROM allocatedST WHERE category <> 'ST'";
    if ($conn->query($sqltwo) === TRUE) {
        echo " New ST allocated table created successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    // query 3/3 ST
    global $ect;
    $result = $conn->query("SELECT $ect FROM calculation WHERE category='st'");
    $row = $result->fetch_assoc();
    $st_value = isset($row[$ect]) ? (int)$row[$ect] : 0;
    $sql = "DELETE FROM allocatedST WHERE srno NOT IN (SELECT srno FROM (SELECT srno FROM allocatedST ORDER BY srno LIMIT $st_value) AS temp)";
    if ($conn->query($sql) === TRUE) {
        echo "Records deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    // query1/3 NTC
    $sql = "CREATE TABLE allocatedNTC AS SELECT * FROM unallocatedcommon";
    if ($conn->query($sql) === TRUE) {
        echo "1513New NTC allocated table created successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    // query 2/3
    $sql = "DELETE FROM allocatedNTC WHERE category <> 'NTC'";
    if ($conn->query($sql) === TRUE) {
        echo " all NTC table , successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    // query 3/3
    global $ect;
    $result = $conn->query("SELECT $ect FROM calculation WHERE category='ntc'");
    $row = $result->fetch_assoc();
    $ntc_value = isset($row[$ect]) ? (int)$row[$ect] : 0; // Ensure it's an integer
    // SQL query to delete all rows except the top 1
    $sql = "DELETE FROM allocatedNTC WHERE srno NOT IN (SELECT srno FROM (SELECT srno FROM allocatedNTC ORDER BY srno LIMIT $ntc_value) AS temp)";
    if ($conn->query($sql) === TRUE) {
        echo "1643Records deleted successfully and proper NT C_allocated!";
    } else {
        echo "Error: " . $conn->error;
    }

    // query1/3 OBC
    $sqlone = "CREATE TABLE allocatedOBC AS SELECT * FROM unallocatedcommon";
    if ($conn->query($sqlone) === TRUE) {
        echo "1521New obc allocated table created successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    // query 2/3
    $sqltwo = "DELETE FROM allocatedOBC WHERE category <> 'OBC'";
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
    $sqlthree = "DELETE FROM allocatedOBC WHERE srno NOT IN (SELECT srno FROM (SELECT srno FROM allocatedOBC ORDER BY srno LIMIT $obc_value) AS temp)";
    if ($conn->query($sqlthree) === TRUE) {
        echo "Records deleted successfully and proper OBC_allocated!";
    } else {
        echo "Error: " . $conn->error;
    }
}
