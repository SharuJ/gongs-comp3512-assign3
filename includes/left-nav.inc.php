// <?php
// function dispUN(){
// try{
//     $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $un = $_POST['username'];
//     $query = "Select * from Users where UserName='$un'";
//     $result = $pdo-> query ($query);
//     $row = $result->fetch();
//     echo ($row['UserName']);
//     $pdo = null; // Closing Connection
// }
// catch (PDOException $e)
//         {
//             die($e->getMessage());
//         }
// }

// ?>

<div class="mdl-layout__drawer mdl-color--blue-grey-800 mdl-color-text--blue-grey-50" id="lightPeriwinkle">
   <div class="profile" id="midnightBlue">
       <img src="images/profile.jpg" class="avatar">
       <h4> Gongs</h4>           
       <span>rconnolly@mtroyal.ca</span>
   </div>

<nav class="mdl-navigation mdl-color-text--black" id="lightPeriwinkle">
    <a class="mdl-navigation__link mdl-color-text--black" href="profile.php"><i class="material-icons" role="presentation">account_box</i> User Profile</a>
    <a class="mdl-navigation__link mdl-color-text--black" href="index.php"><i class="material-icons" role="presentation">dashboard</i> Dashboard</a>
    <a class="mdl-navigation__link mdl-color-text--black" href="browse-employees.php"><i class="material-icons" role="presentation">group</i> Employees</a>
    <a class="mdl-navigation__link mdl-color-text--black" href="browse-books.php"><i class="material-icons" role="presentation">view_list</i> Books</a>
    <a class="mdl-navigation__link mdl-color-text--black" href="browse-universities.php"><i class="material-icons" role="presentation">account_balance</i> Universities</a>
    <a class="mdl-navigation__link mdl-color-text--black" href="analytics.php"><i class="material-icons" role="presentation">poll</i> Analytics</a>
    <a class="mdl-navigation__link mdl-color-text--black" href="aboutus.php"><i class="material-icons" role="presentation">announcement</i> About</a>                       
</nav>
</div>