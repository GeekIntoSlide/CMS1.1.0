<?php
require_once("db.php");
require_once("function.php");
require_once("session.php");
require_once("time.php");
password_protected();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/63c877e653.js" crossorigin="anonymous"></script>
    <title>All-post</title>
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
        <h1><i class="fa-sharp fa-solid fa-plus"></i><i class="fa-solid fa-arrows-to-eye"></i>Blog-Post</h1>
     </div>
     <div class="panel">
        <div>
            <button><i class="fa-solid fa-pen-to-square"></i><a href="post.php">Add new post</a></button>
        </div>
        <div>
            <button><i class="fa-sharp fa-solid fa-plus"></i><a href="category.php">Add new Category</a></button>
        </div>
        <div>
            <button><i class="fa-sharp fa-solid fa-user-plus"></i> Add new Admin</button>
        </div>
        <div>
            <button><i class="fa-solid fa-check"></i>Approve comment</button>
        </div>
    </div>
     <?php
     echo errorMessage();
     echo successMessage();
     ?>
     <div class="postShow">
     <table width="1000" align="center" border="5">
     <tr>
        <th>ID</th>
        <th>#Title</th>
        <th>Category</th>
        <th>Date&Time</th>
        <th>Banner</th>
        <th>Comments</th>
        <th>Action</th>
        <th>Live preview</th>
     </tr>
     <?php
     global $connectionDB;
     $sql="SELECT * FROM post";
     $stmt=$connectionDB->query($sql);
     while($DataRows=$stmt->fetch())
     {
        $id=$DataRows['id'];
        $title=$DataRows['title'];
        $cat=$DataRows['category'];
        $date=$DataRows['datetime'];
        $img=$DataRows['image'];?>
         <tr>
        <th><?php 
        if(strlen($title)>20)
        {
            $title=substr($title,0,15)."....";
        } 
        ?>
    
            <?php echo $title?></th>
        <th><?php  echo $cat?></th>
        <th><?php echo $date?></th>
        <th><img src="upload/<?php echo $img?>" width="170px" height="50px"/></th>
        <th class="cmt">Comments</th>
        <th class="edit"><button><a href="editPost.php?id=<?php echo $id?>">Edit</a></button> <button><a href="deletePost.php?id=<?php echo $id?>">Delete</a></button></th>
        <th class="lpre">Live preview</th>
     </tr>
     <?php }?>
     </table>
     </div>    
    
</body>
</html>