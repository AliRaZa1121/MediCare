
<?php

include("dbconnection.php");

$query = $pdo->prepare("SELECT * from users where Id = :id");
$query->bindparam("id",$_GET['id'],PDO::PARAM_INT); //for doctor
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);



if(isset($_POST['submit']))
{
  $query = $pdo->prepare("update users SET Email=:email,Password=:password where id = :id");
  $query->bindparam("id",$_POST['id'],PDO::PARAM_INT);
  $query->bindparam("email",$_POST['email'],PDO::PARAM_STR);
  $query->bindparam("password",$_POST['password'],PDO::PARAM_STR);
  $query->execute();

  header("location: adminprofile.php");

}

include("header.php");

?>

<div class="container">
<h2 class="m-0 font-weight-bold text-primary">Edit Profile</h2>

  <form class="form" action="" method="post" enctype="multipart/form-data">

            <div class="form-group">
              <input type="hidden" name="id" value="<?php echo $row['Id'] ?>">
            </div>

            <div class="form-group">
              <label for="">Email</label>
              <input type="text" class="form-control" name="email" value="<?php echo $row['Email'] ?>">
            </div>

            <div class="form-group">
              <label for="">Password</label>
              <input type="text" class="form-control" name="password" value="<?php echo $row['Password'] ?>">
            </div>


          <div class="form-group mt-10">
            <input type="submit" class="btn btn-primary" name="submit" value="Save Changes">
          </div>

          </form>



</div>

<?php include("footer.php"); ?>
