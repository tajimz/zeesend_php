<?php
header('Content-Type: application/json');
require_once("../con.php");
require_once("../base.php");


$inputData = getDataFromJsonObj();

if ($inputData == null) return;

$email = $inputData["email"];
$via = $inputData["via"];
$password = $inputData["password"];


$tableName = "userinfo";



if ($via == "google"){
    checkAccountExists($email, $conn, $tableName);
}else if ($via == "email"){
    checkAccountData($email, $conn, $tableName, $password);

    

}




function checkAccountExists($email, $conn, $tableName){

    $sql = "SELECT * FROM {$tableName} WHERE email = '$email'";
    $runSql = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($runSql);
    if ($rows > 0){
        echo json_encode(mysqli_fetch_assoc($runSql));
    }else {
        echo json_encode(array("status" => "Account Not Found"));

    }
    
}

function checkAccountData($email, $conn, $tableName, $password){
    $sql = "SELECT * FROM {$tableName} WHERE email = '$email' AND password = '$password'";
    $runSql = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($runSql);
    if ($rows > 0){
        echo json_encode(mysqli_fetch_assoc($runSql));
    }else {
        echo json_encode(array("status" => "Invalid Email or Password"));

    }
}



?>