<?php
    session_start();
    include 'includes/config.php';
    include 'register.php';
    //echo $_GET['name'];
    
    if (isset($_POST)){
        print_r($_POST);
    }
    
?> 
<!DOCTYPE HTML>
<html>

<head>
    <title>Page Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    
    
</head>

<body id="body-color" >
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header" id="fireBrick">
            <div class="mdl-layout__header-row">
                <h1 class="mdl-layout-title"><span>CRM</span> Admin</h1> </div>
        </header>
        <main class="mdl-layout__content">
            <section class="page-content">
                <div class="mdl-cell mdl-cell--2-col card-lesson mdl-card  mdl-shadow--2dp" id="login">
                    <div class="mdl-card__title" id="lightPeriwinkle">
                        <h2 class="mdl-card__title-text">Register</h2> </div>
                    <div class="mdl-card__supporting-text">
                        <!--<form action="./register.php" method="post">-->
                       <!--name=<?php //echo $_GET['name'] ?>"-->
                       
                        <form action="register.php" method="post" > 
                        <!--onsubmit=""return checkPasswords();-->
                        <div id="error" >ERRROR!!!!!!!</div>
                            <div>Required fields are marked with *</div><br>
                            
                            <label>Firstname:</label>
                            <input id="firstname" name="firstname" placeholder="Enter Firstname" type="text" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>">
                            <hr>
                            <label>*Lastname:</label>
                            <input class="required" id="lastname" name="lastname" placeholder="Enter Lastname" type="text" value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>" >
                            <hr>
                            <label>Address:</label>
                            <input id="address" name="address" placeholder="Enter Address" type="text" value="<?php echo isset($_POST['address']) ? $_POST['address'] : '' ?>" >
                            <hr>
                            <label>City:</label>
                            <input id="city" name="city" placeholder="Enter City" type="text" value="<?php echo isset($_POST['city']) ? $_POST['city'] : '' ?>"  >
                            <hr>
                            <label>Region:</label>
                            <input id="region" name="region" placeholder="Enter Region" type="text" value="<?php echo isset($_POST['region']) ? $_POST['region'] : '' ?>"  >
                            <hr>
                            <label>*Country:</label>
                            <input class="required" id="country" name="country" placeholder="Enter Country" type="text" value="<?php echo isset($_POST['country']) ? $_POST['country'] : '' ?>"  >
                            <hr>
                            <label>Postal:</label>
                            <input id="postal" name="postal" placeholder="Enter Postal" type="text" value="<?php echo isset($_POST['postal']) ? $_POST['postal'] : '' ?>" >
                            <hr>
                            <label>Phone:</label>
                            <input id="phone" name="phone" placeholder="Enter Phone Number" type="text" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : '' ?>" >
                            <hr>
                            <label>*Email:</label>
                            <input class="required" id="email" name="email" placeholder="Enter Email Address" type="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" >
                            <hr>
                            <label>*Password:</label>
                            <input class="required" id="password" name="password" placeholder="**********" type="password" >
                            <hr>
                            <label>*Confirm Password:</label>
                            <input class="required" id="confirm-password" name="confirm-password" placeholder="**********" type="password">
                            <hr>
                            
                            
                            <button name="submit" type="submit" value=" Submit " class="mdl-button mdl-js-button" id="lightPeriwinkle">Submit</button>
                            
                            </form>
                            
                    </div>
                </div>
    </div>
    </section>
    </main>
    </div>
</body>