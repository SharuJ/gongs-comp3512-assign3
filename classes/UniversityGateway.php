<?php
class UniversityGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "select UniversityID, Name, Address, City, State, Zip, Website, Latitude, Longitude from Universities";
    }
    
     protected function getInsertStatement($num, $userN, $lastN, $add, $ci, $reg, $coun, $post, $pho,  $ema){
         return "nothing";
    }
    
    protected function getUsersLoginInsertStatement($num, $ema, $finalPass, $salt, $dateJoined, $dateLastModified){
         return "nothing";
    }
    
    protected function getOrderFields() {
        return 'Name';
    }
    
    protected function getPrimaryKeyName() {
        return "UniversityID";
    }
    
    protected function getForeignKeyName() {
            return "UniversityID";
    }
    
    protected function orderStatement() {
        return " order by Name LIMIT 20";
    }
    
}
?>