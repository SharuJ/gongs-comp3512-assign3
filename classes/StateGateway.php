<?php
class StateGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "select StateName, StateAbbr from States";
    }
    
     protected function getInsertStatement($userN, $lastN, $add, $ci, $reg, $coun, $post, $pho,  $ema){
         return "nothing";
    }
    
    protected function getOrderFields() {
        return 'Name';
    }
    
    protected function getPrimaryKeyName() {
        return "StateID";
    }
    
    protected function getForeignKeyName() {
            return "StateID";
    }
    
    protected function orderStatement() {
        return " order by StateName";
    }
    
}
?>