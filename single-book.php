<?php

    include "includes/checkSession.php";
    function displayName() /* display requested book title */ 
    {
        include "includes/config.php";
        $bookDb = new BookGateway($connection);
        
        $book = $bookDb->findWithFilter("ISBN10 = ", $_GET['isbn'], null, null);
        foreach ($book as $row)
            echo ($row["Title"]);
    }
    
    function displayInfo() /* display requested book information */ 
    {
        include "includes/config.php";
        $bookDb = new BookGateway($connection);
    
        $book = $bookDb->findWithFilter("ISBN10 = ", $_GET['isbn'], null, null);
        foreach ($book as $row)
        {    
            echo ('<center><img id = "bookCover" src="/book-images/medium/' . $row["ISBN10"] . '.jpg" alt="book cover" ><br></center>');
            echo ("<br><b>ISBN10:</b> " . $row["ISBN10"] . "<br>");
            echo ("<b>ISBN13:</b> " . $row["ISBN13"] . "<br>");
            echo ("<b>Copyright year:</b> " . $row["CopyrightYear"] . "<br>");
            echo ('<b>Subcategory:</b> <a href="browse-books.php?sub=' . $row["SubcategoryName"] . '">' . $row["SubcategoryName"] . '</a><br>');
            echo ('<b>Imprint:</b> <a href="browse-books.php?imp=' . $row["Imprint"] . '">' . $row["Imprint"] . '</a><br>');
            echo ("<b>Production status:</b> " . $row["Status"] . "<br>");
            echo ("<b>Binding type:</b> " . $row["BindingType"] . "<br>");
            echo ("<b>Trim size:</b> " . $row["TrimSize"] . "<br>");
            echo ("<b>Pages:</b> " . $row["PageCountsEditorialEst"] . "<br>");
            echo ("<b>Description:</b> " . $row["Description"]);
        }
    }
    function displayAuthor()
    {
        include "includes/config.php";
        $authorDb = new AuthorGateway($connection);
    
        $authors = $authorDb->findWithFilter("ISBN10 = ", $_GET['isbn'], null, null);
        foreach ($authors as $row)
            echo ($row["FirstName"] . " " . $row["LastName"] . "<br>");
    }
    
    function displayUni()
    {
        include "includes/config.php";
        $adoptionDb = new AdoptionGateway($connection);
        $adopters = $adoptionDb->findWithFilter("ISBN10 = ", $_GET['isbn'], null, null);
        foreach ($adopters as $row) //loop through the data
        {
            echo ("<a href='browse-universities.php?id="); 
            echo ($row["UniversityID"]); //needs to UniveristyID
            echo ("'><li>");
            echo ($row["Name"] . "<br>");
            echo ("</li></a>");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Single Book</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
    <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>

        
            
<script> 
     
    //Image enlarging now uses Javascript instead of the Modal format. 
    window.addEventListener("load", function() {
        document.getElementById("bookCover").addEventListener("click", function() {
            document.getElementById("popup").style.display = "block";
        });
        
        document.querySelector("#popup img").addEventListener("click", function() {
            document.getElementById("popup").style.display = "none";
        });
    });
                        
</script>


<body>
    
    <div id="popup">
        <img src="/book-images/large/<?php echo $_GET['isbn'] ?>.jpg">
    </div>
    
    <div id="myModal" class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer 
        mdl-layout--fixed-header" style="z-index:2">
        <?php include 'includes/header.inc.php'; ?>
        <?php include 'includes/left-nav.inc.php'; ?>
        <main class="mdl-layout__content mdl-color--grey-50">
            <section class="page-content" style="z-index=3">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--6-col">
                        <!-- mdl-cell + mdl-card -->
                        <div class="mdl-cell mdl-cell--12-col mdl-shadow--2dp">
                            <div class="mdl-card__title" id="lightPeriwinkle">
                                <h2 class="mdl-card__title-text"><?php displayName() ?></h2> </div>
                            <div class="mdl-card__supporting-text">
                                <?php displayInfo() ?> </div>
                        </div>
                        <!-- / mdl-cell + mdl-card -->
                    </div>
                    <div class="mdl-cell mdl-cell--6-col">
                        <!-- mdl-cell + mdl-card -->
                        <div class="mdl-cell mdl-cell--12-col mdl-shadow--2dp">
                            <div class="mdl-card__title" id="lightGrayish">
                                <h2 class="mdl-card__title-text">Author(s)</h2> </div>
                            <div class="mdl-card__supporting-text">
                                <ul class="demo-list-item mdl-list">
                                    <?php displayAuthor() ?> </ul>
                            </div>
                        </div>
                        <!-- / mdl-cell + mdl-card -->
                        <!-- mdl-cell + mdl-card -->
                        <div class="mdl-cell mdl-cell--12-col card-lesson mdl-card  mdl-shadow--2dp">
                            <div class="mdl-card__title" id="fadedBlue">
                                <h2 class="mdl-card__title-text">Used by</h2> </div>
                            <div class="mdl-card__supporting-text">
                                <ul class="demo-list-item mdl-list">
                                    <?php displayUni() ?> </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / mdl-grid -->
            </section>
        </main>
    </div>
    <!-- / mdl-layout -->
</body>

</html>