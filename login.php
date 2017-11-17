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
//$usersDb = new UsersGateway($connection);
//$usersLoginDb = new UsersGateway($connection);
// include "session.php";
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

        // Selecting Database
        // include "includes/config.php";
        // $usersloginDb = new UsersLoginGateway($connection);
        // $usersDb = new UsersGateway($connection);
        // $login = $usersloginDb->getByForeignKey($username);
        // foreach ($login as $row)
        // {
        //$pdo      = new PDO(DBCONNSTRING, DBUSER, DBPASS);
        //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$sql    = "select UserID, UserName, Password, Salt, State, DateJoined, DateLastModified from UsersLogin where UserName='$username'";
        //$result = $pdo->query($sql);
        //$row    = $result->fetch();
        
        include "includes/config.php";
        $userLoginDb = new UsersLoginGateway($connection); 
        $username = $_POST['username'];
        $login = $userLoginDb->getByForeignKey($username);
        foreach ($login as $row)
        {
            $salt   = $row["Salt"];
            $pass   = md5($_POST['password'] . $salt);
            if ($row['Password'] == $pass)
            {
                $_SESSION['userid']    = $row['UserID']; // Initializing Session
                
                
                //$sql2 = "select UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email from Users where Email='$username'";
                //$result2 = $pdo->query($sql2);
                //$row2                  = $result2->fetch();
                
                $usersDb = new UsersGateway($connection);
                $user = $usersDb->getByForeignKey($username);
                foreach ($user as $row)
                {
                    $_SESSION['firstname'] = $row['FirstName'];
                    $_SESSION['lastname']  = $row['LastName'];
                    $_SESSION['email']     = $row['Email'];
                    if (isset($_GET['name']))
                    {
                        header("Location: " . $_GET['name'] . ".php");
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
?>
