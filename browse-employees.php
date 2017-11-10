<?php
session_start();
function listName() /* programmatically loop though employees and display each name as <li> element. */ 
{
    include "includes/config.php";
    $empDb = new EmployeeGateway($connection);
    
    $ln = $_GET['ln'] . "%";
    
    $employees = $empDb->findWithFilter("LastName LIKE", $ln, "City =", $_GET['city']);
    foreach ($employees as $row)
    {
        echo ("<a href='browse-employees.php?id=");
        echo ($row["EmployeeID"]);
        echo ("&ln=" . $_GET['ln']);
        echo ("&city=" . $_GET['city']);
        echo ("'><li>");
        echo ($row["FirstName"] . " ");
        echo ($row["LastName"]);
        echo ("</li></a>");
    }
    
}

function displayInfo() /* display requested employees information */ 
{
    include "includes/config.php";
    $empDb = new EmployeeGateway($connection);
    
    if(empty($_GET['id']))
        echo "Click on an employee from the list";
    else
    {
        $employee = $empDb->findWithFilter("EmployeeID =", $_GET['id'], null, null);
        foreach ($employee as $row)
        {
            echo ("<h4>" . $row["FirstName"] . " ");
            echo ($row["LastName"] . "</h4>");
            echo ($row["Address"] . "<br>");
            echo ($row["City"] . ", " . $row["Region"] . "<br>");
            echo ($row["Country"] . ", " . $row["Postal"] . "<br>");
            echo ($row["Email"]);
        }
    }

}

function displayToDo() /* retrieve for selected employee; if none, display message to that effect */ 
{
    include "includes/config.php";
    $empToDoDb = new EmployeeToDoGateway($connection);
    
    if(empty($_GET['id']))
        echo "Click on an employee from the list";
    else
    {
        $toDo = $empToDoDb->findWithFilter("EmployeeID =", $_GET['id'], null, null);
        foreach ($toDo as $row)
        {
            echo ("<tr>");
            echo ('<td class="mdl-data-table__cell--non-numeric">');
            $date = strtotime($row["DateBy"]);
            echo (date("Y-M-d ", $date));
            echo ("</td>");
            echo ('<td class="mdl-data-table__cell--non-numeric">');
            echo ($row["Status"]);
            echo ("</td>");
            echo ('<td class="mdl-data-table__cell--non-numeric">');
            echo ($row["Priority"]);
            echo ("</td>");
            echo ('<td class="mdl-data-table__cell--non-numeric">');
            echo (substr($row["Description"], 0, 40));
            echo ("</td>");
            echo ("</tr>");
        }
        
    }
}

function displayMessages() /* retrieve for selected employee; if none, display message to that effect */ 
{
    include "includes/config.php";
    $messagesDb = new MessagesGateway($connection);
   
    if(empty($_GET['id']))
        echo "Click on an employee from the list";
    else
    {
        $message = $messagesDb->findWithFilter("EmployeeID =", $_GET['id'], null, null);
        foreach ($message as $row)
        {
            echo ("<tr>");
            echo ('<td class="mdl-data-table__cell--non-numeric">');
            $date = strtotime($row["MessageDate"]);
            echo (date("Y-M-d ", $date));
            echo ("</td>");
            echo ('<td class="mdl-data-table__cell--non-numeric">');
            echo ($row["Category"]);
            echo ("</td>");
            echo ('<td class="mdl-data-table__cell--non-numeric">');
            echo ($row["FirstName"] . " " . $row["LastName"]);
            echo ("</td>");
            echo ('<td class="mdl-data-table__cell--non-numeric">');
            $message40 = substr($row["Content"], 0, 40);
            echo ($message40);
            echo ("</td>");
            echo ("</tr>");
        }  
    }
}

