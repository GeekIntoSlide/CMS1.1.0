<?php
require_once("db.php");
require_once("function.php");
require_once("session.php");
require_once("time.php");
?>
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
        <h1>D<i class="fa-solid fa-arrows-to-eye"></i>Dashboard</h1>
     </div>
     <div class="insight">
       <div class="side-insight">
        <div class="insight-tag">
            <h3>Posts</h3>
            <h2><i class="fa-solid fa-book-open-reader"></i><?php totalPost()?></h2>
        </div>
        <div class="insight-tag">
            <h3>category</h3>
            <h2><i class="fa-solid fa-folder"></i><?php totalCategory()?></h2>
        </div>
        <div class="insight-tag">
            <h3>Admin</h3>
            <h2><i class="fa-solid fa-user"></i><?php totalAdmin()?></h2>
        </div>
        <div class="insight-tag">
            <h3>Comments</h3>
            <h2><i class="fa-solid fa-comment"></i><?php totalComment()?></h2>
        </div>
       </div>
     </div>
     <div class="postShow">
     <table width="1000" align="center" border="5">
     <tr>
        <th>ID</th>
        <th>#Title</th>
        <th>Category</th>
        <th>Date&Time</th>
     </tr>
     <?php
     global $connectionDB;
     $srno=0;
     $sql="SELECT * FROM post";
     $stmt=$connectionDB->query($sql);
     while($DataRows=$stmt->fetch())
     {
        $id=$DataRows['id'];
        $title=$DataRows['title'];
        $cat=$DataRows['category'];
        $date=$DataRows['datetime'];
        $srno++;
        ?>
         <tr>
       <th><?php echo $srno?></th>
        <th><?php echo $title?></th>
        <th><?php  echo $cat?></th>
        <th><?php echo $date?></th>
     </tr>
     <?php }?>
     </table>
     </div>    
</body>
</html>