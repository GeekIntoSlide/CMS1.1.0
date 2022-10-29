<?php
require_once("db.php");
require_once("function.php");
require_once("session.php");
require_once("time.php");
$_SESSION['Tracking_Url']=$_SERVER;
?>
<?php
if(isset($_SESSION['UserId']))
{
    redirectFunction("publicbasic.php");
}
if(isset($_POST['loginSubmit']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    if(empty($username)||empty($password))
    {
        $_SESSION['errorMessage']="All filed must be fill";
        redirectFunction("login.php");
    }
    else
    {
       $Found_Account=loginByUser($username,$password);
       if($Found_Account)
       {
        $_SESSION['username']=$Found_Account['name'];
        $_SESSION['successMessage']="Welcome  ".$_SESSION['username'];
        if(isset($_SESSION['Tracking_Url']))
        {
            redirectFunction('category.php');
        }
       }
       else{
        $_SESSION['errorMessage']="Incorrect username and password";
        redirectFunction("login.php");
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
        <h1>B<i class="fa-solid fa-arrows-to-eye"></i>Basic</h1>
     </div>
     <?php
     echo errorMessage();
     echo successMessage();
     
     ?>
     <form method="post" action="login.php">
     <div class="login">
        <div class="login-header">
            <h1>Welcome Back:</h1>
        </div>
       <p>Username:</p>
       <input type="text" placeholder="Username" name="username" value=""/>
       <p>Password:</p>
       <input type="password" name="password" value=""/>
       <input type="submit" name="loginSubmit" value="LogIn"/>

     </div>
     </form>
</body>
</html>