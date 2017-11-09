<?php
class BookGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "select ISBN10, Title, CopyrightYear, SubcategoryName, Imprint from Books LEFT JOIN Subcategories ON Books.SubcategoryID = Subcategories.SubcategoryID LEFT JOIN Imprints ON Books.ImprintID = Imprints.ImprintID";
    }
    
    protected function getOrderFields() {
        return 'Title';
    }
    
    protected function getPrimaryKeyName() {
        return "BookID";
    }
    
    protected function getForeignKeyName() {
            return "BookID";
    }
    
    protected function orderStatement() {
        return " order by Title LIMIT 20";
    }
    
}
?>