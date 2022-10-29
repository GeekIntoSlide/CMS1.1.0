<?php
require_once("db.php");
require_once("function.php");
require_once("session.php");
require_once("time.php");
?>
<?php
$searchQueryParameter=$_GET['id'];
if(isset($_POST['deletePost']))
{
    # code...
    global $connectionDB;
     $sql="DELETE FROM post WHERE id='$searchQueryParameter'";
     $Execute=$connectionDB->query($sql);
     if($Execute)
     {
        $_SESSION['successMessage']="Post Deleted successfully";
        redirectFunction("allpost.php");
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
    <title>Delete Post</title>
</head>
<body>
    <?php
    global $connectionDB;
    $searchQueryParameter=$_GET['id'];
    $sql="SELECT * FROM post WHERE id='$searchQueryParameter'";
    $stmt=$connectionDB->query($sql);
    while($DataRows=$stmt->fetch())
    {
        $title=$DataRows['title'];
        $cat=$DataRows['category'];
        $post=$DataRows['post'];
        $image=$DataRows['image'];
    }
    
    ?>
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
        <h1><i class="fa-sharp fa-solid fa-plus"></i><i class="fa-solid fa-arrows-to-eye"></i>Delete Post</h1>
     </div>
     <?php
     echo errorMessage();
     echo successMessage();
     ?>
     <form action="deletePost.php?id=<?php echo$searchQueryParameter?>" method="post" enctype="multipart/form-data">
     <div class="manage">
        <h1>Delete Post</h1>
        <div class="addCat">
            <p>Post Title:</p>
            <input type="text" placeholder="Type your title" name="postTitle" value="<?php echo $title?>" disabled/>
        </div>
        <div class="addCat">
            <p>Existing Category:<?php echo $cat?> (Select new Category:)</p>
            <select class="drop" name="catDrop" disabled>
               <?php
               global $connectionDB;
               $sql="SELECT * FROM category";
               $stmt=$connectionDB->query($sql);
               while($DataRows=$stmt->fetch())
               {
                $id=$DataRows['id'];
                $title=$DataRows['title'];
               
               
               ?>
               <option><?php echo $title?></option>
               <?php } ?>

            </select>
        </div>
        <div class="addCat">
            <p>Existing Image:</p>
            <img src="upload/<?php echo $image?>" width="170px" height="50px"/>
           </div>
        <div class="addCat">
            <p>Post Content:</p>
            <textarea rows="5" cols="80" name="textArea" disabled ><?php echo $post?></textarea>
        </div>
        <div class="manageBtn">
            <button type="submit"><i class="fa-solid fa-hand-back-point-left"></i><a href="allpost.php">Go to dashboard</a></button>
            <button type="submit" name='deletePost'><i class="fa-solid fa-trash"></i>Delete</button>
        </div>
     </div>
     </form>
</body>
</html>