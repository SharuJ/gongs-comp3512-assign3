<?php
    session_start();
    include 'includes/config.php';
    
?> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    function setBackground(e){
        if (e.type == "focus") {
            e.target.style.backgroundColor = "CAEEAA";
        }
        else if (e.type == "blur") {
            e.target.style.backgroundColor = "white";
            
            
        }
        else if (e.type == "keyup") {
            e.target.classList.remove("error");
            checkForEmptyFields(e)
        }
    }
    
    window.addEventListener("load",	function(){
    	var	cssSelector	=	"input[name=firstname],input[name=lastname],input[name=address],input[name=city],input[name=region],input[name=country],input[name=postal],input[name=phone],input[name=email],input[name=password],input[name=confirm-password]";
    	var	fields	=	document.querySelectorAll(cssSelector);
    	for	(var i=0; i<fields.length; i++)
    	{
    		fields[i].addEventListener("focus",	setBackground);
    		fields[i].addEventListener("blur",	setBackground);
    	}
    }); 
    
    window.addEventListener("submit", checkForEmptyFields);
 
    function checkForEmptyFields(e)
    {
    	var	fields	=	document.getElementsByClassName("required");
        for (var i=0; i<fields.length; i++)
        {
            if (fields[i].value == null || fields[i].value == "") 
            {
                e.preventDefault();
                fields[i].classList.add("error");
            }
            else
            {
                //fields[i].addEventListener("keyup",	setBackground);
                fields[i].classList.remove("error");
                fields[i].addEventListener("keyup",	setBackground);    
            }
        }
    };
    
  
    
       

</script> 

 
 <?php


if (isset($_POST['submit']))
{
    //grabing the users data and storing them in variables
    
        include "includes/config.php";
        //$userLoginDb = new UsersLoginGateway($connection); 
        $regDb = new RegistrationGateway($connection);
        $uloginDb = new UsersLoginGateway($connection);
        date_default_timezone_set("Canada/Mountain"); 
        $userN = $_POST['firstname'];
        $lastN = $_POST['lastname'];
        $add = $_POST['address'];
        $ci = $_POST['city'];
        $reg = $_POST['region'];
        $coun = $_POST['country'];
        $post = $_POST['postal'];
        $pho = $_POST['phone'];
        $ema = $_POST['email'];
        $userPass = $_POST['password'];
        $conPass = $_POST['confirm-password'];
        $salt = MD5(microtime());
        //$dateJoined = date("Y-m-d h:i:sa");
        $dateJoined = date("Y-m-d");
        $dateLastModified = date("Y-m-d");
        $finalPass = MD5($userPass.$salt);
       
       //returns the email that the user enters if it is in the table already
       $checkU = $uloginDb->checkUser($ema);
       
        if(count($checkU) > 0){
        
          
  ?>         
  
  <script> 
// if the email that the user entered into the register form is already in the table then it displays the error message
  $(document).ready(function(){
  $('#error').css("color", "red");      
  $('#error').text("The email that you have entered already exits. Please enter a different email address!");
    
    $('form>#email').css({
        borderColor: "#FF1744",
        boxShadow: "0px 0px 5px #FF5252",
        backgroundColor: "#FFCDD2"
    });
    
   
    
  });
  
  
  
  </script>
  
  
           
   <?php        
       }
       else{
        
        
        $userPass;
        $conPass ;
        if($userPass != $conPass){
?>  
<script>
            
     // if the users password and confirm password are not the same then this error message will be displayed       
    $(document).ready(function(){
  $('#error').css("color", "red");      
  $('#error').text("The password and the confirm password do not match! Please enter the password again.");
    
    $('form>#password').css({
        borderColor: "#FF1744",
        boxShadow: "0px 0px 5px #FF5252",
        backgroundColor: "#FFCDD2"
    });
    
     $('form>#confirm-password').css({
        borderColor: "#FF1744",
        boxShadow: "0px 0px 5px #FF5252",
        backgroundColor: "#FFCDD2"
    });
    

    
  });
            
            
             
</script>             
<?php            
        } else {
         // finding the max UserID number and then increments the next UserID number 
         $num =  $regDb->findMaxIdNum();
         $num++;
         // the user's data will be stored into the User table
        $insert = $regDb->insertUser($num, $userN, $lastN, $add, $ci, $reg, $coun, $post, $pho,  $ema);
        
         // the user's data will be stored into the UsersLogin table
       $insert2 = $regDb->insertUserLogin($num, $ema, $finalPass, $salt, $dateJoined, $dateLastModified);
      
      
         // if both of the insert and insert2 return SUCCESS (which means the the user' data is stored in both tables) then it will redirect them to the login page
       if ($insert = "SUCCESS" && $insert2 = "SUCCESS"){
           header ('Location: login.php' );
       }
       else{

        
       } 
    }
    
 }
   
}
?>
 
<!DOCTYPE HTML>
<html>

<head>
    <title>Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.blue_grey-orange.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <!--<script src="https://code.jquery.com/jquery-1.7.2.min.js"></script>-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
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
                        
                        <a href=login.php><button class="mdl-button mdl-js-button" id="lightPeriwinkle">Back to login</button></a>
                        <br><br>
                        
                       
                       
                        <form id="register" action="#" method="post" > 
                        
                        <!--https://stackoverflow.com/questions/5198304/how-to-keep-form-values-after-post-->
                        <!--assisted by the website https://stackoverflow.com/questions/5198304/how-to-keep-form-values-after-post , for populating post data back to the form-->
                        <div id="error" ></div>
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