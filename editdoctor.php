
<?php

include("dbconnection.php");

$query = $pdo->prepare("SELECT doctors.*,cities.Name as CityName,users.email as UEmail,specialities.Name as SpecName  from doctors
  JOIN users on users.id = doctors.id
  JOIN cities ON doctors.CityId = cities.Id
  JOIN specialities on specialities.id = doctors.SpecialityId where doctors.id = :id");
$query->bindparam("id",$_GET['id'],PDO::PARAM_INT); //for doctor
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit']))
{

if($_FILES['photo']['name'] != "")
{
  move_uploaded_file($_FILES['photo']['tmp_name'],'uploading/'.$_FILES['photo']['name']);
}

$query = $pdo->prepare("update doctors SET Name = :name,Contact=:contact,Details=:details,SpecialityId=:speciality,CityId=:city,Photo=:photo where id = :id");
$query->bindparam("id",$_POST['id'],PDO::PARAM_STR);
$query->bindparam("name",$_POST['name'],PDO::PARAM_STR);
$query->bindparam("contact",$_POST['contact'],PDO::PARAM_STR);
$query->bindparam("details",$_POST['details'],PDO::PARAM_STR);
$query->bindparam("speciality",$_POST['speciality'],PDO::PARAM_STR);
$query->bindparam("city",$_POST['city'],PDO::PARAM_STR);

if($_FILES['photo']['name'] != ""){
$query->bindparam("photo",$_FILES['photo']['name'],PDO::PARAM_STR);
}
else{
$query->bindparam("photo",$_POST['PhotoLastUploaded'],PDO::PARAM_STR);
}


$query->execute();


$query = $pdo->prepare("update users SET Email=:email where id = :id");
$query->bindparam("id",$_POST['id'],PDO::PARAM_INT);
$query->bindparam("email",$_POST['email'],PDO::PARAM_STR);
$query->execute();

header("location: doctors.php");

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
              <label for="">Name</label>
              <input type="text" class="form-control" name="name" value="<?php echo $row['Name'] ?>">
            </div>

            <div class="form-group">
              <label for="">Email</label>
              <input type="text" class="form-control" name="email" value="<?php echo $row['UEmail'] ?>">
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
      		 	 	 	$k = "";
      		 	 	 	if ($row['SpecialityId'] == $item['Id']) {
      		 	 	 		$k = ' selected ';
      		 	 	 	}
      		 	 	 	?>
      		 	 	 		<option <?php echo $k ?> value='<?php echo $item['Id']; ?>'><?php echo $item['Name']; ?></option>
      		 	 	 	<?php
      		 	 	 	}
      		 	 	 ?>
              </select>
          </div>

          <div class="form-group">
            <label for="">City</label>
            <select class="form-control" name="city">
            <?php
             $query = $pdo->query("select * from cities");
             $crecords = $query->fetchAll(PDO::FETCH_ASSOC);
             foreach ($crecords as $citem) {
              $s = "";
              if ($row['CityId'] == $citem['Id']) {
                $s = ' selected ';
              }
              ?>
                <option <?php echo $s ?> value='<?php echo $citem['Id']; ?>'><?php echo $citem['Name']; ?></option>
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
                <input type="hidden" name="PhotoLastUploaded" value="../uploading/<?php echo $row['Photo'] ?>">
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
              <img src="uploading/<?php echo $row['Photo'] ?>" width="130px" height="130px" style="border-radius:100px;border:2px solid #4e73df;">
              </div>
            </div>

            <div class="form-group">
              <input type="submit" class="btn btn-primary" name="submit" value="Save Changes">
            </div>

          </div>
          </form>

</div>

<?php include("footer.php"); ?>
