<?php
header('Content-Type: application/json; charset=UTF-8');
include('connect_db.php');

$yearName = $_GET['date'];

$query = "SELECT * FROM tb_cyear WHERE year_name = ?";
$stmt = $mysqli->prepare($query);

if (!$stmt) {
    echo "Error in preparing SQL statement: " . $mysqli->error;
} else {
    $stmt->bind_param("s", $yearName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentYearCount = $row['year_count'];
            $response = array(
               "year_name" => $yearName,
                "year_count" => $currentYearCount+1
             );
                echo json_encode($response);
            }else{
                $response = array(
                    "year_name" => $yearName,
                    "year_count" => 1
                );
                echo json_encode($response);
            }

        } else {
                $response = array(
                        "year_name" => $yearName,
                        "year_count" => 1
                );
                echo json_encode($response);

        }

    $stmt->close();
    $mysqli->close();
}
?>
