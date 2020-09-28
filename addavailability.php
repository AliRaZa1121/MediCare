<?php

include("dbconnection.php");

if(isset($_POST['submit']))
{
  $sql = "insert into doctoravailability(Day,FromTime,EndTime,DoctorId) values(:day,:fromtime,:endtime,:doctorid)";
  $query = $pdo->prepare($sql);

  session_start();
  $dsid = $_SESSION['id'];
  $query->bindparam("day",$_POST['day'],PDO::PARAM_STR);
  $query->bindparam("fromtime",$_POST['fromtime'],PDO::PARAM_STR);
  $query->bindparam("endtime",$_POST['endtime'],PDO::PARAM_STR);
  $query->bindparam("doctorid",$dsid,PDO::PARAM_STR);
  $query->execute();
  header("location: manageavailability.php");
}

include("header.php");

?>

<div class="container">

  <form class="form" method="post">

            <div class="form-group">
              <label for="">Day</label>
              <select class="form-control" name="day">
                <option disabled selected style="color:grey;font-weight:bold">Select Day</option>
                <option>Mon</option>
                <option>Tue</option>
                <option>Wed</option>
                <option>Thu</option>
                <option>Fri</option>
                <option>Sat</option>
                <option>Sun</option>
              </select>
            </div>

           <div class="form-group">
             <label for="">From Time</label>
             <input type="time" class="form-control" name="fromtime">
           </div>

           <div class="form-group">
             <label for="">End Time</label>
             <input type="time" class="form-control" name="endtime">
           </div>

            <div class="form-group">
              <input type="submit" class="btn btn-primary" name="submit" value="Insert">
            </div>

  </form>

</div>

<?php include("Footer.php"); ?>
