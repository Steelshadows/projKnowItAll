<?php
function singleQuery($query, $arr, $param, $conn)
{
    $stmt = $conn->prepare($query);
    $stmt->bind_param($param, ... $arr);
    $stmt->execute();
    $stmt->close();
}

function resultQuery($query, $arr, $param, $conn)
{
    if (isset($arr) && isset($param)) {
        $stmt = $conn->prepare($query);
        $stmt->bind_param($param, ... $arr);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $stmt = $conn->query($query);
        $result = $stmt;
    }
    if ($result->num_rows == 0) {
        session_destroy();
    }
    $row = [];

    while ($rows = $result->fetch_assoc()) {
        array_push($row, $rows);
    }
    $stmt->close();
    return $row;
}
