
<?php

include("dbconnection.php");

$query = $pdo->prepare("Select * from news where Id = :id");
$query->bindparam("id",$_GET['id'],PDO::PARAM_INT); 
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit']))
{

if($_FILES['newscover']['name'] != "")
{
  move_uploaded_file($_FILES['newscover']['tmp_name'],'uploading/'.$_FILES['newscover']['name']);
}

$query = $pdo->prepare("update news SET Title = :title, ShortDiscription=:ShortDiscription,Content=:Content,Author=:Author,NewsCover=:NewsCover where id = :id");
$query->bindparam("id",$_POST['id'],PDO::PARAM_STR);
$query->bindparam("title",$_POST['name'],PDO::PARAM_STR);
$query->bindparam("ShortDiscription",$_POST['contact'],PDO::PARAM_STR);
$query->bindparam("Content",$_POST['details'],PDO::PARAM_STR);
$query->bindparam("Author",$_POST['speciality'],PDO::PARAM_STR);

if($_FILES['NewsCover']['name'] != ""){
$query->bindparam("NewsCover",$_FILES['newscover']['name'],PDO::PARAM_STR);
}
else{
$query->bindparam("NewsCover",$_POST['PhotoLastUploaded'],PDO::PARAM_STR);
}


$query->execute();

header("location: newslist.php");

}

?>


<?php include("header.php"); ?>

<style media="screen">
.label2{
  padding: 10px;
  background: red;
  display: table;
  color: #fff;
   }
.input[type="file"] {
  display: none;
}
</style>

<div class="container">

  <form class="form" action="" method="post" enctype="multipart/form-data">

            <div class="form-group">
              <input type="hidden" name="id" value="<?php echo $row['Id'] ?>">
            </div>

            <div class="form-group">
              <label for="">Title</label>
              <input type="text"class="form-control" name="title"  value="<?php echo $row['Title'] ?>">
           </div>

           <div class="form-group">
             <label for="">Short Discription</label>
             <textarea class="form-control" name="shortdiscription" ><?php echo $row['ShortDiscription'] ?></textarea>
          </div>

          <div class="form-group">
          <label for="">Main Content</label>
          <textarea class="form-control" name="content" rows="8" cols="80"  ><?php echo $row['Content'] ?></textarea>
        </div>

           <div class="form-group">
                 <label for="">Author</label>
                 <input type="text" class="form-control" name="author"  value="<?php echo $row['Author'] ?>">
              </div>

          
          
           <div class="row">
            <div class="col-md-10">
              <div class="form-group">
                <label >Change Image</label>
                <input type="file" class="form-control" name="newscover">
                <input type="hidden" name="PhotoLastUploaded" value="../uploading/<?php echo $row['NewsCover'] ?>">
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
              <img src="uploading/<?php echo $row['NewsCover'] ?>" width="130px" height="130px" style="border-radius:10px;">
              </div>
            </div>

            <div class="form-group">
              <input type="submit" class="btn btn-primary" name="submit" value="Save Changes">
            </div>

          </div>
          </form>

</div>

<?php include("footer.php"); ?>
