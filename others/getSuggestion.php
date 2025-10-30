<?php
error_reporting(E_ALL);

require_once("../con.php");
require_once("../base.php");
$inputData = getDataFromJsonArray();
if ($inputData == null) return;

$userId = $inputData["id"];
$usersTable = "userinfo";

$sql = "SELECT * FROM {$usersTable} WHERE id != '$userId' ORDER BY RAND() LIMIT 20";


$result = $conn->query($sql);


$resultArray = array();

    while ($data = mysqli_fetch_assoc($result)){
        array_push($resultArray, $data);
    }
    echo json_encode($resultArray);








?>