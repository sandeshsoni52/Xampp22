<?php

//allocated round 1 i1 (dept => ect)
function allocatedOpenTable($conn)
{
    //open_category allocated table creating
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

//round 1 i2
function r1i2($conn)
{
    // CREATE TABLE allocated_r1i1 AS
    // SELECT Srno, rollno, cname, category FROM allocatedntc
    // UNION ALL
    // SELECT Srno, rollno, cname, category FROM allocatedst
    // UNION ALL
    // SELECT Srno, rollno, cname, category FROM allocatedsc
    // UNION ALL
    // SELECT Srno, rollno, cname, category FROM allocatedopen
    // UNION ALL
    // SELECT Srno, rollno, cname, category FROM allocatedobc;
    

    // CREATE TABLE unallocated_r1i1 AS
    // SELECT * FROM meritlist;

    // DELETE FROM unallocated_r1i1
    // WHERE srno IN (SELECT srno FROM allocated_r1i1);

    //OKK 1331

    // now change dept to mechanical for second preference


    // how to change SEAT_COUNT 

    // whole again (but use new list of unallocated_r1i1
    //             and seat count will change according to DEPT)
    // open category allocated
    // all unallocated 
    // sc
    // st
    // ntc 
    // obc 


}

//cseallocated round 1 i1 (det => CSE)
function allocated_cse_r1i1($conn)
{
    //open_category cseallocated table creating
    //query 1
    global $cse;
    $result = $conn->query("SELECT $cse FROM calculation WHERE category='open'");
    $row = $result->fetch_assoc();
    $open_value = isset($row[$cse]) ? (int)$row[$cse] : 0;
    $sqlone = "CREATE TABLE cseallocatedopen AS SELECT * FROM meritlist LIMIT $open_value;";
    if ($conn->query($sqlone) === TRUE) {
        echo "open category , allocation";
    } else {
        echo "Error: " . $conn->error;
    }
    //query 2
    $sqlone = "CREATE TABLE uncseallocatedcommon AS 
                SELECT * FROM meritlist;";

    if ($conn->query($sqlone) === TRUE) {
        echo "q2";
    } else {
        echo "Error: " . $conn->error;
    }
    //query 3
    $sqlone = "DELETE FROM uncseallocatedcommon 
        WHERE srno IN (SELECT srno FROM cseallocatedopen); ";

    if ($conn->query($sqlone) === TRUE) {
        echo "q3";
    } else {
        echo "Error: " . $conn->error;
    }

    //query 1/3 SC
    $sqlone = "CREATE TABLE cseallocatedSC 
        AS SELECT * FROM uncseallocatedcommon";

    if ($conn->query($sqlone) === TRUE) {
        echo "separate1448New SC cseallocated table created successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    // query 2/3 SC
    $sqltwo = "DELETE FROM cseallocatedSC
                WHERE category <> 'SC'";

    if ($conn->query($sqltwo) === TRUE) {
        echo " all SC table , successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    // query 3/3 SC
    global $cse;
    $result = $conn->query("SELECT $cse FROM calculation WHERE category='sc'");
    $row = $result->fetch_assoc();
    $sc_value = isset($row[$cse]) ? (int)$row[$cse] : 0;
    // SQL query to delete all rows except the top 1
    $sqlthree = "DELETE FROM cseallocatedSC WHERE srno NOT IN (SELECT srno FROM (SELECT srno FROM cseallocatedSC ORDER BY srno LIMIT $sc_value) AS temp )";
    //error handling
    if ($conn->query($sqlthree) === TRUE) {
        echo "Records deleted successfully and proper SC_cseallocated!";
    } else {
        echo "Error: " . $conn->error;
    }

    // query1/3 ST
    $sqlone = "CREATE TABLE cseallocatedST AS SELECT * FROM uncseallocatedcommon";
    if ($conn->query($sqlone) === TRUE) {
        echo "1504New ST cseallocated table created successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    // query 2/3
    $sqltwo = "DELETE FROM cseallocatedST WHERE category <> 'ST'";
    if ($conn->query($sqltwo) === TRUE) {
        echo " New ST cseallocated table created successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    // query 3/3 ST
    global $cse;
    $result = $conn->query("SELECT $cse FROM calculation WHERE category='st'");
    $row = $result->fetch_assoc();
    $st_value = isset($row[$cse]) ? (int)$row[$cse] : 0;
    $sql = "DELETE FROM cseallocatedST WHERE srno NOT IN (SELECT srno FROM (SELECT srno FROM cseallocatedST ORDER BY srno LIMIT $st_value) AS temp)";
    if ($conn->query($sql) === TRUE) {
        echo "Records deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    // query1/3 NTC
    $sql = "CREATE TABLE cseallocatedNTC AS SELECT * FROM uncseallocatedcommon";
    if ($conn->query($sql) === TRUE) {
        echo "1513New NTC cseallocated table created successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    // query 2/3
    $sql = "DELETE FROM cseallocatedNTC WHERE category <> 'NTC'";
    if ($conn->query($sql) === TRUE) {
        echo " all NTC table , successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    // query 3/3
    global $cse;
    $result = $conn->query("SELECT $cse FROM calculation WHERE category='ntc'");
    $row = $result->fetch_assoc();
    $ntc_value = isset($row[$cse]) ? (int)$row[$cse] : 0; // Ensure it's an integer
    // SQL query to delete all rows except the top 1
    $sql = "DELETE FROM cseallocatedNTC WHERE srno NOT IN (SELECT srno FROM (SELECT srno FROM cseallocatedNTC ORDER BY srno LIMIT $ntc_value) AS temp)";
    if ($conn->query($sql) === TRUE) {
        echo "1643Records deleted successfully and proper NT C_cseallocated!";
    } else {
        echo "Error: " . $conn->error;
    }

    // query1/3 OBC
    $sqlone = "CREATE TABLE cseallocatedOBC AS SELECT * FROM uncseallocatedcommon";
    if ($conn->query($sqlone) === TRUE) {
        echo "1521New obc cseallocated table created successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    // query 2/3
    $sqltwo = "DELETE FROM cseallocatedOBC WHERE category <> 'OBC'";
    if ($conn->query($sqltwo) === TRUE) {
        echo " all OBC table , successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
    // query 3/3
    global $cse;
    $result = $conn->query("SELECT $cse FROM calculation WHERE category='obc'");
    $row = $result->fetch_assoc();
    $obc_value = isset($row[$cse]) ? (int)$row[$cse] : 0;
    // SQL query to delete all rows except the top 4
    $sqlthree = "DELETE FROM cseallocatedOBC WHERE srno NOT IN (SELECT srno FROM (SELECT srno FROM cseallocatedOBC ORDER BY srno LIMIT $obc_value) AS temp)";
    if ($conn->query($sqlthree) === TRUE) {
        echo "Records deleted successfully and proper OBC_cseallocated!";
    } else {
        echo "Error: " . $conn->error;
    }
}
