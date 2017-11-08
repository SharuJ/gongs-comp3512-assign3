<?php
class BookGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "SELECT BookID, ISBN10, ISBN13, Title, CopyrightYear, SubcategoryID, ImprintID, ProductionStatusID, BindingTypeID, TrimSize, PageCountsEditorialEst, LatestInstockDate, Description, CoverImage FROM Books";
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
    
    protected function getAllInfo() {
        return "select ISBN10, Title, CopyrightYear, SubcategoryName, Imprint from Books LEFT JOIN Subcategories ON Books.SubcategoryID = Subcategories.SubcategoryID LEFT JOIN Imprints ON Books.ImprintID = Imprints.ImprintID";
    }
    
}
?>