<?php
class SubcategoryGateway extends AbstractTableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "SELECT SubcategoryID, CategoryID, SubcategoryName FROM Subcategories";
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
    
    protected function getSubs() {
        return "select SubcategoryName from Subcategories order by SubcategoryName";
    }
}
?>