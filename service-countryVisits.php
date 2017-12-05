<?php 

require_once("includes/config.php");


    $row = array();
  $cc = $_GET['CountryCode'];
  
  
if(isset($_GET['CountryCode'])){
    //$row = array();
  $countryDetails = findCountryDetails($_GET['CountryCode']);
    foreach($countryDetails as $result){
        $row[] = [
            "CountryCode" => $result["CountryCode"],
            "CountryName" => $result["CountryName"],
            "Visits" => $result["count"]
            
            ];
    }
    //($topCountry as $result=){
        // $row[] = [
        //       "Countries" => $topCountry
        //     ]; 
            
        //  $row[] = [
        //     "Todos" => $topTodo
        //      ];
        
        //  $row[] = [
        //     "Messages" => $topMessage
        //      ];
    
}
    header('Content-Type: application/json');
    echo json_encode($row);
    
    function findCountryDetails($cc)
{
    include "includes/config.php";
    $visitsDb = new VisitsGateway($connection);
    $visits = $visitsDb->serviceFindCountryVisits($cc);
    return $visits;
    // foreach ($visit as $row) 
    //     echo ('<option value=' . $row["count"] . '>' . $row["CountryName"] . '</option>');
    
} 



// function countVisits()
// {
//     include "includes/config.php";
//     $visitsDb = new VisitsGateway($connection);
//     $visit = $visitsDb->findVisits();
//     return $visit;
//     // foreach ($visit as $row) 
//     //     echo ($row["count"]);
// } 
// //"CountryCode" => $result["CountryCode"],
//             // "CountryName" => $result["CountryName"],
//             //"Count" => $result["count"]

// function countToDos()
// {
//     include "includes/config.php";
//     $toDoDb = new EmployeeToDoGateway($connection);
//     $toDo = $toDoDb->findToDos();
//     return (sizeof($toDo));
// }

// function countMessages()
// {
//     include "includes/config.php";
//     $messagesDb = new MessagesGateway($connection);
//     $message = $messagesDb->findMessages();
//     return (sizeof($message));
// }


// function countCountries()
// {
//     // try {
//     //     $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
//     //     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     //     $sql    = "select BookVisits.CountryCode as CountryCode, CountryName, count(*) AS count from BookVisits 
//     //                 LEFT JOIN Countries on BookVisits.CountryCode = Countries.CountryCode
//     //                 GROUP BY CountryCode ORDER BY count DESC";
//     include 'includes/config.php'; 
//     $visitsDb = new VisitsGateway($connection);
//     $visit = $visitsDb->findNations(); 
//     //return $visit;
//     return sizeof($visit);

//     //   $result = $pdo->query($sql);
//     //     $pdo = null;
//     //     return $result;
//     // }
//     // catch (PDOException $e) {
//     //     die($e->getMessage());
//     // }
// }


?>