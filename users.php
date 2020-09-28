<?php

include("dbconnection.php");

//Delete Query
$query = $pdo->prepare("delete from users where Id = :id");
$query->bindparam("id",$_GET['id'],PDO::PARAM_INT); //for doctor
$query->execute();

$query = $pdo->query("SELECT users.*,usertypeid.name as UType from users
JOIN usertypeid on users.usertypeid = usertypeid.id");
$rows = $query->fetchAll(PDO::FETCH_ASSOC);



?>

<?php include("header.php"); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <form class="form" action="" method="post">

            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">USERS</h6>
              </div>
<hr>
                <div class="table-responsive">
                  <table class="table table-hover table-striped" id="dataTable" width="100%" cellspacing="0">

                    <thead>
                      <tr>
                        <th>Email</th>
                        <th>Password</th>
                        <th>UserType</th>
                      </tr>
                    </thead>

                    <tbody>
<?php
if (count($rows)>0) {

foreach ($rows as $row): ?>

    <tr>
      <td><?php echo $row['Email'] ?></td>
      <td><?php echo $row['Password'] ?></td>
      <td><?php echo $row['UType'] ?></td>
      <td>
        <a href="users.php?id=<?php echo $row['Id'] ?>" class="btn btn-danger">Delete</a>
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
