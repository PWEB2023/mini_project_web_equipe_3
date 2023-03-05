<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
 
// check if form was submitted
if($_POST){
    include 'config/database.php';
    try{
        // write update query
        // in this case, it seemed like we have so many fields to pass and 
        // it is better to label them and not use question marks
        $query = "UPDATE application 
                    SET app_name=:name, app_desc=:desc, app_image=:image, app_download=:download
                    WHERE app_id = :id";
                    header("content-type: application/json ; charset=utf-8");
 
        // prepare query for excecution
        $stmt = $con->prepare($query);
 
        // posted values
        $app_id = $_POST['id'];
        $app_desc = $_POST['desc'];
        $app_image = $_POST['image'];
        $app_download = $_POST['download'];
        // bind the parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':desc', $app_desc);
        $stmt->bindParam(':image', $app_image);
        $stmt->bindParam(':download', $app_download);
        $stmt->bindParam(':id', $app_id);
         
        // Execute the query
        if($stmt->execute()){
            echo json_encode(array('result'=>'success'));
        }else{
            echo json_encode(array('result'=>'fail'));
        }
         
    }
     
    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
