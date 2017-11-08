<?php
class MessagesGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "SELECT MessageID, EmployeeID, ContactID, MessageDate, Category, MessageDate, Category, Content FROM EmployeeMessages";   
        
       
    }
    
    protected function getOrderFields() {
        return "DateBy";
    }
    
    protected function getPrimaryKeyName() {
        return "ToDoID";
    }
    
    protected function getForeignKeyName() {
            return "EmployeeID";
    }
    
    protected function getAllToDo(){
         return "SELECT ToDoID, EmployeeID, DateBy, Status, Priority, Description FROM EmployeeToDo";
    }
   
}
?>