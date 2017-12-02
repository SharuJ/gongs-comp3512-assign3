<?php
class VisitsGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "select BookVisits.CountryCode, CountryName, count(*) AS count from BookVisits 
                LEFT JOIN Countries on BookVisits.CountryCode = Countries.CountryCode
                GROUP BY CountryCode";
    }
    
    protected function getInsertStatement($num, $userN, $lastN, $add, $ci, $reg, $coun, $post, $pho,  $ema){
         return "nothing";
    }
     protected function getUsersLoginInsertStatement($num, $ema, $finalPass, $salt, $dateJoined, $dateLastModified){
         return "nothing";
     }
    
    protected function getOrderFields() {
        return 'BookID';
    }
    
    protected function getPrimaryKeyName() {
        return "VisitID";
    }
    
    protected function getForeignKeyName() {
            return "BookID";
    }
    
    protected function orderStatement() {
        return " ORDER BY count desc limit 15";
    }
    
}
?>