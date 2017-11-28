<script>

    function setBackground(e){
        if (e.type == "focus") {
            e.target.style.backgroundColor = "CAEEAA";
        }
        else if (e.type == "blur") {
            e.target.style.backgroundColor = "white";
            checkForEmptyFields(e);
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
                fields[i].classList.remove("error");
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
    

</script> 

 
 <?php
include 'includes/config.php';
session_start(); // Starting Session
$error = ''; // Variable To Store Error Message
if (isset($_POST['submit']))
{
    // if (empty($_POST['username']) || empty($_POST['password']))
    // {
    //     //$error = "Incorrect Password or Username";
    // }
    // else
    // {
        include "includes/config.php";
        //$userLoginDb = new UsersLoginGateway($connection); 
        $regDb = new RegistrationGateway($connection);
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
       
       
       
        //echo ( $lastN );
        //$sql = $regDb->getInsertStatement($userN, $lastN, $add, $ci, $reg, $coun, $post, $pho,  $ema);
         $num =  $regDb->findMaxIdNum();
        //echo($num);
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
        
        //$login = $userLoginDb->getByForeignKey($username);
        // if (empty($login))
        // {
        //     $error = "Incorrect username or password!";
          
        //   echo ("<script> alert('".$error."'); location.href= 'login.php'; </script>");
           
            
        // }
        // else
        // {
        //     foreach ($login as $row)
        //     {
        //         $salt   = $row["Salt"];
        //         $pass   = md5($_POST['password'] . $salt);
        //         if ($row['Password'] == $pass)
        //         {
        //             $_SESSION['userid'] = $row['UserID']; // Initializing Session
        //             //$insert = $regDb->insertUser();
        //             $user = $usersDb->getByForeignKey($username);
        //             foreach ($user as $row)
        //             {
        //                 $_SESSION['firstname'] = $row['FirstName']; 
        //                 $_SESSION['lastname']  = $row['LastName'];
        //                 $_SESSION['email']     = $row['Email'];
        //                 $_SESSION['region'] = $row['Region']; if ($row['Region'] == NULL){$_SESSION['region'] = "Not Provided"; }
        //                 $_SESSION['address'] = $row['Address']; if ($row['Address'] == NULL){$_SESSION['address'] = "Not Provided"; }
        //                 $_SESSION['city'] = $row['City']; if ($row['City'] == NULL){$_SESSION['city'] = "Not Provided"; }
        //                 $_SESSION['country'] = $row['Country']; if ($row['Country'] == NULL){$_SESSION['country'] = "Not Provided"; }
        //                 $_SESSION['postal'] = $row['Postal']; if ($row['Postal'] == NULL){$_SESSION['postal'] = "Not Provided"; }
        //                 $_SESSION['phone'] = $row['Phone']; if ($row['Phone'] == NULL){$_SESSION['phone'] = "Not Provided"; }
        //                 if (!empty($_GET['name']))
        //                 {
        //                     header("Location: " . $_GET['name']);
        //                 }
        //                 else
        //                 {
        //                     header("Location: index.php"); // Redirecting To Other Page
        //                 }
        //             }
        //         }
        //         else
        //         {
        //             $error = "Incorrect username or password!";
                    
        //               echo ("<script> alert('".$error."'); location.href= 'login.php'; </script>");
                    
        //         }
        //     }
           
        // }

    //}
   
}
?>
 