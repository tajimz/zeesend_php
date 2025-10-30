<?php

require_once("../con.php");
require_once("../base.php");

$inputData = getDataFromJsonObj();
if ($inputData == null) return;
$id1 = $inputData["user1"];
$id2 = $inputData["user2"];

$roomTable = "chatRoom";

$roomId = checkRoom($id1, $id2, $conn, $roomTable);
echo json_encode(array("room_id" => $roomId));








function checkRoom($id1, $id2, $conn, $roomTable){
    $sql = "SELECT * FROM {$roomTable} 
        WHERE (user1_id = '$id1' AND user2_id = '$id2') 
        OR (user1_id = '$id2' AND user2_id = '$id1')";

    $runSql = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($runSql);

    if ($rows > 0){
        $data = mysqli_fetch_assoc($runSql);
        return $data["room_id"];
    } else {
        $create = "INSERT INTO {$roomTable} (user1_id, user2_id) VALUES ('$id1', '$id2')";
        mysqli_query($conn, $create);
        return mysqli_insert_id($conn);
    }
}


?>