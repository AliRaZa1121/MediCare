<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add News</title>
</head>
<body>
    
</body>
</html>

<?php

include("dbconnection.php");
include("header.php");

if(isset($_POST['submit']))
{

move_uploaded_file($_FILES['photo']["tmp_name"],'uploading/'.$_FILES['photo']["name"]);


  $sql = "insert into news(Title,ShortDiscription,Content,Author,PublishedOn,NewsCover) values(:title,:shortdiscription,:content,:author,:publishedon,:newscover)";
  
  $query = $pdo->prepare($sql);
  $query->bindparam("title",$_POST['title'],PDO::PARAM_STR);
  $query->bindparam("shortdiscription",$_POST['shortdiscription'],PDO::PARAM_STR);
  $query->bindparam("content",$_POST['content'],PDO::PARAM_STR);
  $query->bindparam("author",$_POST['author'],PDO::PARAM_STR);
  $query->bindparam("publishedon",$_POST['publishedon'],PDO::PARAM_STR);
  $query->bindparam("newscover",$_FILES['photo']['name'],PDO::PARAM_STR);
  $query->execute();


header("location: newslist.php");

}


?>


<div class="container">

  <form class="form" action="" method="post" enctype="multipart/form-data">

            <div class="form-group">
              <label for="">Title</label>
              <input type="text"class="form-control" name="title">
           </div>

           <div class="form-group">
             <label for="">Short Discription</label>
             <textarea class="form-control" name="shortdiscription"></textarea>
          </div>

          <div class="form-group">
          <label for="">Main Content</label>
          <textarea class="form-control" name="content" rows="8" cols="80"></textarea>
        </div>

           <div class="form-group">
                 <label for="">Author</label>
                 <input type="text" class="form-control" name="author">
              </div>

              <div class="form-group">
                 <label for="">publishedon</label>
                 <input type="date" class="form-control" name="publishedon">
              </div>

          
          
        

        <div class="form-group">
          <label for="">Photo</label>
          <input type="file" class="form-control" name="photo">
       </div>


            <div class="form-group">
              <input type="submit" class="btn btn-primary" name="submit" value="Add News">
            </div>

          </form>

</div>


<?php include("Footer.php"); ?>
