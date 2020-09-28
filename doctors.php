<?php

include("dbconnection.php");

//Delete Query
$query = $pdo->prepare("delete from doctors where Id = :id");
$query->bindparam("id",$_GET['id'],PDO::PARAM_INT); //for doctor
$query->execute();
$query = $pdo->prepare("delete from users where Id = :id");
$query->bindparam("id",$_GET['id'],PDO::PARAM_INT); //for doctor
$query->execute();

$query = $pdo->query("SELECT doctors.*,cities.Name as CityName,users.email as UEmail,specialities.Name as SpecName  from doctors
  JOIN users on users.id = doctors.id
  JOIN cities ON doctors.CityId = cities.Id
  JOIN specialities on specialities.id = doctors.SpecialityId");
$rows = $query->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctors</title>
  
</head>


<?php include("header.php"); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <form class="form" action="" method="post">

            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DOCTORS</h6>
              </div>

            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <a href="adddoctors.php" class="btn btn-primary">Add New </a>
              </div>
<hr>
                <div class="table-responsive">
                  <table class="table table-hover table-striped" id="dataTable" width="100%" cellspacing="0">

                    <thead>
                      <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Speciality</th>
                        <th>City</th>
                        <th>Details</th>
                        <th class="text-center">Actions</th>
                      </tr>
                    </thead>

                    <tbody>
<?php
if (count($rows)>0) {

foreach ($rows as $row): ?>

    <tr>
      <td><img src="uploading/<?php echo $row['Photo'] ?>" width="80px" height="80px" style="border-radius:100px" ></td>
      <td><?php echo $row['Name'] ?></td>
      <td><?php echo $row['UEmail'] ?></td>
      <td><?php echo $row['Contact'] ?></td>
      <td><?php echo $row['SpecName'] ?></td>
      <td><?php echo $row['CityName'] ?></td>
      <td><?php echo $row['Details'] ?></td>
      <td>
        <a href="editdoctor.php?id=<?php echo $row['Id'] ?>" class="btn btn-primary">Edit</a>
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
        
        



        </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>


  <!-- Core plugin JavaScript-->
  <script src="Backend/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="Backend/sjs/sb-admin-2.min.js"></script>

</body>

</html>
