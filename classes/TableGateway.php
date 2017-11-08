<?php

abstract class TableGateway {
    protected $connection;
    
    public function __construct($connect) {
        if (is_null($connect))
            throw new Exception ("Connection is null");
        $this->connection = $connect;
    }
    
    // The name of the table in the database
    protected abstract function getSelectStatement();
    
    // A list of fields that define the sort order
    protected abstract function getOrderFields();
    
    // The name of the primary keys in the database; this can be overridden by subclassses
    protected abstract function getPrimaryKeyName();
    
    
    protected abstract function getForeignKeyName();

    // Returns all the records in the table
    public function getAll($sortFields=null) {
        $sql = $this->getSelectStatement();
        
        if (! is_null($sortFields)) {
            $sql.= ' ORDER BY ' . $sortFields;
        }
        
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
    }
    
    // what's this for?
    public function getByKey($key) {
        $sql = $this->getSelectStatement() . ' WHERE ' . $this->getPrimaryKeyName() . '=:key';
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':key'=> $key));
        return $statement->fetch();
    } 
    
    // what's this for?
    public function getByForeignKey($key) {
        $sql = $this->getSelectStatement() . ' WHERE ' . $this->getForeignKeyName() . '=:key';
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':key'=> $key));
        return $statement->fetch();
    }
    
    // Returns all records in the table; pass in true if you want it ascending
    public function findAllSorted($ascending)
    {
        $sql = $this->getSelectStatement() . ' ORDER BY ' . $this->getOrderFields();
        if (! $ascending)
            $sql .= " DESC";
        
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':key'=> $key));
        return $statement->fetch();
    }
    
    // Returns a record for the specified ID
    public function findById($id)
    {
        $sql = $this->getSelectStatement() . ' WHERE ' . $this->getPrimaryKeyName() . '=:id';
        
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':key'=> $key));
        return $statement->fetch();
    }
    
    // for BROWSE BOOKS listing books with filter
    public function getBooks($sub, $imp)
    {
        //get everything from books, plus subcategory name and imprint
        $sql = $this->getAllInfo();

        //sub filter
        if (!empty($sub) && empty($imp))
            $sql .= ' WHERE SubcategoryName = "' . $sub . '"';
        //imp filter
        elseif (!empty($imp) && empty($sub))
            $sql .= ' WHERE Imprint = "' . $imp . '"';
        //both filter
        elseif (!empty($sub) && !empty($imp))
            $sql .= ' WHERE SubcategoryName = "' . $sub . '" AND Imprint = "' . $imp . '"';
                    
        $sql .= " order by Title LIMIT 20";
        
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
    }
    
    // for ToDos
     public function getToDo($key){
        //$sql = "SELECT ToDoID, EmployeeID, DateBy, Status, Priority, Description FROM EmployeeToDo WHERE EmployeeID=:$key ORDER BY DateBy";
          $sql = $this->getAllToDo();
          $sql.= 'WHERE EmployeeID = "'.$key.'"';
         echo ($sql);
         
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
        
    }
    
    
    
    
}
?>