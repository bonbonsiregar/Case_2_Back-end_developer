<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once('db.php');
include_once('config.php');
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 

$product = new Product($db);
 
// set ID property of record to read
$product->id = isset($_GET['id']) ? $_GET['id'] : die();
 

$product->readOne();
 
if($product->nama!=null){
    // create array
    $product_arr = array(
        "id" =>  $product->id,
        "nama" => $product->nama,
        "email" => $product->email,
        "no_hp" => $product->no_hp,
        "pekerjaan" => $product->pekerjaan
 
    );
 
    // set response code - 200 OK
    http_response_code(200);
 
    // make it json format
    echo json_encode($product_arr);
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Product does not exist."));
}
?>