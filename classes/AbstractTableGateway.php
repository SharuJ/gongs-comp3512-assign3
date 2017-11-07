<?php
abstract class AbstractTableGateway {
    protected $connection;
    
    public function __construct($connect) {
        if (is_null($connect))
        throw new Exception ("Connection is null");
        $this->connection = $connect;
    }
    
    protected abstract function getSelectStatement();
    protected abstract function getPrimaryKeyName();
    protected abstract function getForeignKeyName();


    public function getAll($sortFields=null) {
        $sql = $this->getSelectStatement();
        
        if (! is_null($sortFields)) {
            $sql.= ' ORDER BY ' . $sortFields;
        }
        
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
    }
    
    public function getByKey($key) {
        $sql = $this->getSelectStatement() . ' WHERE ' . $this->getPrimaryKeyName() . '=:key';
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':key'=> $key));
        return $statement->fetch();
    } 
    

    public function getByForeignKey($key) {
        $sql = $this->getSelectStatement() . ' WHERE ' . $this->getForeignKeyName() . '=:key';
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':key'=> $key));
        return $statement->fetch();
    }
}
?>