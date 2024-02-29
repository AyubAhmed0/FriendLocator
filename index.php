<?php
require_once('Models/UsersDataSet.php');
$view = new stdClass();
$view->pageTitle = 'Home';
require_once("login.php");
$UsersDataSet = new UsersDataSet();
$UsersDataSet2 = new UsersDataSet();
$view->UsersDataSet = $UsersDataSet->fetchAllUsers();
require_once('Views/index.phtml');
