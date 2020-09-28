<?php

include("dbconnection.php");

if(isset($_POST['submit']))
{
  $sql = "insert into specialities(Name) values(:name)";
  $query = $pdo->prepare($sql);

  $query->bindparam("name",$_POST['name'],PDO::PARAM_STR);
  $query->execute();
  header("location: specialities.php");
}

include("header.php");

?>

<div class="container">

  <form class="form" method="post">

           <div class="form-group">
             <label for="">Speciality Name</label>
             <input type="text" class="form-control" name="name">
           </div>

            <div class="form-group">
              <input type="submit" class="btn btn-primary" name="submit" value="Insert">
            </div>

  </form>

</div>

<?php include("Footer.php"); ?>
