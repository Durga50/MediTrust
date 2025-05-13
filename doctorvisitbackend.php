<?php
include("dbconn.php"); // Ensure database connection is included

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $query = "SELECT * FROM visitfeedback ORDER BY id DESC";
    $result = $conn->query($query);

    $tableData = "";
    $sno = 1;
    $count = $result->num_rows;

    if ($count > 0) {
        while ($row = $result->fetch_assoc()) {
            $tableData .= "<tr>
                            <td>{$sno}</td>
                            <td>{$row['date']}</td>
                            <td>{$row['time']}</td>
                            <td>{$row['feedback']}</td>
                        </tr>";
            $sno++;
        }
    } else {
        $tableData = "<tr><td colspan='11' style='text-align: center;'>No patients available</td></tr>";
    }

    header('Content-Type: application/json');
    echo json_encode(["tableData" => $tableData, "count" => $count]);
    exit();
}


$conn->close();
?>