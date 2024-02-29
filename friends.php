<?php

require_once('Models/UsersDataSet.php');
$view = new stdClass();
$view->pageTitle = 'Friends';
require_once("login.php");
$UsersDataSet = new UsersDataSet();
$view->UsersDataSet = $UsersDataSet->fetchAllUsersFriends($_SESSION["id"]);
$currentUser = $UsersDataSet->fetchCurrentUser($_SESSION["id"]);
//var_dump($testV['lat']);
require_once('Views/friends.phtml'); 
