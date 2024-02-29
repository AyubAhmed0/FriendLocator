<?php
require_once ('Models/Database.php');
$_dbInstance = Database::getInstance();
$_dbHandle = $_dbInstance->getdbConnection();

if (isset($_POST["signupbutton"])) {
    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashedPass = password_hash($password, PASSWORD_DEFAULT);

    // File upload path
    $dir = "images/"; //directory where the image is going to be stored
    $fileName = basename($_FILES["image"]["name"]); //the name of the file
    $imagePath = $dir . $fileName; //the path of the image 

    $myQuery = "select * from Users where username = ? OR email = ?";
    $statement = $_dbHandle->prepare($myQuery);
    $statement->execute(array($username, $email)); // execute the PDO statement;
    $row = $statement->fetch();
    if (!$row) { //if there is no row returned/username and email doesn't exist the DB
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath))
        {
            $myQuery2 = "INSERT INTO Users(full_name,username,img,email,password, lat, lng) 
            VALUES (?,?,?,?,?,'49.7154835', '136.6033466')";
            $fileName = "images/".$fileName;
            $statement = $_dbHandle->prepare($myQuery2); // prepare a PDO statement
            $statement->execute(array($fullname, $username, $fileName, $email, $hashedPass)); // execute the PDO statement;
            header('Location: index.php'); //takes the user to index page
        } 
        else {
            echo "There was an error uploading you image. Please try again";
        }
    }
    else 
    {
        echo "Username or email already exists. Please Entere diffrent ones";
    }
} 



