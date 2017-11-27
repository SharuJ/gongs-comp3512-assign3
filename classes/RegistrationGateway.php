<?php
class RegistrationGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "select UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email from Users";
    }
    
    protected function getInsertStatement($num, $userN, $lastN, $add, $ci, $reg, $coun, $post, $pho,  $ema) {
        
        return "insert into Users (UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email) values ($num, '$userN', '$lastN', '$add', '$ci', '$reg', '$coun',  '$post', '$pho', '$ema')";
    }
    
    protected function getUsersLoginInsertStatement($num, $ema, $finalPass, $salt, $dateJoined, $dateLastModified){
         return "insert into UsersLogin (UserID, UserName, Password, Salt, DateJoined, DateLastModified) values ($num, '$ema', '$finalPass', '$salt', '$dateJoined', '$dateLastModified')";
    }
    
    protected function getOrderFields() {
        return 'UserID';
    }
    
    protected function getPrimaryKeyName() {
        return "UserID";
    }
    
    protected function getForeignKeyName() {
            return "Email";
    }
}
?> 

