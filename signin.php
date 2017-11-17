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
$error = ''; // Variable To Store Error Message
if (isset($_POST['submit']))
{
    if (empty($_POST['username']) || empty($_POST['password']))
    {
        $error = "Incorrect Password or Username";
    }
    else
    {
        include "includes/config.php";
        $userLoginDb = new UsersLoginGateway($connection); 
        $username = $_POST['username'];
        $login = $userLoginDb->getByForeignKey($username);
        if (empty($login))
        {
            echo ("Useerr NO founndnd");
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
                        if (!empty($_GET['name']))
                        {
                            header("Location: " . $_GET['name']);
                        }
                        else
                        {
                            header("Location: index.php"); // Redirecting To Other Page
                        }
                    }
                }
                else
                {
                    $error = "Incorrect Password or Username";
                }
            }
        }

    }
}
?>