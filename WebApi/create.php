<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // include database connection
    include 'config/database.php';

    try{
        header("Content-Type: application/json; charset=UTF-8");

        // insert query
        $query = "INSERT INTO application SET app_name=:name, app_desc=:desc, app_image=:image, app_download=:download";
        // prepare query for execution
        $stmt = $con->prepare($query);

        // posted values
        $name = $_POST['name'];
        $app_desc = $_POST['desc'];
        $app_image = $_POST['image'];
        $app_download = $_POST['download'];

        // bind the parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':desc', $app_desc);
        $stmt->bindParam(':image', $app_image);
        $stmt->bindParam(':download', $app_download);

        // Execute the query
        if($stmt->execute()){
            echo json_encode(array('result'=>'success'));
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