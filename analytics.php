<?php
require_once("includes/config.php");
include "includes/checkSession.php";

function dropNations()
{
    include "includes/config.php";
    $visitsDb = new VisitsGateway($connection);
    $visit = $visitsDb->findWithFilter();
    foreach ($visit as $row) 
        echo ('<option value=' . $row["count"] . '>' . $row["CountryName"] . '</option>');
    
}

function countVisits()
{
    include "includes/config.php";
    $visitsDb = new VisitsGateway($connection);
    $visit = $visitsDb->findVisits();
    foreach ($visit as $row) 
        echo ($row["count"]);
}

function countCountries()
{
    include "includes/config.php";
    $visitsDb = new VisitsGateway($connection);
    $visit = $visitsDb->findNations();
    echo (sizeof($visit));
}

function countToDos()
{
    include "includes/config.php";
    $toDoDb = new EmployeeToDoGateway($connection);
    $toDo = $toDoDb->findToDos();
    echo (sizeof($toDo));
}

function countMessages()
{
    include "includes/config.php";
    $messagesDb = new MessagesGateway($connection);
    $message = $messagesDb->findMessages();
    echo (sizeof($message));
}

function outputOrphans()
{
    include "includes/config.php";
    $adoptionDb = new AdoptionGateway($connection);
    $orphan = $adoptionDb->findOrphans();
    foreach ($orphan as $row)  {
        echo ('<tr><td>');
        echo ('<img src="/book-images/thumb/' . $row["isbn10"] . '.jpg" alt="book cover"></td>');
        echo ('<td class="mdl-data-table__cell--non-numeric"><a href="single-book.php?isbn=' . $row["isbn10"] . '"><b>' . $row["title"] . "</b><br></a>Adoptions: " . $row[count] . "</td></tr>");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Analytics</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <link rel="stylesheet" href="css/styles.css">
    
    <script>

        window.addEventListener("load", function() {
            document.getElementById("nation").addEventListener("change", function() {
               var nation = $("#nation option:selected").text(); //some jQueery
               var count = document.getElementById("nation").value;
               document.getElementById("space").innerHTML = "<b>Selected country:</b> " + nation + "<br><b>Total visits:</b> " + count;
    
            });
        });
        
        $(document).ready(function(){
            var nations = $("#nation");
            $.getJSON("webService.php", function(data){
                $.each(data,function(key, val){
                    var country = $('<option value="' + val.Count + '">' + val.CountryName + '</option>'  );
                    nations.append(country);
                });
            });
        });
        
    </script>
</head>

<body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
        mdl-layout--fixed-header">
        <?php include 'includes/header.inc.php'; ?>
        <?php include 'includes/left-nav.inc.php'; ?>
        <main class="mdl-layout__content mdl-color--grey-50">
            <section class="page-content">
                <div class="mdl-grid">
                    <!-- mdl-cell + mdl-card -->
                    <div class="mdl-cell mdl-cell--4-col mdl-shadow--2dp">
                        <div class="mdl-card__title" id="fadedPink">
                            <h2 class="mdl-card__title-text">Visits Per Country</h2> </div>
                        <div class="mdl-card__supporting-text">
                            Top 15 countries:
                            <select id="nation">
                                <option disabled selected>Select country</option>
                                <?php dropNations() ?>
                            </select>
                            <br><br>
                            <div id="space"></div>
                        </div>
                    </div>
                    <!-- / mdl-cell + mdl-card -->
                    
                    <!-- mdl-cell + mdl-card -->
                    <div class="mdl-grid mdl-cell--8-col mdl-shadow--2dp">
                        <div class="mdl-card__title mdl-cell--12-col" id="lightGrayish">
                            <h2 class="mdl-card__title-text">Totals</h2>
                        </div>
                    
                            <!-- mdl-cell + mdl-card -->
                            <div class="mdl-cell mdl-cell--3-col mdl-shadow--2dp">
                                <div class="mdl-card__title" id="midnightBlue">
                                    <h2 class="mdl-card__title-text mdl-color-text--white">Visits</h2>
                                </div>
                                <div class="mdl-card__supporting-text">
                                    <i class="material-icons">wc</i>   
                                    <b><?php countVisits() ?></b>
                                </div>
                            </div>
                            <!-- / mdl-cell + mdl-card -->
                            
                            <!-- mdl-cell + mdl-card -->
                            <div class="mdl-cell mdl-cell--3-col mdl-shadow--2dp">
                                <div class="mdl-card__title" id="fireBrick">
                                    <h2 class="mdl-card__title-text mdl-color-text--white">Countries</h2>
                                </div>
                                <div class="mdl-card__supporting-text">
                                    <i class="material-icons">public</i>   
                                    <b><?php countCountries() ?></b>
                                </div>
                            </div>
                            <!-- / mdl-cell + mdl-card -->
                        
                            <!-- mdl-cell + mdl-card -->
                            <div class="mdl-cell mdl-cell--3-col mdl-shadow--2dp">
                                <div class="mdl-card__title" id="midnightBlue">
                                    <h2 class="mdl-card__title-text mdl-color-text--white">To-Dos</h2>
                                </div>
                                <div class="mdl-card__supporting-text">
                                    <i class="material-icons">done_all</i>   
                                    <b><?php countToDos() ?></b>
                                </div>
                            </div>
                            <!-- / mdl-cell + mdl-card -->
                        
                            <!-- mdl-cell + mdl-card -->
                            <div class="mdl-cell mdl-cell--3-col mdl-shadow--2dp">
                                <div class="mdl-card__title" id="fireBrick">
                                    <h2 class="mdl-card__title-text mdl-color-text--white">Messages</h2>
                                </div>
                                <div class="mdl-card__supporting-text">
                                    <i class="material-icons">mail_outline</i>   
                                    <b><?php countMessages() ?></b>
                                </div>
                            </div>
                            <!-- / mdl-cell + mdl-card -->
                    </div>     
                    
                    <!-- mdl-cell + mdl-card -->
                    <div class="mdl-cell mdl-cell--12-col mdl-shadow--2dp">
                        <div class="mdl-card__title" id="fadedBlue">
                            <h2 class="mdl-card__title-text">Top Adoptees</h2> </div>
                        <div class="mdl-card__supporting-text">
                            <table class="mdl-data-table mdl-shadow--2dp">
                                <?php outputOrphans() ?>
                            </table>
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