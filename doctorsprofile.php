
<?php
include("dbconnection.php");
include("header.php");
$query = $pdo->prepare("SELECT doctors.*,users.Email as UEmail,users.password,specialities.name as SpecName from doctors
  JOIN users on users.id = doctors.id
  JOIN specialities on specialities.id = doctors.SpecialityId
  where users.Id=:id");
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
          <a href="editdoctorprofile.php?id=<?php echo $row['Id'] ?>" class="btn btn-primary" style="margin-top:30px">Edit Profile</a>
  </div>
  <div class="col-md-2">
    <div class="form-group">
    <img src="uploading/<?php echo $row['Photo'] ?>" width="130px" height="130px" style="border-radius: 100px;margin-top:-30px" >
    </div>
  </div>

</div>

<div class="form-group">
  <input type="hidden" class="form-control" name="id" value="<?php echo $row['Id'] ?>">
</div>

  <div class="form-group">
    <label for="">Name</label>
    <input type="text" class="form-control" name="name" value="<?php echo $row['Name'] ?>" disabled>
  </div>

  <div class="form-group">
    <label for="">Email</label>
    <input type="text" class="form-control" name="email" value="<?php echo $row['UEmail'] ?>" disabled>
  </div>

  <div class="form-group">
    <label for="">Password</label>
    <input type="text" class="form-control" name="password" value="<?php echo $row['password'] ?>" disabled>
  </div>

  <div class="form-group">
    <label for="">Contact</label>
    <input type="text" class="form-control" name="contact" value="<?php echo $row['Contact'] ?>" disabled>
  </div>

  <div class="form-group">
    <label for="">Speciality</label>
      <input type="text" class="form-control" name="speciality" value="<?php echo $row['SpecName']; ?>" disabled>
  </div>

  <div class="form-group">
    <label for="">Details</label>
    <input type="text" class="form-control" name="speciality" value="<?php echo $row['Details'] ?>" disabled>
  </div>


          </form>

</div>

<?php include("footer.php"); ?>
