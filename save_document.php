<?php
header('Content-Type: application/json; charset=UTF-8');
include('connect_db.php');

// insert head document
$insert_sql = "INSERT INTO tb_date_form (head_year, head_number, head_date, head_date_month , head_date_year , head_name , head_branch , head_faculty)
 VALUES (?, ?, ?, ?, ? , ?, ?, ?)";
$stmt = $mysqli->prepare($insert_sql);

$stmt->bind_param("ssssssss", $_POST['head_year'], $_POST['head_number'], $_POST['head_date'],$_POST['head_date_month']
,$_POST['head_date_year'],$_POST['head_name'],$_POST['head_branch'],$_POST['head_faculty']);

if ($stmt->execute()) {
    // for insert optional
    $lastInsertedId = $mysqli->insert_id;
    for($i = 0; $i < count($_POST['list']); $i++){
        $insert_options = "INSERT INTO tb_optional (option_name, option_quantity , option_head_id) VALUES (?, ? , ?)";
        $stmtoption = $mysqli->prepare($insert_options);
        $stmtoption->bind_param("sii", $_POST['list'][$i], $_POST['count'][$i], $lastInsertedId);
        $stmtoption->execute();
    }
        
        // for additional year
        $yearName = $_POST['head_year'];
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
                    // update year table
                    $row = $result->fetch_assoc();
                    $currentYearCount = $row['year_count'];

                    $newYearCount = $currentYearCount + 1;

                    $updateQuery = "UPDATE tb_cyear SET year_count = ? WHERE year_name = ?";
                    $updateStmt = $mysqli->prepare($updateQuery);

                    if ($updateStmt) {
                        $updateStmt->bind_param("is", $newYearCount, $yearName);

                        if ($updateStmt->execute()) {
                            $response = array(
                                "year_name" => $yearName,
                                "year_count" => $newYearCount
                            );
                            echo json_encode($response);
                        } else {
                            echo "Error updating year_count: " . $updateStmt->error;
                        }

                        $updateStmt->close();
                    } else {
                        echo "Error in preparing UPDATE statement: " . $mysqli->error;
                    }
                } else {
                    // insert year table
                    $yearCount = 1;
                    $insertQuery = "INSERT INTO tb_cyear (year_name, year_count) VALUES (?, ?)";
                    $insertStmt = $mysqli->prepare($insertQuery);

                    if ($insertStmt) {
                        $insertStmt->bind_param("si", $yearName, $yearCount);

                        if ($insertStmt->execute()) {
                            $response = array(
                                "year_name" => $yearName,
                                "year_count" => 1
                            );
                            echo json_encode($response);
                        } else {
                            echo "Error inserting data: " . $insertStmt->error;
                        }

                        $insertStmt->close();
                    } else {
                        echo "Error in preparing INSERT statement: " . $mysqli->error;
                    }
                }
            } else {
                echo "Error in executing SELECT query: " . $mysqli->error;
            }

        }
} else {
    echo "Error inserting : " . $stmt->error . "<br>";
}

$stmt->close();
$mysqli->close();




?>
