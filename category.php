<?php
require_once("db.php");
require_once("function.php");
require_once("session.php");
require_once("time.php");
// password_protected();
?>
<?php
if(isset($_POST['Submit']))
{
    $author="Kuldeep";
    $currentTime=time();
    $time=strftime("%Y-%m-%d %H:%M:%S",$currentTime);

    if(empty($_POST['catTitle']))
    {
      $_SESSION['errorMessage']="All field must be fill";
       
      redirectFunction("category.php");
    }elseif(strlen($_POST['catTitle'])<3)
    {
        $_SESSION['errorMessage']="Title must be larger than 3 char ";
        redirectFunction("category.php");
    }elseif(strlen($_POST['catTitle'])>49)
    {
        $_SESSION['errorMessage']="Title length must be smaller than 49 char";
        redirectFunction("category.php");
    }
    else{
        $sql="INSERT INTO category(title,author,datetime)";
        $sql.="VALUES(:titlE,:authoR,:datetime)";
        $stmt=$connectionDB->prepare($sql);
        $stmt->bindValue(':titlE',$_POST['catTitle']);
        $stmt->bindValue(':authoR',$author);
        $stmt->bindValue(':datetime',$time);
        $Execute=$stmt->execute();
        if($Execute)
        {
            $_SESSION['successMessage']="Post upload successfully";
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
            <p><i class="fa-solid fa-right-from-bracket"></i><a href="logout.php">Logout</a></p>
        </div>
        </div>
 
     <div class="header">
        <h1><i class="fa-solid fa-pen-to-square"></i><i class="fa-solid fa-arrows-to-eye"></i>Category</h1>
     </div>
     <?php
     echo errorMessage();
     echo successMessage();
     ?>
     <form action="category.php" method="post">
     <div class="manage">
        <h1>Add New Category</h1>
        <div class="addCat">
            <p>Category Title:</p>
            <input type="text" placeholder="Type your title" name="catTitle"/>
        </div>
        <div class="manageBtn">
            <button type="submit"><i class="fa-solid fa-hand-back-point-left"></i>Go to dashboard</button>
            <button type="submit" name='Submit'><i class="fa-solid fa-check"></i>ADD</button>
        </div>
     </div>
     </form>
     <div class="postShow">
     <table width="1000" align="center" border="5">
     <tr>
        <th>S.NO</th>
        <th>Date</th>
        <th>category</th>
        <th>Delete</th>
     </tr>
     <?php
    global $connectionDB;
    $sql="SELECT * FROM category";
    $Execute=$connectionDB->query($sql);
    $srno=0;
    while($DataRows=$Execute->fetch())
    {
        $id=$DataRows['id'];
      $date=$DataRows['datetime'];
      $category=$DataRows['title'];
      $srno++;?>
      
      <tr>
        <th><?php echo $srno?></th>
        <th><?php echo $date?></th>
        <th><?php echo $category?></th>
        <th><a href="deleteCat.php?id=<?php echo $id?>">Delete</a></th>
      </tr>
    
    <?php }?>
     
     
     </table>
     </div>
</body>
</html>