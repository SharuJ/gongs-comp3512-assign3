<?php
class AuthorGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "select FirstName, LastName from Books INNER JOIN BookAuthors ON Books.BookID = BookAuthors.BookId INNER JOIN Authors ON BookAuthors.AuthorId = Authors.AuthorID";
    }
    
    protected function getInsertStatement($num, $userN, $lastN, $add, $ci, $reg, $coun, $post, $pho,  $ema){
         return "nothing";
    } 
    
    protected function getUsersLoginInsertStatement($num, $ema, $finalPass, $salt, $dateJoined, $dateLastModified){
         return "nothing";
    }
    
    protected function getOrderFields() {
        return 'BookAuthors.Order';
    }
    
    protected function getPrimaryKeyName() {
        return "AuthorID";
    }
    
    protected function getForeignKeyName() {
            return "AuthorID";
    }
    
    protected function orderStatement() {
        return " order by BookAuthors.Order";
    }
    
}
?>