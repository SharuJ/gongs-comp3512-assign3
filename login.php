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
// include "session.php";
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Incorrect Password or Username";
    }
else{
    try {
    $username=$_POST['username'];
    $password=$_POST['password'];
    
    // Selecting Database
    
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "select UserID, UserName, Password, Salt, State, DateJoined, DateLastModified from UsersLogin where UserName='$username'";
    $result = $pdo-> query ($sql);
    //while ($row = $result->fetch()){
    $row = $result->fetch();
        $salt = $row['Salt'];
        $pass = md5($_POST['password'].$salt);
        if ($row['Password'] == $pass) {
            $_SESSION['userid']= $row['UserID']; // Initializing Session
            $sql2 = "select UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email from Users where Email='$username'";
            $result2 = $pdo-> query($sql2);
            //while ($row = $result2->fetch()){
                $row2 = $result2->fetch();
                $_SESSION['firstname']=$row2['FirstName'];
                $_SESSION['lastname']=$row2['LastName'];
                $_SESSION['email']=$row2['Email'];
            //}
            if(isset($_GET['name']))
            {
                header("Location: ". $_GET['name'].".php"); //browse-employees
                echo $_GET['name'];
            }
            else{
                header("Location: index.php"); // Redirecting To Other Page
            }
        } else {
            $error = "Incorrect Password or Username";
        }
    //}
    $pdo = null; // Closing Connection
    }

catch (PDOException $e)
        {
            die($e->getMessage());
        }
}
}

?>
 