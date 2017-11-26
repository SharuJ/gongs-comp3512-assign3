<?php
class MessagesGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "SELECT MessageDate, Category, Content, FirstName, LastName FROM EmployeeMessages LEFT JOIN Contacts ON EmployeeMessages.ContactID = Contacts.ContactID";   
    }
    
     protected function getInsertStatement($userN, $lastN, $add, $ci, $reg, $coun, $post, $pho,  $ema){
         return "nothing";
    }
    
    protected function getOrderFields() {
        return "MessageDate";
    }
    
    protected function getPrimaryKeyName() {
        return "MessageID";
    }
    
    protected function getForeignKeyName() {
            return "EmployeeID";
    }
    
    protected function orderStatement() {
        return " order by MessageDate";
    }
    
}
?>