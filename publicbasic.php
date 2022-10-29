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
            <form method="get" action="publicbasic.php">
            <input type="text" placeholder="Search here" name="searchPublic"/>
            <button type="submit" name="searchSubmit" style="margin-right: 5px;">Go</button>
            </form>
        </div>
        </div>
        <?php
        global $connectionDB;
        if(isset($_GET['searchSubmit'])){
        $searchInput=$_GET['searchPublic'];
        $sql="SELECT * FROM post WHERE title LIKE :search OR datetime LIKE :search OR category LIKE :search OR post LIKE :search";
        $stmt=$connectionDB->prepare($sql);
        $stmt->bindValue(':search','%'.$searchInput.'%');
        $stmt->execute();
        }
        else{
        $sql="SELECT * FROM post ORDER by id desc";
        $stmt=$connectionDB->query($sql);    
    }
        
        while($DataRows=$stmt->fetch())
        {
            $id=$DataRows['id'];
            $title=$DataRows['title'];
            $image=$DataRows['image'];
            $time=$DataRows['datetime'];
            $cat=$DataRows['category'];
            $post=$DataRows['post'];?>
            <div class="blogShow">
            <div class="content">
                <div class="topHeading">
                <h3><?php echo "#".$cat?></h3>
                <p><?php echo $time?></p>
                </div>
                <div class="image">
              <img src="upload/<?php echo $image?>" class="blogImage"/>
            </div>
            <div class="topHead">
                    <h1><?php echo $title?></h1>
                </div>
            <p><?php echo $post?></p>
            <div class="exp">
            <div></div>
            <div></div>
            <div>
                <h3><a href="#"><i class="fa-regular fa-comment"></i>Comments</a></h3>
            </div>
            <div>
                <h3><a href="fullPost.php?id=<?php echo $id?>">Read More<i class="fa-solid fa-arrow-right"></i></a></h3>
            </div>
            </div>
            </div>
            <div class="side-content">
                <h1>hello</h1>
            </div>
        </div>
        <?php } ?>
        
        
 
    
</body>
</html>