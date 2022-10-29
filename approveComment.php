<?php
require_once("db.php");
require_once("function.php");
require_once("session.php");
require_once("time.php");


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
     <div class="postShow">
     <table width="1000" align="center" border="5">
     <tr>
        <th>S.NO</th>
        <th>Name</th>
        <th>Comment</th>
        <th>email</th>
        <th>Approve</th>
        <th>Disapprove</th>
        <th>Delete</th>
        <th>Status</th>
        <th>Live preview</th>
     </tr>
     <?php
    global $connectionDB;
    $sql="SELECT * FROM comment";
    $Execute=$connectionDB->query($sql);
    $srno=0;
    while($DataRows=$Execute->fetch())
    {
      $commentid=$DataRows['id'];
      $name=$DataRows['name'];
      $comment=$DataRows['comment'];
      $email=$DataRows['email'];
      $status=$DataRows['status'];
      $srno++;?>
      
      <tr>
        <th><?php echo $srno?></th>
        <th><?php echo $name?></th>
        <th><?php echo $comment?></th>
        <th><?php echo $email?></th>
        <th><a href="approveCmt.php?id=<?php echo $commentid?>">Approve</a></th>
        <th><a href="disApprove.php?id=<?php echo $commentid?>">Disapprove</th>
        <th><a href="deleteCmt.php?id=<?php echo $commentid?>">Delete</a></th>
        <th><?php echo $status?></th>
        <th><a>LivePreview</a></th>
      </tr>
    
    <?php }?>
     
     
     </table>
</body>
</html>