<?php
class UsersLoginGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "select UserID, UserName, Password, Salt, State, DateJoined, DateLastModified from UsersLogin";
    }
    
     protected function getInsertStatement($userN, $lastN, $add, $ci, $reg, $coun, $post, $pho,  $ema){
         return "nothing";
    }
    
    protected function getOrderFields() {
        return 'UserName';
    }
    
    protected function getPrimaryKeyName() {
        return "UserID";
    }
    
    protected function getForeignKeyName() {
            return "UserName";
    }
}
?>
