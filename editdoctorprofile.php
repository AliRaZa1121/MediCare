
<?php

include("dbconnection.php");

$query = $pdo->prepare("SELECT doctors.*,users.* from doctors JOIN users on users.id = doctors.id where doctors.id = :id");
$query->bindparam("id",$_GET['id'],PDO::PARAM_INT); //for doctor
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);



if(isset($_POST['submit']))
{
  if($_FILES['photo']['name'] != "")
  {
    move_uploaded_file($_FILES['photo']['tmp_name'],'uploading/'.$_FILES['photo']['name']);
  }

  $query = $pdo->prepare("update doctors SET Name = :name,Contact=:contact,Details=:details,SpecialityId=:speciality,Photo=:photo where id = :id");
  $query->bindparam("id",$_POST['id'],PDO::PARAM_STR);
  $query->bindparam("name",$_POST['name'],PDO::PARAM_STR);
  $query->bindparam("contact",$_POST['contact'],PDO::PARAM_STR);
  $query->bindparam("details",$_POST['details'],PDO::PARAM_STR);
  $query->bindparam("speciality",$_POST['speciality'],PDO::PARAM_STR);


  session_start();
  unset($_SESSION['name']);//remove $_SESSION['name']
  unset($_SESSION['photo']);//remove $_SESSION['name']
  session_regenerate_id();//Copies all other session variables on to new id
  $_SESSION["name"] = $_POST['name'];//Create new session variable 'name'.

  if($_FILES['photo']['name'] != ""){
    $query->bindparam("photo",$_FILES['photo']['name'],PDO::PARAM_STR);
    $_SESSION['photo'] = $_FILES['photo']['name'];
  }
  else{
    $query->bindparam("photo",$_POST['PhotoLastUploaded'],PDO::PARAM_STR);
    $_SESSION['photo'] = $_POST['PhotoLastUploaded'];
  }

  session_write_close();

  #$_SESSION['name'] = $_POST['Name'];




  $query->execute();

  $query = $pdo->prepare("update users SET Email=:email,Password=:password where id = :id");
  $query->bindparam("id",$_POST['id'],PDO::PARAM_INT);
  $query->bindparam("email",$_POST['email'],PDO::PARAM_STR);
  $query->bindparam("password",$_POST['password'],PDO::PARAM_STR);
  $query->execute();

  header("location: doctorsprofile.php");

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
              <label for="">Name</label>
              <input type="text" class="form-control" name="name" value="<?php echo $row['Name'] ?>">
            </div>

            <div class="form-group">
              <label for="">Email</label>
              <input type="text" class="form-control" name="email" value="<?php echo $row['Email'] ?>">
            </div>

            <div class="form-group">
              <label for="">Password</label>
              <input type="text" class="form-control" name="password" value="<?php echo $row['Password'] ?>">
            </div>

            <div class="form-group">
              <label for="">Contact</label>
              <input type="text" class="form-control" name="contact" value="<?php echo $row['Contact'] ?>">
            </div>

            <div class="form-group">
              <label for="">Speciality</label>
              <select class="form-control" name="speciality">
              <?php
      				 $query = $pdo->query("select * from specialities");
      		 	 	 $records = $query->fetchAll(PDO::FETCH_ASSOC);
      		 	 	 foreach ($records as $item) {
      		 	 	 	$s = "";
      		 	 	 	if ($row['SpecialityId'] == $item['Id']) {
      		 	 	 		$s = ' selected ';
      		 	 	 	}
      		 	 	 	?>
      		 	 	 		<option <?php echo $s ?> value='<?php echo $item['Id']; ?>'><?php echo $item['Name']; ?></option>
      		 	 	 	<?php
      		 	 	 	}
      		 	 	 ?>
              </select>
          </div>

            <div class="form-group">
              <label for="">Details</label>
              <textarea class="form-control" name="details" rows="8" cols="80"><?php echo $row['Details'] ?></textarea>
            </div>

          <div class="row">

            <div class="col-md-10">
              <div class="form-group">
                <label >Change Image</label>
                <input type="file" class="form-control" name="photo">
                <input type="hidden" name="PhotoLastUploaded" value="<?php echo $row['Photo'] ?>">
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label><b>Last Uploaded:</b></label>
              <img src="uploading/<?php echo $row['Photo'] ?>" width="120px" height="120px" style="border-radius:100px;">
              </div>
            </div>

          </div>

          <div class="form-group mt-10">
            <input type="submit" class="btn btn-primary" name="submit" value="Save Changes">
          </div>

          </form>



</div>

<?php include("footer.php"); ?>
