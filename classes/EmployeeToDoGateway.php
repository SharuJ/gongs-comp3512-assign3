<?php
class EmployeeToDoGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "SELECT ToDoID, EmployeeID, DateBy, Status, Priority, Description FROM EmployeeToDo";   
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
    
    protected function orderStatement() {
        return " order by DateBy";
    }
}
?>