<?php 

require_once("includes/config.php");


    $row = array();
  $cc = $_GET['CountryCode'];
  
  //getting the countrycode from the query string 
  //checking if the countrycode is gotten from the query string
if(isset($_GET['CountryCode'])){
    //the countrycode is passed in through the findCountryDetails() and it gets the country's code name and its visits
  $countryDetails = findCountryDetails($_GET['CountryCode']);
    foreach($countryDetails as $result){
        $row[] = [
            "CountryCode" => $result["CountryCode"],
            "CountryName" => $result["CountryName"],
            "Visits" => $result["count"]
            
            ];
    }
   
}
//the browser will be recieving json content
    header('Content-Type: application/json');
// will be converting the associative array into JSON    
    echo json_encode($row);
    
    function findCountryDetails($cc)
{
    include "includes/config.php";
    $visitsDb = new VisitsGateway($connection);
    $visits = $visitsDb->serviceFindCountryVisits($cc);
    return $visits;
   
    
} 

    




?>