<?php
class MessagesGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "SELECT MessageID, EmployeeID, ContactID, MessageDate, Category, MessageDate, Category, Content FROM EmployeeMessages";   
        
       
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
    
    protected function getAllMessages(){
        
         return "SELECT MessageDate, Category, Content, FirstName, LastName FROM EmployeeMessages LEFT JOIN Contacts ON EmployeeMessages.ContactID = Contacts.ContactID";
         
    }
   
}
?>