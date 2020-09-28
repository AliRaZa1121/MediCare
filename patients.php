<?php

include("dbconnection.php");

//Delete Query
$query = $pdo->prepare("delete from patients where Id = :id");
$query->bindparam("id",$_GET['id'],PDO::PARAM_INT); //for doctor
$query->execute();
$query = $pdo->prepare("delete from users where Id = :id");
$query->bindparam("id",$_GET['id'],PDO::PARAM_INT); //for doctor
$query->execute();

$query = $pdo->query("SELECT patients.*,users.email as PEmail from patients JOIN users on users.id = patients.id ORDER BY `patients`.`Name` ASC");
$rows = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("header.php"); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <form class="form" action="" method="post">

            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">PATIENTS</h6>
              </div>
              <hr>

            <div class="card shadow mb-4">

                <div class="table-responsive">
                  <table class="table table-hover table-striped" id="dataTable" width="100%" cellspacing="0">

                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                      </tr>
                    </thead>

                    <tbody>
<?php
if (count($rows)>0) {

foreach ($rows as $row): ?>

    <tr>
      <td><?php echo $row['Name'] ?></td>
      <td><?php echo $row['PEmail'] ?></td>
      <td><?php echo $row['Contact'] ?></td>
      <td>
        <a href="doctors.php?id=<?php echo $row['Id'] ?>" class="btn btn-danger">Delete</a>
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
