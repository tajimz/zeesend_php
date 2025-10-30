<?php
require_once("../con.php");
require_once("../base.php");

$inputData = getDataFromJsonArray();
if ($inputData == null) return;

$roomId = $inputData["room_id"];
$lastTime = $inputData["last_updated"];
$onlyNew = $inputData["only_new"];
$tableName = "messageTable";

getMessages($roomId, $conn, $tableName, $lastTime, $onlyNew);






function getMessages($roomId, $conn, $tableName, $lastTime, $onlyNew){
    $sql = "SELECT * FROM {$tableName} WHERE room_id = '$roomId' and message_time > '$lastTime'";
    if ($onlyNew == "0") $sql = "SELECT * FROM {$tableName} WHERE room_id = '$roomId'";
    $runSql = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($runSql);

    
    $resultArray = array();
    while ($data = mysqli_fetch_assoc($runSql)){
        array_push($resultArray, $data);
    }
    echo json_encode($resultArray);
    

}


?>