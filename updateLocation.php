<?php
session_start();
require_once('Models/UsersDataSet.php');
$UsersDataSet = new UsersDataSet();
$view = new stdClass();
$lat = doubleVal($_REQUEST["lat"]); //convert lat to double
$lng = doubleVal($_REQUEST["lng"]); //convert lng to double
$user = intval($_SESSION["id"]); //convert user id to double
$UsersDataSet->updateUserLocation($user,$lat, $lng); //update database