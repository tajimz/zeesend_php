<?php
require_once("../con.php");
require_once("../base.php");


$inputData = getDataFromJsonArray();
if ($inputData == null) return;
$searchTerm = $inputData["searchTerm"];
$username = $inputData["username"];
$tableName = "userinfo";
searchData($searchTerm, $username, $conn, $tableName);





function searchData($searchTerm, $username, $conn, $tableName){
    $sql = "SELECT * FROM {$tableName} 
        WHERE (username LIKE '$searchTerm%' OR name LIKE '$searchTerm%') 
        AND username != '$username'";

    $runSql = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($runSql);

    
    $resultArray = array();
    while ($data = mysqli_fetch_assoc($runSql)){
        array_push($resultArray, $data);
    }
    echo json_encode($resultArray);
    

}


?>