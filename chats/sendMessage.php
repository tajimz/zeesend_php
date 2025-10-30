<?php


require_once("../con.php");

require_once("../base.php");


$inputData = getDataFromJsonObj();

if ($inputData == null) return;
$message = mysqli_real_escape_string($conn, $inputData["message"]);
$senderId = $inputData["sender_id"];
$roomId = $inputData["room_id"];

$tableName = "messageTable";

$sql = "INSERT INTO {$tableName} (room_id, sender_id, message) 
    VALUES ('$roomId', '$senderId', '$message')";
$runSql = mysqli_query($conn, $sql);
if ($runSql){
    echo json_encode(array("status" => "done", "message_id" => mysqli_insert_id($conn)));
    $sql2 = "UPDATE chatRoom SET last_message = '$message' ,last_updated = CURRENT_TIMESTAMP WHERE room_id = '$roomId'";
    $runSql2 = mysqli_query($conn, $sql2);
} else {
    echo json_encode(array("status" => "Error Occurred", "error" => mysqli_error($conn)));
}



?>