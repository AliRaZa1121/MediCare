
<?php
include("dbconnection.php");
include("header.php");
$query = $pdo->prepare("SELECT * from users
  where Id=:id");
  //session_start();
  $sid=$_SESSION['id'];
  $query->bindparam("id",$sid,PDO::PARAM_INT);
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);

?>

<div class="container">

  <form class="form">


        <h2 class="m-0 font-weight-bold text-primary">My Profile</h2>


<div class="row">
  <div class="col-md-10" >
          <a href="editadminprofile.php?id=<?php echo $row['Id'] ?>" class="btn btn-primary" style="margin-top:30px">Edit Profile</a>
  </div>
  <div class="col-md-2">
    <div class="form-group">
    <img src="uploading/admin.png" width="130px" height="130px" style="border-radius: 100px;margin-top:-30px" >
    </div>
  </div>

</div>


<div class="form-group">
  <input type="hidden" class="form-control" name="id" value="<?php echo $row['Id'] ?>">
</div>

  

  <div class="form-group">
    <label for="">Email</label>
    <input type="text" class="form-control" name="email" value="<?php echo $row['Email'] ?>" disabled>
  </div>

  <div class="form-group">
    <label for="">Password</label>
    <input type="text" class="form-control" name="password" value="<?php echo $row['Password'] ?>" disabled>
  </div>


          </form>

</div>

<?php include("footer.php"); ?>
