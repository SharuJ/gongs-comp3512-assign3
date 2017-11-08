<?php require_once("includes/config.php"); 
  session_start();
  
$ID = $_POST['user'];
$password = $_POST['pass'];

function signin()
{
  session_start();
  
  if(!empty($_POST['user']))
  {
    $sql = "Select * from UsersLogin where UserName =" . $_POST['user'] . " AND Password =" . $_POST['pass'] ;
    $row   = $result->fetch();
    if (!empty($row['UserName']) && !empty($row['Password']))
    {
      $_SESSION['username'] = $row['Password'];
      echo "Successfully logged in";
    } else {
      echo "Try again";
    }
  }
}
if (isset($_POST['submit']))
{
  signin();
}



?>
