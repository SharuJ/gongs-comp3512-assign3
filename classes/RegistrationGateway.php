<?php
class RegistrationGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "select UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email from Users";
    }
    
    protected function getInsertStatement($userN, $lastN, $add, $ci, $reg, $coun, $post, $pho,  $ema) {
        
        return "insert into Users (UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email) values (32, '$userN', '$lastN', '$add', '$ci', '$reg', '$coun',  '$post', '$pho', '$ema')";
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

