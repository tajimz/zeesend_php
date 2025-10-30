<?php
require_once("../con.php");
require_once("../base.php");


$inputData = getDataFromJsonArray();
if ($inputData == null) return;

$userId = $inputData["id"];
$tableName = "chatRoom";
$userTableName = "userinfo";

getChatLists($userId, $conn, $tableName, $userTableName);



function getChatLists($userId, $conn, $tableName, $userTableName){
    $sql = "SELECT * FROM {$tableName} WHERE user1_id = '$userId' OR user2_id = '$userId' ORDER BY last_updated DESC";
    $runSql = mysqli_query($conn, $sql);

    $resultArray = [];

    while ($row = mysqli_fetch_assoc($runSql)){
        $otherUserId = ($row["user1_id"] == $userId) ? $row["user2_id"] : $row["user1_id"];

        $sql2 = "SELECT * FROM {$userTableName} WHERE id = '$otherUserId'";
        $runSql2 = mysqli_query($conn, $sql2);

        if ($data = mysqli_fetch_assoc($runSql2)){
        
        $chatInfo = [
        "last_message" => $row["last_message"]
        ];

        
        $resultArray[] = array_merge($data, $chatInfo);
        }
    }

    echo json_encode($resultArray);
}
?>
