<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
// include database connection
include 'config/database.php';

// delete message prompt will be here
header("content-type: application/json ; charset=utf-8");
// select all data
$query = "SELECT app_id, app_name, app_desc, app_image FROM application ORDER BY app_id DESC";
$stmt = $con->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// convert binary image data to base64-encoded strings
foreach ($results as &$result) {
    if (isset($result['app_image'])) {
        $result['app_image'] = base64_encode($result['app_image']);
    }
}

$json = json_encode($results);
echo $json;
?>
