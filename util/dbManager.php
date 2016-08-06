<?php
/**
 * Created by PhpStorm.
 * User: mohsen
 * Date: 6/6/2016
 * Time: 10:47 AM
 */

include_once 'logger.php';

function openConnection()
{
    $server_name = "localhost";
    $username = "root";
    $password = "123456";
    $db_name = "tabiat";

// Create connection
    $conn = new mysqli($server_name, $username, $password, $db_name);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function closeConnection($conn)
{
    $conn->close();
}

function runQuery($sql)
{
    logTabiat($sql);
    $conn = openConnection();

    try {
        if (mysqli_query($conn, $sql)) {
            logTabiat("Successful!");
        } else {
            logTabiat("Error: " . mysqli_error($conn));
        }
    } finally {
        closeConnection($conn);
    }

}

function runSelect($sql)
{
    logTabiat($sql);
    $conn = openConnection();

    try {
        $result = $conn->query($sql);

        $objs = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $objs[] = $row;
            }
        }

        logTabiat("SUCCESS");

        return $objs;
    } catch (Exception $e) {
        logTabiat("Exception=> " . $e->getMessage());
    } finally {
        closeConnection($conn);
    }
}

function runSelectJson($sql)
{
    logTabiat($sql);
    $conn = openConnection();

    try {
        $result = $conn->query($sql);

        $rows = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }

        logTabiat("SUCCESS");

        return json_encode($rows);
    } catch (Exception $e) {
        logTabiat("Exception=> " . $e->getMessage());
    } finally {
        closeConnection($conn);
    }
}

function runCount($sql)
{
    logTabiat($sql);

    $conn = openConnection();

    try {
        $result = $conn->query($sql);

        $rowcount = mysqli_num_rows($result);

        return $rowcount;
    } catch (Exception $e) {
        logTabiat("Exception=> " . $e->getMessage());
    } finally {
        closeConnection($conn);
    }
}

function runSingleSelect($sql)
{
    logTabiat($sql);

    $conn = openConnection();

    try {
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_object();
        }
    } catch (Exception $e) {
        logTabiat("Exception=> " . $e->getMessage());
    } finally {
        closeConnection($conn);
    }
}


function initDbBySQLFile($fileName)
{
    // Temporary variable, used to store current query
    $templine = '';
    // Read in entire file
    $lines = file($fileName);
    // Loop through each line
    foreach ($lines as $line) {
        // Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;

        // Add this line to the current segment
        $templine .= $line;
        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';') {
            // Perform the query
            runQuery($templine);
            // Reset temp variable to empty
            $templine = '';
        }
    }
}

?>

