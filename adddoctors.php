<?php

include("dbconnection.php");

if(isset($_POST['submit']))
{

move_uploaded_file($_FILES['photo']["tmp_name"],'uploading/'.$_FILES['photo']["name"]);

  $usertypeid = 2;
  $ranpassword = 123;
  $sql = "insert into users(Email,Password,UserTypeId) values(:email,:password,:usertypeid)";
  $query = $pdo->prepare($sql);
  $query->bindparam("email",$_POST['email'],PDO::PARAM_STR);
  $query->bindparam("password",$ranpassword,PDO::PARAM_STR);
  $query->bindparam("usertypeid",$usertypeid,PDO::PARAM_STR);
  $query->execute();
  $id = $pdo->lastInsertId();

  $sql = "insert into doctors(Id,Name,Contact,Details,SpecialityId,CityId,Photo) values(:id,:name,:contact,:details,:speciality,:city,:photo)";
  $query = $pdo->prepare($sql);
  $query->bindparam("id",$id,PDO::PARAM_STR);
  $query->bindparam("name",$_POST['name'],PDO::PARAM_STR);
  $query->bindparam("contact",$_POST['contact'],PDO::PARAM_STR);
  $query->bindparam("details",$_POST['details'],PDO::PARAM_STR);
  $query->bindparam("speciality",$_POST['speciality'],PDO::PARAM_STR);
  $query->bindparam("city",$_POST['city'],PDO::PARAM_STR);
  $query->bindparam("photo",$_FILES['photo']['name'],PDO::PARAM_STR);
  $query->execute();

  header("location: doctors.php");
}

include("header.php");

?>


<div class="container">

  <form class="form" action="" method="post" enctype="multipart/form-data">

            <div class="form-group">
              <label for="">Name</label>
              <input type="text"class="form-control" name="name">
           </div>

           <div class="form-group">
             <label for="">Email</label>
             <input type="email"class="form-control" name="email">
          </div>

           <div class="form-group">
                 <label for="">Contact</label>
                 <input type="number" class="form-control" name="contact">
              </div>


          <div class="form-group">
            <label for="">Speciality</label>
            <select class="form-control" name="speciality">
              <?php
              $query = $pdo->query("Select * from specialities");
              $rows = $query->fetchAll(PDO::FETCH_ASSOC);
              foreach ($rows as $row):
              ?>
                <option value="<?php echo $row['Id'] ?>"><?php echo $row['Name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="">City</label>
            <select class="form-control" name="city">
              <?php
              $query = $pdo->query("Select * from cities");
              $crows = $query->fetchAll(PDO::FETCH_ASSOC);
              foreach ($crows as $crow):
              ?>
                <option value="<?php echo $crow['Id'] ?>"><?php echo $crow['Name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

        <div class="form-group">
          <label for="">Details</label>
          <textarea class="form-control" name="details" rows="8" cols="80"></textarea>
        </div>

        <div class="form-group">
          <label for="">Photo</label>
          <input type="file" class="form-control" name="photo">
       </div>


            <div class="form-group">
              <input type="submit" class="btn btn-primary" name="submit" value="Add Doctor">
            </div>

          </form>

</div>


<?php include("Footer.php"); ?>
