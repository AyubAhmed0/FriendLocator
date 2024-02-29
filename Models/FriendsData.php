<?php

class FriendsData extends UserData
{
// private fields
    private $_id, $_fullName, $_username,$_img, $_email, /*$_pass,*/ $_lat, $_lng, $_fId, $_friend1, $_friend2, $_status;
    public function __construct($dbRow) {
        $this->_id = $dbRow['id'];
        $this->_fullName = $dbRow['full_name'];
        $this->_username = $dbRow['username'];
        $this->_img = $dbRow['img'];
        $this->_email = $dbRow['email'];
        // $this->_pass = $dbRow['password'];
        $this->_lat = $dbRow['lat'];
        $this->_lng = $dbRow['lng'];
        $this->_fId = $dbRow['id'];
        $this->_friend1 = $dbRow['friend1'];
        $this->_friend2 = $dbRow['friend2'];
        $this->_status = $dbRow['status'];
    }
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
   /* public function getPass() { // accessor for the pass field
        return $this->_pass;
    } */
    public function getLat() { // accessor for the lat field
        return $this->_lat;
    }
    public function getLng() { // accessor for the lng field
        return $this->_lng;
    }
    public function getFId() { // accessor for the fId field
        return $this->_fId;
    }
    public function getFriend1() { // accessor for the friend1 field
        return $this->_friend1;
    }
    public function getFriend2() { // accessor for the friend2 field
        return $this->_friend2;
    }
    public function getStatus() { // accessor for the status field
        return $this->_status;
    }
}