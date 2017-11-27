<?php
class UsersLoginGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    protected function getSelectStatement() {
        return "select UserID, UserName, Password, Salt, State, DateJoined, DateLastModified from UsersLogin";
    }
    
     protected function getInsertStatement($num, $userN, $lastN, $add, $ci, $reg, $coun, $post, $pho,  $ema){
         //return "insert into UsersLogin (UserID, UserName, Password, Salt, DateJoined, DateLastModified) values ('$num', '$ema', '$lastN', '$add', '$ci', '$reg', '$coun',  '$post', '$pho', '$ema')";
    
         return "nothing";
     }
    
     protected function getUsersLoginInsertStatement($num, $ema, $finalPass, $salt, $dateJoined, $dateLastModified){
         //return "insert into UsersLogin (UserID, UserName, Password, Salt, DateJoined, DateLastModified) values ('$num', '$ema', '$lastN', '$add', '$ci', '$reg', '$coun',  '$post', '$pho', '$ema')";
    
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
