<?php
class EmployeeToDoGateway extends AbstractTableGateway {
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
            return "ToDoID";
    }
    
    protected function getAllToDo($key){
         $sql = "SELECT ToDoID, EmployeeID, DateBy, Status, Priority, Description FROM EmployeeToDo WHERE Employee=:$key";
         
         
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
        
    }
   
}
?>