<?php require_once("includes/config.php"); 
  session_start();
  
$ID = $_POST['user'];
$password = $_POST['pass'];

   // do we have to use a user gateway class?
   $sql = "Select Salt, Password, FirstName, LastName, Email from UsersLogin join Users where UsersLogin.UserID = Users.UserID and UserLogin=".$ID;
      $row   = $result->fetch();
     $concat = md5($pasword.$row['Salt']) ;
     
     if (!empty($row['UserName']) && !empty($row['Password'])){
    if ($concat == $row['Password']){
      
       $_SESSION['username'] = $ID;
       
       $_SESSION['firstName'] = $row['FirstName'];
       $_SESSION['lastName'] = $row['LastName'];
       $_SESSION['userEmail'] = $row['Email'];
       
    
    }
     }
     

if (isset($_POST['submit']))
{
  signin();
}



?>
