<?php
class ImprintGateway extends TableGateway {
    public function __construct($connect) {
        parent::__construct($connect);
    }
    
    protected function getSelectStatement() {
        return "SELECT ImprintID,  Imprint FROM Imprints";
    }
    
    protected function getOrderFields() {
        return 'Imprint';
    }
    
    protected function getPrimaryKeyName() {
        return "ImprintID";
    }
    
    protected function getForeignKeyName() {
            return "ImprintID";
    }
    
    protected function getImprints() {
        return "select Imprint from Imprints order by Imprint";
    }
}
?>