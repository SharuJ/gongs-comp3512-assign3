<?php include "includes/checkSession.php"; ?>
<?php 
    
        function printUserInfo()
        {
             echo "<table>";
             echo "<tr><td><strong>First Name: </strong></td><td>" . $_SESSION['firstname'] . "</td></tr>"; 
             echo "<tr><td><strong>Last Name: </strong></td><td>" . $_SESSION['lastname'] . "</td></tr>"; 
             echo "<tr><td><strong>Address: </strong></td><td>" . $_SESSION['address'] . "</td></tr>"; 
             echo "<tr><td><strong>City: </strong></td><td>" . $_SESSION['city'] . "</td></tr>"; 
             echo "<tr><td><strong>Region: </strong></td><td>" . $_SESSION['region'] . "</td></tr>"; 
             echo "<tr><td><strong>Country: </strong></td><td>" . $_SESSION['country'] . "</td></tr>"; 
             echo "<tr><td><strong>Postal: </strong></td><td>" . $_SESSION['postal'] . "</td></tr>"; 
             echo "<tr><td><strong>Phone: </strong></td><td>" . $_SESSION['phone'] . "</td></tr>"; 
             echo "<tr><td><strong>Email: </strong></td><td>" . $_SESSION['email'] . "</td></tr>"; 
             echo "</table>";
        }
        
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
    <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <link rel="stylesheet" href="css/styles.css"> 
    <!--<script>alert("We are a group of three! Profile is still under construction!");</script>-->
</head>

<body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
        mdl-layout--fixed-header">
        <?php include 'includes/header.inc.php'; ?>
        <?php include 'includes/left-nav.inc.php'; ?>

     <main class="mdl-layout__content mdl-color--grey-50">
      
       <section class="page-content">
                <div class="mdl-cell mdl-cell--2-col card-lesson mdl-card  mdl-shadow--2dp" id="userprofile">
                    <div class="mdl-card__title" id="lightPeriwinkle">
                        <h2 class="mdl-card__title-text">Profile Information</h2> </div>
                    <div class="mdl-card__supporting-text" id=userInfo>
                        <?php printUserInfo(); ?>
                        
                    </div>
                </div>
      </section>
     </main>
    </div>
    
</body>
</html>