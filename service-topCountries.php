<?php 
   
require_once("includes/config.php");


    $row = array();
  // getting the data from the dropNations()
  $topCountries = dropNations();
  // putting the data from dropNations() into an array
    foreach($topCountries as $result){
        $row[] = [
            "CountryName" => $result["CountryName"],
            "CountryCode" => $result["CountryCode"],
            "Count" => $result["count"]
            ];
    }
    // telling the browser that it will recieve JSON
    header('Content-Type: application/json');
    // the associative array will be converted into JSON
    echo json_encode($row);


// recieves the CountryName, CountryCode and the count data from the sql statment that will be executed from this function
function dropNations()
{
    include "includes/config.php";
    $visitsDb = new VisitsGateway($connection);
    $visit = $visitsDb->findWithFilter($filter1, $value1, $filter2, $value2);

return $visit;
 }

?>