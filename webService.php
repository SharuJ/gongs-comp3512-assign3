<?php 
include 'includes/config.php';  

    $row = array();
  $bookDb = new BookGateway($connection);
  $books  = $bookDb->getAll(true);
    foreach($books as $result){
        $row[] = [
            "Title" => utf8_encode($result['Title']),
            "Year" => $result["CopyrightYear"]
            ];
    }
    
    header('Content-Type: application/json');
    echo json_encode($row);

?>