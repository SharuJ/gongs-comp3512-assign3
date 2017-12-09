<?php 
 
require_once("includes/config.php");


    $row = array();
  // getting the data from ouputOrphans()
  $topBook = outputOrphans();
  // putting the data from outputOrphans() into an array
    foreach( $topBook as $result){
        $row[] = [
            "Title" => $result["title"],
            "Isbn10" => $result["isbn10"],
            "Count" => $result["count"],
            "Quantity" => $result["quant"]
            ];
    }
    // the browser will be recieving the json data
    header('Content-Type: application/json');
    // the associative array is going to be converted into JSON
    echo json_encode($row);


//this function will get the title, isbn10, count and quant from the sql statment being executed from this function
function outputOrphans()
{
    include "includes/config.php";
    $adoptionDb = new AdoptionGateway($connection);
    $orphan = $adoptionDb->findOrphans();
    return $orphan;
   
}


?>