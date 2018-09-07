<?php
    session_start();
    include 'includes/config.php';
    
?> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php
    
    if (isset($_POST['submit']))
    {
        if (empty($_POST['username']) || empty($_POST['password']))
        {
            
            // empty fields aleady being handled in the form (required)
        }
        else
        {
        include "includes/config.php";
        $userLoginDb = new UsersLoginGateway($connection); 
        $username = $_POST['username'];
        $login = $userLoginDb->getByForeignKey($username);
        if (empty($login))
        {
            
?> 
<script> 
//jquery for when the UserName(email) is not in the database
                $(document).ready(function(){
                $('#err').css("color", "red");      
                $('#err').text("Invalid username or password!");
                });
</script>
<?php 
//to php
        }
        else
        {
            foreach ($login as $row)
            {
                $salt   = $row["Salt"];
                $pass   = md5($_POST['password'] . $salt);
                //checks if the entered password and the $pass is equal 
                if ($row['Password'] == $pass)
                {
                    $_SESSION['userid'] = $row['UserID']; // Initializing Session
                    $usersDb = new UsersGateway($connection);
                    $user = $usersDb->getByForeignKey($username);
                    //putting all the users data into sessions
                    foreach ($user as $row)
                    {
                        $_SESSION['firstname'] = $row['FirstName']; 
                        $_SESSION['lastname']  = $row['LastName'];
                        $_SESSION['email']     = $row['Email'];
                        $_SESSION['region'] = $row['Region']; if ($row['Region'] == NULL){$_SESSION['region'] = "Not Provided"; }
                        $_SESSION['address'] = $row['Address']; if ($row['Address'] == NULL){$_SESSION['address'] = "Not Provided"; }
                        $_SESSION['city'] = $row['City']; if ($row['City'] == NULL){$_SESSION['city'] = "Not Provided"; }
                        $_SESSION['country'] = $row['Country'];  }
                        $_SESSION['postal'] = $row['Postal']; if ($row['Postal'] == NULL){$_SESSION['postal'] = "Not Provided"; }
                        $_SESSION['phone'] = $row['Phone']; if ($row['Phone'] == NULL){$_SESSION['phone'] = "Not Provided";
                    }
                    if (!empty($_GET['name']))
                        header("Location: " . $_GET['name']);
                    else
                        header("Location: index.php"); // Redirecting To index.php
                }
            }
            
?> 
<script> 
//jquery for error message when the passord is not correct
            $(document).ready(function(){
                $('#err').css("color", "red");      
                $('#err').text("Invalid username or password!");
            });
</script>
<?php 
//to php
            
            }
    }
}
//}
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
    <!--<script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>-->
    <script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
    <script>
    
        function setBackground(e){
        if (e.type == "focus") 
            e.target.style.backgroundColor = "BBE9EB";
        else if (e.type == "blur") 
            e.target.style.backgroundColor = "white";
        }
        
        // adding the addeventlistner for username and password fields for applying css
        
        window.addEventListener("load", function() {
            
            var	cssSelector	=	"input[name=username],input[name=password]";
            var	fields	=	document.querySelectorAll(cssSelector);
            for	(var i=0; i<fields.length; i++)
            {
            fields[i].addEventListener("focus",	setBackground);
            fields[i].addEventListener("blur",	setBackground);
            }
            
            //  The textual error message disappears once the user starts typing into the user name or password fields.
            for	(var i=0; i<fields.length; i++)
            {
                fields[i].addEventListener("keydown", function() {
                    $('#err').text("");
                });
            }
            
        });
        
    </script>
    
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
 
                        <form id="lgin" name="login" action="login.php?name=<?php echo $_GET['name'] ?>" method="post">
                            <div id="msg"></div>
                            <label>Username:</label>                                                               
                           
                            <input id="username" name="username" placeholder="Enter Username" type="text" required value="">
                            <hr>                                                                                    
                            
                            <label>Password:</label>
                            <input id="password" name="password" placeholder="**********" type="password" required value="">
                            <hr>
                            <div id="err"></div>
                            
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