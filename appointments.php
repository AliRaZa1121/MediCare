<?php

include("dbconnection.php");
include("header.php");

if (isset($_SESSION['utid']) && $_SESSION['utid'] == 1) {
$query = $pdo->query("SELECT appointments.*,patients.Name as PName,doctors.Name as DName,specialities.Name as SpecName from
appointments JOIN doctors on doctors.id = appointments.doctorid JOIN patients on patients.id = appointments.patientid
JOIN specialities on specialities.id = doctors.SpecialityId 
ORDER BY `appointments`.`Id` DESC");
$rows = $query->fetchAll(PDO::FETCH_ASSOC);
}

else if (isset($_SESSION['utid']) && $_SESSION['utid'] == 2){
  $query = $pdo->query("SELECT appointments.*,patients.Name as PName,doctors.Name as DName,specialities.Name as SpecName from appointments
                        JOIN doctors on doctors.id = appointments.doctorid
                        JOIN patients on patients.id = appointments.patientid
                        JOIN specialities on specialities.id = doctors.SpecialityId  where appointments.DoctorId=". $_SESSION['id']);
  $rows = $query->fetchAll(PDO::FETCH_ASSOC);

}

?>



        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <form class="form" method="post">

            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Patients Appointments</h6>
              </div>
              <hr>

            <div class="card shadow mb-4">

                <div class="table-responsive">
                  <table class="table table-hover table-striped" id="dataTable" width="100%" cellspacing="0">

                    <?php if($_SESSION['utid'] == 1){ ?>
                    <thead>
                      <tr>
                        <th>Patient Name</th>
                        <th>Doctor Name</th>
                        <th>Doctor Speciality</th>
                        <th>Date</th>
                        <th>Day</th>

                      </tr>
                    </thead>
                  <?php } else if($_SESSION['utid'] == 2){ ?>
                    <thead>
                      <tr>
                        <th>Patient Name</th>
                        <th>Day</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                  <?php } ?>


                    <tbody>
<?php
if (count($rows)>0) {

foreach ($rows as $row): ?>

  <?php if($_SESSION['utid'] == 1){ ?>
    <tr>
      <td><?php echo $row['PName'] ?></td>
      <td><?php echo $row['DName'] ?></td>
      <td><?php echo $row['SpecName'] ?></td>
      <td><?php echo $row['Date'] ?></td>
      <td><?php echo $row['Day'] ?></td>
    </tr>
  <?php } else if($_SESSION['utid'] == 2){ ?>
    <tr>
      <td><?php echo $row['PName'] ?></td>
      <td><?php echo $row['Day'] ?></td>
      <td><?php echo $row['Date'] ?></td>
    </tr>
  <?php } ?>

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
