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

    protected abstract function getInsertStatement($num, $userN, $lastN, $add, $ci, $reg, $coun, $post, $pho,  $ema);
    
    protected abstract function getUsersLoginInsertStatement($num, $ema, $finalPass, $salt, $dateJoined, $dateLastModified);
    // Returns all the records in the table
    public function getAll($sortFields=null) {
        $sql = $this->getSelectStatement();
        
        if (! is_null($sortFields)) {
            $sql.= ' ORDER BY ' . $sortFields;
        }
        
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
    }
    
    // what's this for
    public function getByKey($key) {
        $sql = $this->getSelectStatement() . ' WHERE ' . $this->getPrimaryKeyName() . '=:key';
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':key'=> $key));
        return $statement->fetch();
    } 
    
    // what's this for
    public function getByForeignKey($key) {
        $sql = $this->getSelectStatement() . ' WHERE ' . $this->getForeignKeyName() . '=:key';
        $statement = DatabaseHelper::runQuery($this->connection, $sql, array(':key'=> $key));
        return $statement->fetchAll();
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
    
    // used to list BOOKS, EMPLOYEES and UNIs with UP TO TWO FITLERS!
    public function findWithFilter($filter1, $value1, $filter2, $value2)
    {
        $sql = $this->getSelectStatement();

        //first filter
        if (!empty($value1) && empty($value2))
            $sql .= ' WHERE ' . $filter1 . ' "' . $value1 . '"';
        //second filter
        elseif (!empty($value2) && empty($value1))
            $sql .= ' WHERE ' . $filter2 . ' "' . $value2 . '"';
        //both filters
        elseif (!empty($value1) && !empty($value2))
            $sql .= ' WHERE ' . $filter1 . ' "' . $value1 . '" AND ' . $filter2 . ' "' . $value2 . '"';
        
        $sql .= $this->orderStatement();
        
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
    } 
    
    public function findCities() {
       
          $sql = $this->getSelectStatement();
          //  there is a city , there is no last name
         
          $sql .= ' group by City order by City';
         //echo ($sql);
         
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
        
    }
    
    
    public function insertUser($num, $userN, $lastN, $add, $ci, $reg, $coun, $post, $pho,  $ema){
        $sql = $this->getInsertStatement($num, $userN, $lastN, $add, $ci, $reg, $coun, $post, $pho,  $ema);
       // echo($sql);
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        
        //$sql2 =  "insert into UsersLogin (UserID, UserName, Password, Salt, DateJoined, DateLastModified) values ('$num', '$ema', '$lastN', '$add', '$ci', '$reg', '$coun',  '$post', '$pho', '$ema')";
        return "SUCCESS";
    } 
    
    public function insertUserLogin($num, $ema, $finalPass, $salt, $dateJoined, $dateLastModified){
        $sql = $this->getUsersLoginInsertStatement($num, $ema, $finalPass, $salt, $dateJoined, $dateLastModified);
       // echo($sql);
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        
        //$sql2 =  "insert into UsersLogin (UserID, UserName, Password, Salt, DateJoined, DateLastModified) values ('$num', '$ema', '$lastN', '$add', '$ci', '$reg', '$coun',  '$post', '$pho', '$ema')";
        return "SUCCESS";
    } 
    
    public function findMaxIdNum(){
        $sql = "SELECT UserID FROM Users ORDER BY UserID DESC LIMIT 1";
        //echo($sql);
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        $row = $statement->fetch();
        return $row[0];
    }
    
    public function findVisits() {
        $sql = "select count(*) AS count from BookVisits; //where DateViewed between '2017-06-00 00:00:00' and '2017-06-30 23:59:00'";
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
    }
    
    public function findNations() {
        $sql = "select BookVisits.CountryCode, CountryName, count(*) AS count from BookVisits 
                    LEFT JOIN Countries on BookVisits.CountryCode = Countries.CountryCode
                    GROUP BY CountryCode"; //ORDER BY count DESC
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();  
        
        //     $sql    = "select BookVisits.CountryCode as CountryCode, CountryName, count(*) AS count from BookVisits 
    //                 LEFT JOIN Countries on BookVisits.CountryCode = Countries.CountryCode
    //                 GROUP BY CountryCode ORDER BY count DESC";
    }
    
    
    public function findToDos() {
        $sql = "select DateBy from EmployeeToDo 
                WHERE DateBy BETWEEN '2017-06-00 00:00:00' and '2017-06-30 23:59:00'";
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
    }
    
    public function findMessages() {
        $sql = "select MessageDate from EmployeeMessages 
                WHERE MessageDate BETWEEN '2017-06-00 00:00:00' and '2017-06-30 23:59:00'";
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
    }
    
    public function findOrphans() {
        $sql = "select count(AdoptionID) as count, AdoptionBooks.bookId, title, isbn10, sum(Quantity) as quant from AdoptionBooks inner join Books on Books.BookID = AdoptionBooks.BookID group by BookId order by quant desc limit 10";
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll();
    } 
    
    public function serviceFindCountryVisits($cc){
        
        $sql = "select BookVisits.CountryCode, CountryName, count(*) AS count from BookVisits LEFT JOIN Countries on BookVisits.CountryCode = Countries.CountryCode WHERE BookVisits.CountryCode = '$cc'";
        //echo($sql);
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
         return $statement->fetchAll();
    }
   
   public function checkUser($ema){
       $sql = "select UserID, UserName from UsersLogin where UserName = '$ema'"; 
       //echo($sql);
       $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        return $statement->fetchAll(); 
        
        //$count = mysql_num_rows($statement);
        //echo($count);
        //return $count;
        
        
        
         
   }
     // select BookVisits.CountryCode, CountryName, count(*) AS count from BookVisits LEFT JOIN Countries on BookVisits.CountryCode = Countries.CountryCode WHERE BookVisits. CountryCode = 'CA'
    

}
?>