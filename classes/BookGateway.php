<?php
class BookGateway extends AbstractTableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "SELECT * FROM Books";
    }
    
    protected function getOrderFields() {
        return 'Title';
    }
    
    protected function getPrimaryKeyName() {
        return "BookID";
    }
    
    protected function getForeignKeyName() {
            return "BookID";
    }
}
?>