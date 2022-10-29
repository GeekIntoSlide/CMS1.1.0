<?php
require_once("db.php");
require_once("function.php");
require_once("session.php");
require_once("time.php");
?>
<?php

if(isset($_POST['addAdmin']))
{
    $username=$_POST['username'];
    $name=$_POST['adminName'];
$password=$_POST['password'];
$confirmPassword=$_POST['confirmPassword'];
    if($password!=$confirmPassword)
    {
        $_SESSION['errorMessage']="Password and confirm password must be match";
        redirectFunction("manageAdmin.php");
    }
    elseif (empty($name)||empty($password)||empty($confirmPassword)) {
        # code...
        $_SESSION['errorMessage']="All field must be filled";
    }
    elseif (userExistOrNot($username)) {
        # code...
        $_SESSION['errorMessage']="user name already exist";
        redirectFunction("manageAdmin.php");
        
    }
    else{
        global $connectionDB;
        $sql="INSERT INTO manageAdmin(name,username,password)";
        $sql.="VALUES(:namE,:usernamE,:passworD)";
        $stmt=$connectionDB->prepare($sql);
        $stmt->bindValue(':namE',$name);
        $stmt->bindValue(':usernamE',$username);
        $stmt->bindValue(':passworD',$password);
        $Execute=$stmt->execute();
        if($Execute)
        {
            $_SESSION['successMessage']= " Admin added successfully";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/63c877e653.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <h1>Globe.com</h1>
        </div>
        <div class="navItems">
            <ul>
                <li><i class="fa-regular fa-user"></i>My Profile</li>
                <li>Dashboard</li>
                <li>Category</li>
                <li>Blogs</li>
                <li>Manage Admin</li>
                <li>Comments</li>
                <li>Live Blog</li>
            </ul>
        </div>
        <div class="status">
            <p><i class="fa-solid fa-right-from-bracket"></i>Logout</p>
        </div>
        </div>
 
     <div class="header">
        <h1><i class="fa-solid fa-pen-to-square"></i><i class="fa-solid fa-arrows-to-eye"></i>Manage Admin</h1>
     </div>
     <?php
     echo errorMessage();
     echo successMessage();
     ?>
     <form action="manageAdmin.php" method="post">
     <div class="manage">
        <h1>Add new admin</h1>
        <div class="addCat">
            <p>Username:</p>
            <input type="text" placeholder="Type your username" name="username"/>
            <p>Name:</p>
            <input type="text"  name="adminName"/>
            <p>Password:</p>
            <input type="password" name="password"/>
            <p>Confirm Password:</p>
            <input type="password" name="confirmPassword"/>
        </div>
        <div class="manageBtn">
            <button type="submit"><i class="fa-solid fa-hand-back-point-left"></i>Go to dashboard</button>
            <button type="submit" name='addAdmin'><i class="fa-solid fa-check"></i>ADD Admin</button>
        </div>
     </div>
     </form>
</body>
</html>