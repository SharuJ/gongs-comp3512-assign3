<?php
require_once("config.php");
function displayName()
{
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql    = 'select Title from Books where ISBN10=:isbn';
        $isbn   = $_GET['isbn'];
        $result = $pdo->prepare($sql);
        $result->bindValue(':isbn', $isbn);
        $result->execute();
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo ($row["Title"]);
        } else
            echo ("NO BOOK FOUND");
        $pdo = null;
    }
    catch (PDOException $e) {
        //die($e->getMessage());
        echo ("No book found that matches request. Try clicking on an book from the Books page.");
    }
}
function displayInfo() /* display requested employees information */ 
{
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql    = 'select ISBN10, ISBN13, CopyrightYear, SubcategoryName, Imprint, Status, BindingType, TrimSize, PageCountsEditorialEst, Description 
                    from Books
                    LEFT JOIN Subcategories ON Books.SubcategoryID = Subcategories.SubcategoryID 
                    LEFT JOIN Imprints ON Books.ImprintID = Imprints.ImprintID 
                    LEFT JOIN Statuses ON Books.ProductionStatusID = Statuses.StatusID 
                    LEFT JOIN BindingTypes ON Books.BindingTypeID = BindingTypes.BindingTypeID 
                    where ISBN10=:isbn';
        $isbn   = $_GET['isbn'];
        $result = $pdo->prepare($sql);
        $result->bindValue(':isbn', $isbn);
        $result->execute();
        if ($result->rowCount() > 0) {
            $row = $result->fetch();
            echo ('<center><img src="/book-images/medium/' . $row["ISBN10"] . '.jpg" alt="book cover" ><br></center>');
            echo ("<b>ISBN10:</b> " . $row["ISBN10"] . "<br>");
            echo ("<b>ISBN13:</b> " . $row["ISBN13"] . "<br>");
            echo ("<b>Copyright year:</b> " . $row["CopyrightYear"] . "<br>");
            echo ("<b>Subcategory:</b> " . $row["SubcategoryName"] . "<br>");
            echo ("<b>Imprint:</b> " . $row["Imprint"] . "<br>");
            echo ("<b>Production status:</b> " . $row["Status"] . "<br>");
            echo ("<b>Binding type:</b> " . $row["BindingType"] . "<br>");
            echo ("<b>Trim size:</b> " . $row["TrimSize"] . "<br>");
            echo ("<b>Pages:</b> " . $row["PageCountsEditorialEst"] . "<br>");
            echo ("<b>Description:</b> " . $row["Description"]);
        } else
            echo ("NO BOOK FOUND");
        $pdo = null;
    }
    catch (PDOException $e) {
        //die($e->getMessage());
        echo ("No book found that matches request. Try clicking on an book from the Books page.");
    }
}
function displayAuthor()
{
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql    = 'select FirstName, LastName from Books
                    INNER JOIN BookAuthors ON Books.BookID = BookAuthors.BookId
                    INNER JOIN Authors ON BookAuthors.AuthorId = Authors.AuthorID
                    where ISBN10 =:isbn order by BookAuthors.Order';
        $isbn   = $_GET['isbn'];
        $result = $pdo->prepare($sql);
        $result->bindValue(':isbn', $isbn);
        $result->execute();
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) //loop through the data
                {
                echo ($row["FirstName"] . " " . $row["LastName"] . "<br>");
            }
        } else
            echo ("NO AUTHORS FOUND");
        $pdo = null;
    }
    catch (PDOException $e) {
        //die($e->getMessage());
        echo ("No authors found that matches request. Try clicking on an book from the Books page.");
    }
}

function orderNations()
{
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql    = "select BookVisits.CountryCode, CountryName, count(*) AS count from BookVisits 
                    LEFT JOIN Countries on BookVisits.CountryCode = Countries.CountryCode
                    GROUP BY CountryCode ORDER BY count desc limit 15;";
        $result = $pdo->query($sql);
        while ($row = $result->fetch()) {
            echo ('<tr><td>' . $row["CountryName"]);
            echo ('</td><td>' . $row["count"] . '</td></tr>');
        }
        $pdo = null;
    }
    catch (PDOException $e) {
        die($e->getMessage());
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
                    <div class="mdl-cell mdl-cell--4-col mdl-shadow--2dp">
                        <div class="mdl-card__title" id="lightPeriwinkle">
                            <h2 class="mdl-card__title-text">Top 15 Countries</h2> </div>
                        <div class="mdl-card__supporting-text">
                            <table class="mdl-data-table" style="width:100%">
                                <tr>
                                    <th>Country</th>
                                    <th>Visitors</th>
                                </tr>
                                <?php orderNations() ?>
                            </table>
                            </div>
                    </div>
                    <!-- / mdl-cell + mdl-card -->
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