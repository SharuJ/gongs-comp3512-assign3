<script>

    function setBackground(e){
        if (e.type == "focus") {
            e.target.style.backgroundColor = "CAEEAA";
        }
        else if (e.type == "blur") {
            e.target.style.backgroundColor = "white";
            // this is creating a problem i think, so i commented it out
            //checkForEmptyFields(e);
            
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
 
    function checkForEmptyFields(e){

    	var	fields	=	document.getElementsByClassName("required");
        
        for (var i=0; i<fields.length; i++) {
            if (fields[i].value == null || fields[i].value == "") 
            {
                e.preventDefault();
                fields[i].classList.add("error");
                
            }
            else
                //fields[i].addEventListener("keyup",	setBackground);
                fields[i].classList.remove("error");
            fields[i].addEventListener("keyup",	setBackground);    
        }
    };
    
  
    
     function checkPasswords(){
         
         
         var firstPass = document.getElementById("password").value;
        var confirmPass = document.getElementById("confirm-password").value;
        
        if(firstPass != confirmPass){
            alert("Both of the passwords to do not match!");
            document.getElementById("password").value = "";
            document.getElementById("confirm-password").value= "";
             document.getElementById("password").focus(); 
             return false;
        }
        else{
            return true;
        }
         
     };
     
     //window.addEventListener("submit", checkPasswords);
      //window.on("submit", checkPasswords);
    
//     window.addEventListener("load",	function(){
//     // var message = document.querySelector("#error"); 
//      //message.innerHTML = 'The UserName already exists';
     
//      document.getElementById("error").innerHTML = "HI";
//  });    

</script> 

 
 <?php
include 'includes/config.php';
session_start(); // Starting Session
$error = ''; // Variable To Store Error Message
if (isset($_POST['submit']))
{
    //print_r($_POST);
    
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
        //$conPass = $_POST['confirm-password'];
        $salt = MD5(microtime());
        //$dateJoined = date("Y-m-d h:i:sa");
        $dateJoined = date("Y-m-d");
        $dateLastModified = date("Y-m-d");
        $finalPass = MD5($userPass.$salt);
       
       $checkU = $uloginDb->checkUser($ema);
       //echo('<script> console.log($checkU.length); </script>');
       //echo($checkU);
        if(count($checkU) > 0){
        //echo ( $lastN );
        //$sql = $regDb->getInsertStatement($userN, $lastN, $add, $ci, $reg, $coun, $post, $pho,  $ema);
        // $num =  $regDb->findMaxIdNum();
        //echo($num);
       // $num++;
        //  $_SESSION['uN'] = $_POST['firstname'];
        //  $_SESSION['lN'] = $_POST['lastname'];
        //  $_SESSION['aD'] = $_POST['address'];
        //  $_SESSION['cI'] = $_POST['city'];
        //  $_SESSION['rG'] = $_POST['region'];
        //  $_SESSION['cN'] = $_POST['country'];
        //  $_SESSION['pT'] = $_POST['postal'];
        //  $_SESSION['pH'] = $_POST['phone'];
         //$_SESSION['Em'] = $_POST['firstname'];
    //   $checkU = $uloginDb->checkUser($ema);
    //   echo('<script> console.log($checkU.length); </script>');
      
           
          
           header ('Location: registration.php' );
           //echo('<script> alert("hi");</script>');
           
       }else{
         $num =  $regDb->findMaxIdNum();
         $num++;
        $insert = $regDb->insertUser($num, $userN, $lastN, $add, $ci, $reg, $coun, $post, $pho,  $ema);
        
        //echo($insert); 
       $insert2 = $regDb->insertUserLogin($num, $ema, $finalPass, $salt, $dateJoined, $dateLastModified);
      // echo($insert2);
      
      
      
          
            
            
       if ($insert = "SUCCESS" && $insert2 = "SUCCESS"){
           header ('Location: login.php' );
       }
       else{
           echo('<script> checkPasswords(); </script>');
       }
    
 }
   
}
?>
 