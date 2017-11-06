<?php
require_once("config.php");

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

function countVisits()
{
    try {
        $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql    = "select count(*) AS count from BookVisits;";
        $result = $pdo->query($sql);
        while ($row = $result->fetch()) {
            echo ($row["count"]);
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
    <title>Analytics</title>
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
                    
                    <!-- mdl-cell + mdl-card -->
                    <div class="mdl-cell mdl-cell--8-col">
                        <!-- mdl-cell + mdl-card -->
                        <div class="mdl-cell mdl-cell--12-col mdl-shadow--2dp">
                            <div class="mdl-card__title" id="lightGrayish">
                                <h2 class="mdl-card__title-text">June 2017 Totals</h2>
                            </div>
                            <div class="mdl-card__supporting-text mdl-cell--12-col">
                                            
                                <!-- mdl-cell + mdl-card -->
                                <div class="mdl-cell mdl-cell--3-col mdl-shadow--2dp">
                                    <div class="mdl-card__title" id="fireBrick">
                                        <h2 class="mdl-card__title-text mdl-color-text--white">Visits</h2>
                                    </div>
                                    <div class="mdl-card__supporting-text">
                                        <i class="material-icons small valign">wc</i>   
                                        <b><?php countVisits() ?></b>
                                    </div>
                                </div>
                                <!-- / mdl-cell + mdl-card -->
                                
                                <!-- mdl-cell + mdl-card -->
                                <div class="mdl-cell mdl-cell--3-col mdl-shadow--2dp">
                                    <div class="mdl-card__title" id="fireBrick">
                                        <h2 class="mdl-card__title-text mdl-color-text--white">Unique Countries</h2>
                                    </div>
                                    <div class="mdl-card__supporting-text">
                                        <i class="material-icons small valign">wc</i>   
                                        <b><?php countVisits() ?></b>
                                    </div>
                                </div>
                                <!-- / mdl-cell + mdl-card -->
                              
                            </div>
                        </div>
                        <!-- / mdl-cell + mdl-card -->
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