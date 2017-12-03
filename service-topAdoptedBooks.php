<?php 
 
require_once("includes/config.php");


    $row = array();
  //$bookDb = new BookGateway($connection);
  //$books  = $bookDb->getAll(true);
  $topBook = outputOrphans();
    foreach( $topBook as $result){
        $row[] = [
            "Title" => $result["title"],
            "Isbn10" => $result["isbn10"],
            // "CountryName" => $result["CountryName"],
            "Count" => $result["count"]
            ];
    }
    
    header('Content-Type: application/json');
    echo json_encode($row);


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
    return $visit;
    //   $result = $pdo->query($sql);
    //     $pdo = null;
    //     return $result;
    // }
    // catch (PDOException $e) {
    //     die($e->getMessage());
    // }
}

function outputOrphans()
{
    include "includes/config.php";
    $adoptionDb = new AdoptionGateway($connection);
    $orphan = $adoptionDb->findOrphans();
    return $orphan;
    // foreach ($orphan as $row)  {
    //     echo ('<tr><td>');
    //     echo ('<img src="/book-images/thumb/' . $row["isbn10"] . '.jpg" alt="book cover"></td>');
    //     echo ('<td class="mdl-data-table__cell--non-numeric"><a href="single-book.php?isbn=' . $row["isbn10"] . '"><b>' . $row["title"] . "</b><br></a>Adoptions: " . $row[count] . "</td></tr>");
    // }
}


?>