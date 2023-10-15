<?php
header('Content-Type: application/json; charset=UTF-8');
include('connect_db.php');
// print_R($_POST); exit;
    $sql = "UPDATE tb_date_form SET head_status = ? WHERE head_id = ?";
    $smtp = $mysqli->prepare($sql);
    $smtp->bind_param("si", $_POST['status'], $_POST['id']);
    if($smtp->execute()){
    for($i = 0; $i < count($_POST['list']); $i++){
        $insert_options = "UPDATE tb_optional SET option_get_quantity = ?, option_remark = ? WHERE option_id = ?";
        $stmtoption = $mysqli->prepare($insert_options);
        $stmtoption->bind_param("iss", $_POST['count_provide'][$i], $_POST['remark'][$i], $_POST['option_id'][$i]);
        $stmtoption->execute();
    }
}
$mysqli->close();




?>
