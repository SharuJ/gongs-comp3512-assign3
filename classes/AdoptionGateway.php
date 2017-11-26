<?php
class AdoptionGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "select Name, Universities.UniversityID from Books INNER JOIN AdoptionBooks ON Books.BookID = AdoptionBooks.BookID INNER JOIN Adoptions ON AdoptionBooks.AdoptionID = Adoptions.AdoptionID INNER JOIN Universities ON Adoptions.UniversityID = Universities.UniversityID";
    }
    
    protected function getInsertStatement($userN, $lastN, $add, $ci, $reg, $coun, $post, $pho,  $ema){
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
        return " order by Name";
    }
    
}
?>