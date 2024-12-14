<?php
include 'connection.php';
include 'insert.php';
include 'select.php';
include 'delete.php';
include 'update.php';

$host = 'host.docker.internal'; //Note here I used host.docker.internal becuase i'm using docker image to run php
//thats why I can't use localhost due to the database being in a diffrent container
//to fix this issue I can use docker compose to make them run in the same envierment
//However as long as this is working I don't want to touch it 😂
$port = 3306;
$dbname = 'bookmarking_db';
$username = 'root'; 
$password = 'pass'; 
$conn = db_connection($host, $port, $dbname, $username, $password);
$GLOBALS["conn"] = $conn;


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, GET, PUT, DELETE','OPTIONS'); //here I allowed only 5 methods to connet to my index.php
header('Access-Control-Allow-Headers: Content-Type, Authorization');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { //I added this code when I faced problems in requresting delete from react app
    //the broswer will send OPTIONS requrest before sending DELETE requrest therefore I need to handle OPTIONS request 
    http_response_code(200);
    exit;
}

$method = $_SERVER['REQUEST_METHOD']; //check the method used
$data = json_decode(file_get_contents("php://input"), true); //decode to json and store it in data

if ($method === 'POST') {//my post handling is a little bit diffrent then other methods
    //because I have 2 methods in it one that will insert new input and other will search by name
    //in my opinon its better to handle the second one in the client or cache it here but I thought I need to do it in the database requrest for the final lab
    if(isset($data["title"])&& isset($data["link"])){
        insert($data["title"], $data["link"]);
    }
    else if(isset($data["bookmarkName"])){
        $bookmark = select_one($data["bookmarkName"]);
        echo json_encode($bookmark);
        }


} else if ($method === 'GET') { 
        $bookmarks = select_all();
        echo json_encode($bookmarks);


} else if ($method === 'PUT') {
    if (isset($data["link"])&&isset($data["id"])) {
        update($data["link"],$data["id"]);
    }


} else if ($method === 'DELETE') {
    if (isset($data["id"])) {
        delete($data["id"]);
    }


} else {
    http_response_code(405);
    echo json_encode("error: Method not allowed please use post-get-put-delete methods");
}

?>
