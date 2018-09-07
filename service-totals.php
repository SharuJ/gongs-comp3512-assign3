<?php 

require_once("includes/config.php");


    $row = array();
  // having variables that store the data from the funtions
  $topVisit = countVisits();
  $topCountry = countCountries();
  $topTodo = countToDos();
  $topMessage = countMessages();
  // puting the data from the above variables into an array
    foreach($topVisit as $result){
        $row[] = [
            "Visits" => $result["count"]
            
            ];
    }
    
        $row[] = [
              "Countries" => $topCountry
            ]; 
            
         $row[] = [
            "Todos" => $topTodo
             ];
        
         $row[] = [
            "Messages" => $topMessage
             ];
    
    // telling the browser that it will recieve JSON content
    header('Content-Type: application/json');
    // the associatve array will be converted into JSON
    echo json_encode($row);
    
// gets the total visits
function countVisits()
{
    include "includes/config.php";
    $visitsDb = new VisitsGateway($connection);
    $visit = $visitsDb->findVisits();
    return $visit;
    
} 

// gets the total todos
function countToDos()
{
    include "includes/config.php";
    $toDoDb = new EmployeeToDoGateway($connection);
    $toDo = $toDoDb->findToDos();
    return (sizeof($toDo));
}

//gets the total messages
function countMessages()
{
    include "includes/config.php";
    $messagesDb = new MessagesGateway($connection);
    $message = $messagesDb->findMessages();
    return (sizeof($message));
}


//gets the total countries
function countCountries()
{
    
    include 'includes/config.php'; 
    $visitsDb = new VisitsGateway($connection);
    $visit = $visitsDb->findNations(); 
    
    return sizeof($visit);
 
}



?>