<script>

    function setBackground(e){
        if (e.type == "focus") {
            e.target.style.backgroundColor = "BBE9EB";
        }
        else if (e.type == "blur") {
            e.target.style.backgroundColor = "white";
        }
    }
    
    window.addEventListener("load",	function(){
    	var	cssSelector	=	"input[name=username],input[name=password]";
    	var	fields	=	document.querySelectorAll(cssSelector);
    	for	(var i=0; i<fields.length; i++)
    	{
    		fields[i].addEventListener("focus",	setBackground);
    		fields[i].addEventListener("blur",	setBackground);
    	}
    }); 

</script>
<?php
include 'includes/config.php';
session_start(); // Starting Session
$_POST["error"] = "1";
if (isset($_POST['submit']))
{
    if (empty($_POST['username']) || empty($_POST['password']))
    {
        $_POST["error"] = "2";
    }
    else
    {
        include "includes/config.php";
        $userLoginDb = new UsersLoginGateway($connection); 
       
        $username = $_POST['username'];
        $login = $userLoginDb->getByForeignKey($username);
        if (empty($login))
        {
            //echo ("<script> alert('".$_POST["error"]."'); location.href= 'login.php'; </script>");
            $_POST["error"] = "3";
            header("Location: login.php");
        }
        else
        {
            foreach ($login as $row)
            {
                $salt   = $row["Salt"];
                $pass   = md5($_POST['password'] . $salt);
                if ($row['Password'] == $pass)
                {
                    $_SESSION['userid'] = $row['UserID']; // Initializing Session
                    $usersDb = new UsersGateway($connection);
                    $user = $usersDb->getByForeignKey($username);
                    foreach ($user as $row)
                    {
                        $_SESSION['firstname'] = $row['FirstName']; 
                        $_SESSION['lastname']  = $row['LastName'];
                        $_SESSION['email']     = $row['Email'];
                        $_SESSION['region'] = $row['Region']; if ($row['Region'] == NULL){$_SESSION['region'] = "Not Provided"; }
                        $_SESSION['address'] = $row['Address']; if ($row['Address'] == NULL){$_SESSION['address'] = "Not Provided"; }
                        $_SESSION['city'] = $row['City']; if ($row['City'] == NULL){$_SESSION['city'] = "Not Provided"; }
                        $_SESSION['country'] = $row['Country']; if ($row['Country'] == NULL){$_SESSION['country'] = "Not Provided"; }
                        $_SESSION['postal'] = $row['Postal']; if ($row['Postal'] == NULL){$_SESSION['postal'] = "Not Provided"; }
                        $_SESSION['phone'] = $row['Phone']; if ($row['Phone'] == NULL){$_SESSION['phone'] = "Not Provided"; }
                        if (!empty($_GET['name']))
                        {
                            header("Location: " . $_GET['name']);
                        }
                        else
                        {
                            $_POST["error"] = "4";
                            header("Location: index.php"); // Redirecting To Other Page
                        }
                    }
                }
                else
                {
                    $_POST["error"] = "5";
                    header("Location: login.php");
                            
                    //  echo ("<script> alert('".$error."'); location.href= 'login.php'; </script>");
                    
                }
            }
           
        }

    }
   
}
?>