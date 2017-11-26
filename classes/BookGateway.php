<?php
class BookGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "select ISBN10, ISBN13, Title, CopyrightYear, SubcategoryName, Imprint, Status, BindingType, TrimSize, PageCountsEditorialEst, Description from Books LEFT JOIN Subcategories ON Books.SubcategoryID = Subcategories.SubcategoryID LEFT JOIN Imprints ON Books.ImprintID = Imprints.ImprintID LEFT JOIN Statuses ON Books.ProductionStatusID = Statuses.StatusID LEFT JOIN BindingTypes ON Books.BindingTypeID = BindingTypes.BindingTypeID";
    }
    
     protected function getInsertStatement($userN, $lastN, $add, $ci, $reg, $coun, $post, $pho,  $ema){
         return "nothing";
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