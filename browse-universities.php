<?php
require_once("includes/config.php");
session_start();
function listName() /* programmatically loop though universities and display each university as <li> element. */ 
{
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (($_GET['st'] == "all") || empty($_GET['st'])) {
            $sql = "select UniversityID, Name from Universities order by Name LIMIT 20";
        } else {
            //convert from abbreviation
            $sql    = 'select StateName from States where StateAbbr =:st';
            $st     = $_GET['st'];
            $result = $pdo->prepare($sql);
            $result->bindValue(':st', $st);
            $result->execute();
            $row   = $result->fetch();
            $state = $row["StateName"];
            $sql   = 'select UniversityID, Name from Universities where State = "' . $state . '" order by Name LIMIT 20';
        }
        $result = $pdo->query($sql);
        while ($row = $result->fetch()) //loop through the data
            {
            echo ("<a href='?id=");
            echo ($row["UniversityID"]);
            echo ("&st=" . $_GET['st']);
            echo ("'><li>");
            echo ($row["Name"]);
            echo ("</li></a>");
        }
        $pdo = null;
    }
    catch (PDOException $e) {
        die($e->getMessage());
    }
}
function displayInfo() /* display requested univeristy information */ 
{
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql    = "select Name, Address, City, State, Zip, Website, Latitude, Longitude from Universities where UniversityID=:id";
        $id     = $_GET['id'];
        $result = $pdo->prepare($sql);
        $result->bindValue(':id', $id);
        $result->execute();
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) //loop through the data
                {
                echo ("<h4>" . $row["Name"] . "</h4>");
                echo ($row["Address"] . "<br>");
                echo ($row["City"] . ", " . $row["State"] . ", " . ($row["Zip"]) . "<br>");
                echo ($row["Website"] . "<br>");
                //echo ($row["Latitude"] . ", " . $row["Longitude"]);
                ?>
                  
    <div id="map"></div>
    <script>
    
      function initMap() {
          var latitude = parseFloat("<?php echo $row['Latitude']; ?>");
          var longitude = parseFloat("<?php echo $row['Longitude']; ?>");
        var uluru = {lat: latitude, lng: longitude };
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
   <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgOg-dKVI4dgMyBcTKOWj3xxS1jKipA3E&callback=initMap">
    </script>
   
                
<?php
            }
        } else
            echo ("No univeristy found that matches request. Try clicking on an university from the list.");
        $pdo = null;
    }
    catch (PDOException $e) {
        //die($e->getMessage());
        echo ("No univeristy found that matches request. Try clicking on an university from the list.");
    }
}
function dropStates()
{
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql    = "select StateName, StateAbbr from States";
        $result = $pdo->query($sql);
        while ($row = $result->fetch()) {
            echo ('<option value="' . $row["StateAbbr"] . '"');
            //show selected value
            if ($_GET['st'] == $row["StateAbbr"])
                echo ('selected="selected"');
            echo (">" . $row["StateName"] . "</option>");
        }
        $pdo = null;
    }
    catch (PDOException $e) {
        die($e->getMessage());
    }
}
if(!$isset($_SESSION['username'])){
    
    header(location: "login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Browse Universities</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
    <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <link rel="stylesheet" href="css/styles.css"> </head>

<body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
        mdl-layout--fixed-header">
        <?php include 'includes/header.inc.php'; ?>
        <?php include 'includes/left-nav.inc.php'; ?>
        <main class="mdl-layout__content mdl-color--grey-50">
            <section class="page-content">
                <div class="mdl-grid">
                    <!-- mdl-cell + mdl-card -->
                    <div class="mdl-cell mdl-cell--3-col card-lesson mdl-card  mdl-shadow--2dp">
                        <div class="mdl-card__title" id="fadedPink">
                            <h2 class="mdl-card__title-text">Universities</h2> </div>
                        <div class="mdl-card__supporting-text">
                            <form method="GET"> State:
                                <select name="st">
                                    <option value="all">ALL STATES</option>
                                    <?php dropStates(); ?> </select>
                                <input type="submit" value="Filter"> </form>
                            <ul class="demo-list-item mdl-list">
                                <?php listName(); ?> </ul>
                        </div>
                    </div>
                    <!-- / mdl-cell + mdl-card -->
                    <!-- mdl-cell + mdl-card -->
                    <div class="mdl-cell mdl-cell--9-col card-lesson mdl-card  mdl-shadow--2dp">
                        <div class="mdl-card__title" id="lightPeriwinkle">
                            <h2 class="mdl-card__title-text">University Details</h2> </div>
                        <div class="mdl-card__supporting-text">
                            <?php displayInfo(); ?> 
                            
                            </div>  
                            
                             
                            
                            
                            
                    </div>
                    <!-- / mdl-cell + mdl-card -->
                </div>
                <!-- / mdl-grid -->
            </section>
        </main>
    </div>
    <!-- / mdl-layout -->
</body>

</html>