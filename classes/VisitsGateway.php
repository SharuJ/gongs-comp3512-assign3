<?php
class VisitsGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    // Subquery thanks to https://stackoverflow.com/questions/7786570/get-another-order-after-limit-with-mysql
    protected function getSelectStatement() {
        return "select top.CountryCode, CountryName, count from (select BookVisits.CountryCode, CountryName, count(*) AS count from BookVisits 
                LEFT JOIN Countries on BookVisits.CountryCode = Countries.CountryCode
                GROUP BY CountryCode order by count desc limit 15) as top";
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
        return " ORDER BY CountryName";
    }
    
}
?>