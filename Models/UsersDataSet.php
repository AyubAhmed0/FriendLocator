<?php
require_once ('Models/Database.php');
require_once ('Models/UserData.php');
require_once ('Models/FriendsData.php');
class UsersDataSet
{
    protected $_dbHandle, $_dbInstance;

    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

    public function fetchAllUsers()
    {
        if (isset($_POST["searchbutton"]) && $_POST["searchValue"]) { //if user searches something/not just empty value
            $search = $_POST["searchValue"]; //whatever they searched store it in $search
            if (!isset($_SESSION["login"])) //if login session doesn't exist/if the user is not logged in
                {
                    $sqlQuery = 'SELECT * FROM Users WHERE id Like ? OR username Like ?';
                    //echo $sqlQuery;
                    $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
                    $statement->execute(array($search, $search)); // execute the PDO statement

                    $dataSet = [];
                    while ($row = $statement->fetch()) {
                    $dataSet[] = new UserData($row);
                    }
                }
                else {
                    $sqlQuery = 'SELECT * FROM Users WHERE id Like ? OR username Like ? OR email LIKE ? OR lat Like ? OR lng LIKE ?';
                    //echo $sqlQuery;
                   $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
                   $statement->execute(array($search, $search, $search, $search, $search)); // execute the PDO statement

                $dataSet = [];
                while ($row = $statement->fetch()) {
                $dataSet[] = new UserData($row);
                }
            }
    }
        else {
            $sqlQuery = 'SELECT * FROM Users';
        //echo $sqlQuery;
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement

        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new UserData($row);
        }
        }
        return $dataSet;
    }

    public function fetchAllUsersFriends($id)
    {
         # code...
         $sqlQuery = "SELECT * FROM (
            SELECT * 
            FROM Users
            WHERE Users.id IN (
                SELECT friend1 AS friend
                FROM Friends
                WHERE (Friends.friend1 = $id OR Friends.friend2 = $id)
                UNION
                SELECT friend2 AS friend
                FROM Friends
                WHERE(Friends.friend1 = $id OR Friends.friend2 = $id)
            )
              AND Users.id != $id
        ) ping INNER JOIN Friends WHERE ((friend1=ping.id AND friend2 = $id) OR (friend1= $id AND friend2=ping.id))";
         //echo $sqlQuery;
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement
        $dataSet = [];
        while ($row = $statement->fetch()) {
            $dataSet[] = new FriendsData($row);
        }
        return $dataSet;
    }

    public function fetchAUser($username)
    {
        $sqlQuery = 'SELECT * FROM Users WHERE username Like ?';
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(array("%$username%")); // execute the PDO statement
        // $dataSet = [];
        // while ($row = $statement->fetch()) {
        //     $dataSet[] = new UserData($row);
        // }
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function fetchCurrentUser($id)
    {
        $sqlQuery = 'SELECT * FROM Users WHERE id Like ?';
        //echo $sqlQuery;
       $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
       $statement->execute(array($id)); // execute the PDO statement
        // $dataSet = [];
        // while ($row = $statement->fetch()) {
        //     $dataSet[] = new UserData($row);
        // }
        return $statement->fetch();
    }
    //update a friend request status to accepted
    public function acceptFriendship($requestingID)
    {
        $sqlQuery = 'UPDATE Friends SET status=2 WHERE id = ?';
         //echo $sqlQuery;
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(array($requestingID)); // execute the PDO statement
    }

    //add a friend request
    public function requestFriendship($requestingID, $requestedID)
    {
        $friendStatus = 0;
        $myQuery = "select * from Friends where (friend1 = $requestingID AND friend2 = $requestedID) OR (friend1 = $requestedID AND friend2 = $requestingID)";
        $statement = $this->_dbHandle->prepare($myQuery); // prepare a PDO statement
        $statement->execute(); // execute the PDO statement;
        $row = $statement->fetch();
        if (!($row) && $requestedID != $requestingID) { //if they are not friends/or didnt send frirend request to each other and not sending request to their self
           $sqlQuery = "INSERT Friends (friend1, friend2, status) VALUES ($requestingID, $requestedID, 1)";
           $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
           $statement->execute(); // execute the PDO statement
           $friendStatus = 1;
        }
        return $friendStatus;
    }

    //cancel a friend request
    public function cancelFriendship($requestingID)
    {
        $sqlQuery = 'DELETE FROM Friends WHERE id = ?';
         //echo $sqlQuery;
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(array($requestingID)); // execute the PDO statement
    }

    //cancel a friend request
    public function removeFriendship($requestingID)
    {
        $sqlQuery = 'DELETE FROM Friends WHERE id = ?';
         //echo $sqlQuery;
        $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
        $statement->execute(array($requestingID)); // execute the PDO statement
    }

    public function updateUserLocation($userId, $latitude, $longitude)
    {
         $sqlQuery = 'UPDATE Users SET lat=?, lng = ? WHERE id = ?';
         $statement = $this->_dbHandle->prepare($sqlQuery); // prepare a PDO statement
         $statement->execute(array($latitude, $longitude, $userId)); // execute the PDO statement
    }

}