<?php

include("dbconnection.php");
include("header.php");

//Delete Query
$query = $pdo->prepare("delete from doctoravailability where Id = :id");
$query->bindparam("id",$_GET['id'],PDO::PARAM_INT); //for doctor
$query->execute();

$query = $pdo->prepare("SELECT * from doctoravailability where doctoravailability.DoctorId =:id");
$suid = $_SESSION['id'];
$query->bindparam("id",$suid,PDO::PARAM_INT);
$query->execute();
$rows = $query->fetchAll(PDO::FETCH_ASSOC);

?>



        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <form class="form" method="post">

            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Availability Status</h6>
              </div>

            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <a href="addavailability.php" class="btn btn-primary">Add Availability</a>
              </div>

                <div class="table-responsive">
                  <table class="table table-hover table-striped" id="dataTable" width="100%" cellspacing="0">

                    <thead>
                      <tr>
                        <th>Day</th>
                        <th>From Time</th>
                        <th>End Time</th>
                      </tr>
                    </thead>

                    <tbody>
<?php
if (count($rows)>0) {

foreach ($rows as $row): ?>

    <tr>
      <td><?php echo $row['Day'] ?></td>
      <td><?php echo $row['FromTime'] ?></td>
      <td><?php echo $row['EndTime'] ?></td>
      <td>
        <a href="editavailability.php?id=<?php echo $row['Id'] ?>" class="btn btn-primary">Edit</a>
        <a href="manageavailability.php?id=<?php echo $row['Id'] ?>" class="btn btn-danger">Delete</a>
      </td>
    </tr>

  <?php endforeach; ?>

<?php }

else { ?>
  <tr>
    <th colspan="4" class="alert-danger text-center" >No Result Found</th>
  </tr>
<?php } ?>

                    </tbody>
                  </table>

              </div>
            </div>

        </div>
        <!-- /.container-fluid -->

<?php include("footer.php"); ?>
