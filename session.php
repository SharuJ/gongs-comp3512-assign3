<?php
// include 'includes/config.php';
// $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// session_start();// Starting Session
// // Storing Session
// $user_check=$_SESSION['userid'];
// // SQL Query To Fetch Complete Information Of User
// $sql="select UserID, UserName, Password, Salt, State, DateJoined, DateLastModified from UsersLogin where UserID='$user_check'";
// $result = $pdo-> query ($sql);
// while ($row = $result->fetch()){
//     $_SESSION['userid']=$row['UserID'];
//     $login_session = $row['UserID'];
// }
// $sql2 = "select UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email from Users";
// $result2 = $pdo-> query($sql2);
// while ($row = $result2->fetch()){
//     $_SESSION['firstname']=$row['FirstName'];
//     $_SESSION['lastname']=$row['LastName'];
//     $_SESSION['email']=$row['Email'];
// }

// if(!isset($login_session)){
//     $pdo = null; // Closing Connection
//     header('Location: login.php'); 
// }
?>
