<?php
require_once("../con.php");
require_once("../base.php");

$input = getDataFromJsonObj();
if ($input == null) return;

$reason = $input["reason"];
$text = $input["text"];
$tableName = "userinfo";
$id = $input["id"];

editThings($reason, $text, $conn, $tableName, $id);






function editThings($reason, $text, $conn, $tableName, $id){

    if ($reason == "name") {
        $sql = "UPDATE $tableName SET name='$text' WHERE id='$id'";
    } else if ($reason == "bio"){
        $sql = "UPDATE $tableName SET bio='$text' WHERE id='$id'";
    } else if ($reason == "fcm"){
        $sql = "UPDATE $tableName SET fcm='$text' WHERE id='$id'";
    } else if ($reason == "username"){
        $sqlCheck = "SELECT * FROM $tableName WHERE username='$text'";
        $resultCheck = mysqli_query($conn, $sqlCheck);
        if (mysqli_num_rows($resultCheck) > 0) {
            echo json_encode(array("status" => "Username already taken", "message" => "Username already taken"));
            return;
        }
        $sql = "UPDATE $tableName SET username='$text' WHERE id='$id'";
    } else {
        return;
    }

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("status" => "done"));
    } else {
        echo json_encode(array("status" => "error", "message" => mysqli_error($conn)));
    }

}





?>