
<?php

include("dbconnection.php");

$query = $pdo->prepare("SELECT * from doctoravailability where id = :id");
$query->bindparam("id",$_GET['id'],PDO::PARAM_INT); //for doctor
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['submit']))
{
  $query = $pdo->prepare("UPDATE doctoravailability SET FromTime=:fromtime, EndTime=:endtime, Day=:day where id = :id");
  $query->bindparam("fromtime",$_POST['fromtime'],PDO::PARAM_STR);
  $query->bindparam("endtime",$_POST['endtime'],PDO::PARAM_STR);
  $query->bindparam("day",$_POST['day'],PDO::PARAM_STR);
  $query->bindparam("id",$_GET['id'],PDO::PARAM_INT);
  $query->execute();

  header("location: manageavailability.php");
}



?>


<?php include("header.php"); ?>

<div class="container">

  <form class="form" action="" method="post" enctype="multipart/form-data">

            <div class="form-group">
              <input type="hidden" name="id" value="<?php echo $row['Id'] ?>">
            </div>

            <div class="form-group">
              <label for="">Day</label>
              <select class="form-control" name="day">
                <option>Monday</option>
                <option>Tuesday</option>
                <option>Wednesday</option>
                <option>Thursday</option>
                <option>Friday</option>
                <option>Saturday</option>
                <option>Sunday</option>
              </select>
            </div>

            <div class="form-group">
              <label for="">From Time</label>
              <input type="time" class="form-control" name="fromtime" value="<?php echo $row['FromTime'] ?>">
            </div>

            <div class="form-group">
              <label for="">End Time</label>
              <input type="time" class="form-control" name="endtime" value="<?php echo $row['EndTime'] ?>">
            </div>

            <div class="form-group">
              <input type="submit" class="btn btn-primary" name="submit" value="Save Changes">
            </div>

        
          </form>

</div>

<?php include("footer.php"); ?>