function dropCities()
{
    
    include "includes/config.php";
    $empDb = new EmployeeGateway($connection);
   
    
        $cities = $empDb->findCities();
        foreach ($cities as $row)
        {
            echo ('<option value="' . $row["City"] . '"');
            //show selected value
            if ($_GET['city'] == $row["City"])
                echo ('selected="selected"');
            echo (">" . $row["City"] . "</option>");
        }  
   
}
if(!$isset($_SESSION['username'])){
    
    header(location: "login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Browse Employees</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
    <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <link rel="stylesheet" href="css/styles.css">
    
    <script type="text/javascript">
        function appear()
        {
            var x = document.getElementById("filter");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
    
</head>

<body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
        <?php include 'includes/header.inc.php'; ?>
        <?php include 'includes/left-nav.inc.php'; ?>
        <main class="mdl-layout__content mdl-color--grey-50">
            <section class="page-content">
                <div class="mdl-grid">
                   
                    <div class="mdl-cell mdl-cell--3-col">
                           
                        <!-- mdl-cell + mdl-card -->
                        <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card">
                            <div class="mdl-card__title" id="fadedBlue" onclick="appear()">
                                <h2 class="mdl-card__title-text">Filter (click me)</h2> </div>
                            <div class="mdl-card__supporting-text mdl-color--grey-50" id="filter" style="display: none">
                                <form method="get">
                                    Last name: <input name="ln"> <br>
                                    City: <select name="city">
                                        <option value="">ALL CITIES</option>
                                        <?php dropCities(); ?> </select>
                                    </select>
                                    <input type="submit">
                                </form>
                            </div>
                        </div>
                        <!-- / mdl-cell + mdl-card --> 
    
                        <!-- mdl-cell + mdl-card -->
                        <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">
                            <div class="mdl-card__title" id="fadedPink">
                                <h2 class="mdl-card__title-text">Employees</h2> </div>
                            <div class="mdl-card__supporting-text">
                                <ul class="demo-list-item mdl-list">
                                    <?php listName(); ?>
                                </ul>
                            </div>
                        </div>
                        <!-- / mdl-cell + mdl-card -->
                        
                    </div>
                    
                    <!-- mdl-cell + mdl-card -->
                    <div class="mdl-cell mdl-cell--9-col card-lesson mdl-card  mdl-shadow--2dp">
                        <div class="mdl-card__title" id="lightPeriwinkle">
                            <h2 class="mdl-card__title-text">Employee Details</h2> </div>
                        <div class="mdl-card__supporting-text">
                            <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
                                <div class="mdl-tabs__tab-bar"> <a href="#address-panel" class="mdl-tabs__tab is-active">Address</a> <a href="#todo-panel" class="mdl-tabs__tab">To Do</a> <a href="#messages-panel" class="mdl-tabs__tab">Messages</a> </div>
                                <div class="mdl-tabs__panel is-active" id="address-panel">
                                    <?php displayInfo(); ?> </div>
                                <div class="mdl-tabs__panel" id="todo-panel">
                                    <table class="mdl-data-table mdl-shadow--2dp">
                                        <thead>
                                            <tr>
                                                <th class="mdl-data-table__cell--non-numeric ">Date</th>
                                                <th class="mdl-data-table__cell--non-numeric ">Status</th>
                                                <th class="mdl-data-table__cell--non-numeric ">Priority</th>
                                                <th class="mdl-data-table__cell--non-numeric ">Content</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php displayToDo(); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mdl-tabs__panel" id="messages-panel">
                                        
                                <table class="mdl-data-table mdl-shadow--2dp">
                                    <thead>
                                        <tr>
                                            <th class="mdl-data-table__cell--non-numeric ">Date</th>
                                            <th class="mdl-data-table__cell--non-numeric ">Category</th>
                                            <th class="mdl-data-table__cell--non-numeric ">From</th>
                                            <th class="mdl-data-table__cell--non-numeric ">Message</th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    
                                    <?php displayMessages(); ?>
                                </tbody>
                                </table>
                                          
                                </div>
                            </div>
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