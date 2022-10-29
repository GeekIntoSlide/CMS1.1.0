<?php
require_once("db.php");
require_once("function.php");
require_once("session.php");
require_once("time.php");
$searchQueryInput=$_GET['id'];
?>

<?php
if(isset($_POST['commentSubmit']))
{
    if(empty($_POST['fullName']) ||empty($_POST['email']) ||empty($_POST['commentText']))
    {
        $_SESSION['errorMessage']="All field must be fill";
    }
    elseif (strlen($_POST['commentText'])>10000) {
        # code...
        $_SESSION['errorMessage']="Comment must be less than 10000 words";
    }
    else{
        global $connectionDB;
        $sql="INSERT INTO comment (name,email,comment,approveBy,status,post_id)";
        $sql.="VALUES(:namE,:emaiL,:commenT,'pending','OFF',:postByUrl)";
        $stmt=$connectionDB->prepare($sql);
        $stmt->bindValue(':namE',$_POST['fullName']);
        $stmt->bindValue(':emaiL',$_POST['email']);
        $stmt->bindValue(':commenT',$_POST['commentText']);
        $stmt->bindValue(':postByUrl',$searchQueryInput); 
        $Execute=$stmt->execute();
        if($Execute)
        {
            $_SESSION['successMessage']="Comment added successfully";
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
           
        </div>
        </div>
        <?php
       
        global $connectionDB;
        $sql="SELECT * FROM post WHERE id='$searchQueryInput'";
        $stmt=$connectionDB->query($sql);    
    
        
        while($DataRows=$stmt->fetch())
        {
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
            <?php
            echo errorMessage();
           echo successMessage();
              ?>
             <form action="fullPost.php?id=<?php echo$searchQueryInput?>" method="post" enctype="">
                <div class="comment">
                    <p>Full Name</p>
                    <input type="text" placeholder="Enter your full name" name="fullName"/>
                    <p>Email</p>
                    <input type="email" placeholder="Enter your correct Email" name="email"/>
                    <p>Your thougth about this post </p>
                    <textarea rows="5" cols="100" name="commentText"></textarea>
                    <button type="submit" name="commentSubmit">Submit</button>
                </div>
             </form>
             <div class="fetch">
                <?php
                global $connectionDB;
                $sql="SELECT * FROM comment WHERE post_id='$searchQueryInput' AND status='ON'";
                $stmt=$connectionDB->query($sql);
                while($DataRows=$stmt->fetch())
                {
                  $name=$DataRows['name'];
                  $comment=$DataRows['comment'];
                ?>
                <h1><?php echo $name?></h1>
                <p><?php echo $comment?></p>
                <?php }?>
             </div>
            </div>
            <div class="side-content">
                <h1>hello</h1>
            </div>
        </div>
        <?php } ?>
        
        
 
    
</body>
</html>