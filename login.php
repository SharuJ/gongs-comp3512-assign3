<?php
    session_start();
    include 'includes/config.php';
    include 'signin.php';
    //echo $_GET['name'];
?> 




<!DOCTYPE HTML>
<html>

<head>
    <title>Page Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
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
                        <h2 class="mdl-card__title-text">Login</h2> </div>
                    <div class="mdl-card__supporting-text">
 
                        <form id="lgin" name="login" action="./signin.php?name=<?php echo $_GET['name'] ?>" method="post">
                            <div id="msg"></div>
                            <label>Username:</label>
                            <!--remove values before submission-->
                            <input id="username" name="username" placeholder="Enter Username" type="text" required value="stanisław.wójcik@wp.pl">
                            <hr>
                            <label>Password:</label>
                            <input id="password" name="password" placeholder="**********" type="password" required value="abcd1234">
                            <hr>
                            <?php echo $error ?>
                            <br>
                            <button name="submit" type="submit" value=" Login " class="mdl-button mdl-js-button" id="lightPeriwinkle">Login</button>
                            
                            </form>
                            <a href=registration.php><button value="register" class="mdl-button mdl-js-button" id="lightPeriwinkle">Register</button></a>
                    </div>
                </div>
    </div>
    </section>
    </main>
    </div>
</body>