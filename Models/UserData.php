<?php

class UserData
{
// private fields
    private $_id, $_fullName, $_username,$_img, $_email, /*$_pass,*/ $_lat, $_lng;
    public function __construct($dbRow) {
        $this->_id = $dbRow['id'];
        $this->_fullName = $dbRow['full_name'];
        $this->_username = $dbRow['username'];
        $this->_img = $dbRow['img'];
        $this->_email = $dbRow['email'];
        $this->_lat = $dbRow['lat'];
        $this->_lng = $dbRow['lng'];
    }
    // public function jsonSerialize() { 
    //     return
    //     [
    //         '_id' => $this->_id,
    //         '_fullName'=> $this->_fullName,
    //         '_username'=> $this->_username,
    //         '_img'=> $this->_img,
    //         '_email'=> $this->_email,
    //         '_lat' => $this->_lat,
    //         '_lng' => $this->_lng,
    //     ];
    //     }
    public function getUserID() {
        return $this->_id; // accessor for the id field
    } 
    public function getFullName() { // accessor for the fullName field
        return $this->_fullName;
    }
    public function getUsername() { // accessor for the username field
        return $this->_username;
    }
    public function getImage() { // accessor for the img field
        return $this->_img;
    }
    public function getEmail() { // accessor for the email field
        return $this->_email;
    }
    public function getLat() { // accessor for the lat field
        return $this->_lat;
    }
    public function getLng() { // accessor for the lng field
        return $this->_lng;
    }
}