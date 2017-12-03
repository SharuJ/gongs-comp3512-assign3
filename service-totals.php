<?php 

require_once("includes/config.php");


    $row = array();
  
  $topVisit = countVisits();
  $topCountry = countCountries();
  $topTodo = countToDos();
  $topMessage = countMessages();
  
    foreach($topVisit as $result){
        $row[] = [
            "Visits" => $result["count"]
            
            ];
    }
    //($topCountry as $result=){
        $row[] = [
              "Countries" => $topCountry
            ]; 
            
         $row[] = [
            "Todos" => $topTodo
             ];
        
         $row[] = [
            "Messages" => $topMessage
             ];
    
    
    header('Content-Type: application/json');
    echo json_encode($row);

function countVisits()
{
    include "includes/config.php";
    $visitsDb = new VisitsGateway($connection);
    $visit = $visitsDb->findVisits();
    return $visit;
    // foreach ($visit as $row) 
    //     echo ($row["count"]);
} 
//"CountryCode" => $result["CountryCode"],
            // "CountryName" => $result["CountryName"],
            //"Count" => $result["count"]

function countToDos()
{
    include "includes/config.php";
    $toDoDb = new EmployeeToDoGateway($connection);
    $toDo = $toDoDb->findToDos();
    return (sizeof($toDo));
}

function countMessages()
{
    include "includes/config.php";
    $messagesDb = new MessagesGateway($connection);
    $message = $messagesDb->findMessages();
    return (sizeof($message));
}


function countCountries()
{
    // try {
    //     $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    //     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //     $sql    = "select BookVisits.CountryCode as CountryCode, CountryName, count(*) AS count from BookVisits 
    //                 LEFT JOIN Countries on BookVisits.CountryCode = Countries.CountryCode
    //                 GROUP BY CountryCode ORDER BY count DESC";
    include 'includes/config.php'; 
    $visitsDb = new VisitsGateway($connection);
    $visit = $visitsDb->findNations(); 
    //return $visit;
    return sizeof($visit);

    //   $result = $pdo->query($sql);
    //     $pdo = null;
    //     return $result;
    // }
    // catch (PDOException $e) {
    //     die($e->getMessage());
    // }
}

// function dropNations()
// {
//     include "includes/config.php";
//     $visitsDb = new VisitsGateway($connection);
//     $visit = $visitsDb->findWithFilter($filter1, $value1, $filter2, $value2);

//   return $visit;
//  }

?>