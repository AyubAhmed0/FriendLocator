<?php
require_once('Models/UsersDataSet.php');

session_start();
$token="";
if(isset($_SESSION["ajaxToken"])){
    $token = $_SESSION["ajaxToken"];
}


if(!isset($_GET["token"]) || $_GET["token"] != $token){
    $data = new stdClass();
    $data->error = "No Data";
    echo json_encode($data);
}
else{
    $UsersDataSet = new UsersDataSet();
    $UsersDataSet = $UsersDataSet->fetchAUser($_GET["q"]);
    echo json_encode($UsersDataSet);
}