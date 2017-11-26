<?php
class EmployeeGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "SELECT EmployeeID, FirstName, LastName, Address, City, Region, Country, Postal, Email FROM Employees";
    }
    
     protected function getInsertStatement($userN, $lastN, $add, $ci, $reg, $coun, $post, $pho,  $ema){
         return "nothing";
    }
    
    protected function getOrderFields() {
        return 'LastName, FirstName';
    }
    
    protected function getPrimaryKeyName() {
        return "EmployeeID";
    }
    
    protected function getForeignKeyName() {
        return "EmployeeID";
    }
    
    protected function orderStatement() {
        return " order by LastName";
    }
    
}
?>