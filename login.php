<?php
require_once ('Models/Database.php');
$_dbInstance = Database::getInstance();
$_dbHandle = $_dbInstance->getdbConnection();
session_start();

//var_dump($_SESSION);

if (isset($_POST["loginbutton"])) { //if the user logs in
    $username = $_POST["username"];
    $password = $_POST["password"];

    $myQuery = "select * from Users where username = ?";
    $statement = $_dbHandle->prepare($myQuery); // prepare a PDO statement
    $statement->execute(array($username)); // execute the PDO statement;
    $row = $statement->fetch();
    if ($row) { //if there is a row returned/there is username matched
        if(password_verify($password, $row['password'])) // if the hashed password from the row returned matches $password
        {
            $_SESSION["login"] = $username; //create a login session
            $_SESSION["id"] = $row['id'];
        }
        else {
            echo "Wrong password. Please try again";
        }
    }
    else if ($username == "" || $password == "") //if the user didnt enter anything
    {
        echo "please enter username and password";
    }
    else
    {
        echo "No username or password found";
    }
}

if (isset($_POST["logoutbutton"])) //if the user logs out
{
    //echo "logout user";
    unset($_SESSION["login"]); // unset the login session
    session_destroy(); // destroy the session
}
