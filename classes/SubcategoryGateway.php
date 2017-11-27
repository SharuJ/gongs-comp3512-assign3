<?php
class SubcategoryGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "SELECT SubcategoryID, CategoryID, SubcategoryName FROM Subcategories";
    }
    
     protected function getInsertStatement($num, $userN, $lastN, $add, $ci, $reg, $coun, $post, $pho,  $ema){
         return "nothing";
    }
    
    protected function getUsersLoginInsertStatement($num, $ema, $finalPass, $salt, $dateJoined, $dateLastModified){
         return "nothing";
    }
    
    protected function getOrderFields() {
        return 'SubcategoryName';
    }
    
    protected function getPrimaryKeyName() {
        return "SubcategoryID";
    }
    
    protected function getForeignKeyName() {
            return "SubcategoryID";
    }
}
?>