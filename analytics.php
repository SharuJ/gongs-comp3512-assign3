<?php
require_once("includes/config.php");
include "includes/checkSession.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Analytics</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <link rel="stylesheet" href="css/styles.css">
    
    <script>
       var countryCode;
        window.addEventListener("load", function() {
            document.getElementById("nation").addEventListener("change", function() {
               var nation = $("#nation option:selected").text(); //some jQueery
               var url = "service-countryVisits.php";
               
    
            });
        });
        
        $(document).ready(function(){
    
            
            //Displays the country selected from the dropdown and the total visits for that country.
            $("#visted").on('change', function(e){
                e.preventDefault();
                
                // assisted by the website: https://api.jquery.com/serialize/
                console.log($(this).serialize());
                $.getJSON("service-countryVisits.php?" + $(this).serialize(), function(data){
                 var place5 = $("#space");
               console.log(data);
                
                $("#space").empty();
                $.each(data,function(key, val){
                
                var output = ("<b>Selected country:</b> " + val.CountryName + "<br><b>Total visits:</b> " + val.Visits);
     
                
                    place5.append(output);
                    
                });
               
                
            });
            
        });
            
            
            var nations = $("#nation");
            //assisted by the website : http://api.jquery.com/jquery.getjson/
            //appends countries to the Countries dropdown box, and setting each country's value to its country code
            //getting the JSON data from the service-topCountries.php page and displaying in this page
            $.getJSON("service-topCountries.php", function(data){
                
                $.each(data,function(key, val){
                    
                     var country = $('<option value="' + val.CountryCode + '">' + val.CountryName + '</option>'  );
                    nations.append(country);
                });
            }); 
            
            //assisted by the website : http://api.jquery.com/jquery.getjson/
            //getting the JSON data from the service-totals.php page and displaying in this page
            $.getJSON("service-totals.php", function(data){
                var place = $("#cvisits");
                var place1 = $("#ccountries");
                var place2 = $("#ctodo");
                var place3 = $("#cmessage")
                
                
                    
                //Putting Visits, Countries, Todos, and Messages from the returned JSON data into the html
                    place.text(data[0].Visits); 
                    var countC = data[1].Countries;
                    place1.text(countC);
                    place2.text(data[2].Todos);
                    place3.text(data[3].Messages);
                    
                
            });
            //assisted by the website : http://api.jquery.com/jquery.getjson/
            //getting the JSON data from the service-topAdoptedBooks.php page and displaying in this page
            $.getJSON("service-topAdoptedBooks.php", function(data){
                   var place4 = $("#table1");
               
               //Display Top Adoptees with image linking to Single Book page, 
               //number of universities that adopted the book and the quantity
                $.each(data,function(key, val){
                    
                    var output = ('<tr><td>' + '<img src="/book-images/thumb/' + val.Isbn10 + '.jpg" alt="book cover"></td>' + '<td class="mdl-data-table__cell--non-numeric"><a href="single-book.php?isbn=' + val.Isbn10 + '"><b>' + val.Title + '</b><br></a>Universities: ' + val.Count + '<br>Total quantity: ' + val.Quantity + '</td></tr>');
     
                    place4.append(output);
                    
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
                            <form id="visted" method="GET" action="service-countryVisits.php">
                            <select name="CountryCode" id="nation">
                                <option disabled selected>Select country</option> 
                                <!--<input type="submit" value="Submit">-->
                            </select>
                                 <!--<input type="submit" value="Submit">-->
                            </form>
                            <br>
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
                                    <b id="cvisits"></b> 
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
                                    <b id="ccountries"></b> 
                                   
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
                                    <b id="ctodo"></b> 
                                    
                                    
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
                                    <b id="cmessage"></b>
                                </div>
                            </div>
                            <!-- / mdl-cell + mdl-card -->
                    </div>     
                    
                    <!-- mdl-cell + mdl-card -->
                    <div class="mdl-cell mdl-cell--12-col mdl-shadow--2dp">
                        <div class="mdl-card__title" id="fadedBlue">
                            <h2 class="mdl-card__title-text">Top Adoptees</h2> </div>
                        <div class="mdl-card__supporting-text">
                            <table id="table1" class="mdl-data-table mdl-shadow--2dp">
                              
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