<?php 
include 'includes/config.php';  

    $row = array();
  //$bookDb = new BookGateway($connection);
  //$books  = $bookDb->getAll(true);
  $topCountries = dropNations();
    foreach($topCountries as $result){
        $row[] = [
            "CountryCode" => $result["CountryCode"],
            "CountryName" => $result["CountryName"],
            "Count" => $result["count"]
            ];
    }
    
    header('Content-Type: application/json');
    echo json_encode($row);


function countCountries()
{
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql    = "select BookVisits.CountryCode as CountryCode, CountryName, count(*) AS count from BookVisits 
                    LEFT JOIN Countries on BookVisits.CountryCode = Countries.CountryCode
                    GROUP BY CountryCode ORDER BY count DESC";
        $result = $pdo->query($sql);
        $pdo = null;
        return $result;
    }
    catch (PDOException $e) {
        die($e->getMessage());
    }
}

function dropNations()
{
    include "includes/config.php";
    $visitsDb = new VisitsGateway($connection);
    $visit = $visitsDb->findWithFilter();
    foreach ($visit as $row) 
        echo ('<option value=' . $row["count"] . '>' . $row["CountryName"] . '</option>');
}

?>