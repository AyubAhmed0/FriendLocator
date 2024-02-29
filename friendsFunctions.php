<?php
require_once ('Models/UsersDataSet.php');
$UsersDataSet = new UsersDataSet();
$view = new stdClass();
if (isset($_POST["RequestButon"])) {
    switch($_POST["RequestButon"])
    {
        case "Accept request":
        {
            $UsersDataSet->acceptFriendship($_POST["friendRequestID"]);
            header('Location: friends.php'); //takes the user to friends page
        } break;
        case "Request Friend":
            {
                $result = $UsersDataSet->requestFriendship($_POST["requestingfriend"],$_POST["requestedfriend"]);
                $name = $_POST["friendRequestName"];
                if($result == 1) //successfully sent requet
                 {
                   header('Location: friends.php'); //takes the user to friends page
                 }
                 else { //failed to request
                    header('Location: index.php'); //takes the user to Home page
                 }

            } break;
         case "Cancel request":
            {
                 $UsersDataSet->cancelFriendship($_POST["friendRequestID"]);
                 header('Location: friends.php'); //takes the user to friends page
                    
                } break; 
        case "Remove Friend":
                    {
                         $UsersDataSet->removeFriendship($_POST["friendRequestID"]);
                         header('Location: friends.php'); //takes the user to friends page
                            
                        } break;
    }
}