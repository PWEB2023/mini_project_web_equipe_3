<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
if($_POST){

// include database connection
include 'config/database.php';

try{
    header("content-type: application/json ; charset=utf-8");
// insert query
$query = "INSERT INTO application SET app_name=:name, app_desc=:desc, app_image=:image, app_download=:download";
// prepare query for execution
$stmt = $con->prepare($query);
// posted values
$name = $_POST['name'];
$app_desc = $_POST['desc'];
$app_image = file_get_contents($_FILES["image"]["tmp_name"]);
$app_download = $_POST['download'];
// bind the parameters
$stmt->bindParam(':name', $name);
$stmt->bindParam(':desc', $app_desc);
$stmt->bindParam(':image', $app_image);
$stmt->bindParam(':download', $app_download);
// Execute the query
if($stmt->execute()){
    echo json_encode(array('result'=>'succees'));
}else{
    echo json_encode(array('result'=>'fail'));
}
}
// show error
catch(PDOException $exception){
die('ERROR: ' . $exception->getMessage());
}
}
?>
