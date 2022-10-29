<?php
require_once("db.php");
require_once("function.php");
require_once("session.php");
require_once("time.php");
?>
<?php
$searchQueryParameter=$_GET['id'];
if(isset($_POST['updatePost']))
{
    $postTitle=$_POST['postTitle'];
    $postCat=$_POST['catDrop'];
    $post=$_POST['textArea'];
    $Image=$_FILES["Image"]["name"];
    $target="upload/".basename($_FILES["Image"]["name"]);
    $currentTime=time();
    $time=strftime("%Y-%m-%d %H:%M:%S",$currentTime);
  if(empty($postTitle)||empty($postCat)||empty($post))
  {
    $_SESSION['errorMessage']="All filed must be fill";
    redirectFunction("post.php");
  }elseif (strlen($_POST['textArea'])>1000) {
    # code...
    $_SESSION['errorMessage']="Please upload post less than 1000 words ";
    redirectFunction("post.php");
  }
  else {
    # code...
    global $connectionDB;
     $sql="UPDATE post SET title='$postTitle', post='$post', category='$postCat', image='$Image' 
     WHERE id='$searchQueryParameter' ";
     $Execute=$connectionDB->query($sql);
    move_uploaded_file($_FILES["Image"]["tmp_name"],$target);

    $_SESSION['successMessage']="Post upload successfully";
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
        <h1><i class="fa-sharp fa-solid fa-plus"></i><i class="fa-solid fa-arrows-to-eye"></i>Post</h1>
     </div>
     <?php
     echo errorMessage();
     echo successMessage();
     ?>
     <form action="editPost.php?id=<?php echo$searchQueryParameter?>" method="post" enctype="multipart/form-data">
     <div class="manage">
        <h1>Edit Post</h1>
        <div class="addCat">
            <p>Post Title:</p>
            <input type="text" placeholder="Type your title" name="postTitle" value="<?php echo $title?>"/>
        </div>
        <div class="addCat">
            <p>Existing Category:<?php echo $cat?> (Select new Category:)</p>
            <select class="drop" name="catDrop">
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

            <p>Select new Image:</p>
            <input type="file" placeholder="Select from device" name="Image" />
        </div>
        <div class="addCat">
            <p>Post Content:</p>
            <textarea rows="5" cols="80" name="textArea" ><?php echo $post?></textarea>
        </div>
        <div class="manageBtn">
            <button type="submit"><i class="fa-solid fa-hand-back-point-left"></i>Go to dashboard</button>
            <button type="submit" name='updatePost'><i class="fa-solid fa-check"></i>Update</button>
        </div>
     </div>
     </form>
</body>
</html>