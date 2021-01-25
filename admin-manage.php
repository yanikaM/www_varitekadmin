
<?php
include('connect/conn.php');
$query_cate = "SELECT * FROM `employees` ORDER BY Emp_ID" or die
("Error : ".mysqlierror($query_cate));
$rs_cate = mysqli_query($con, $query_cate);
//echo ($query_level);//test query
?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
		$(document).ready(function() {
	    	$('#admin_table').DataTable();
		} );
	</script>
 <!-- Content Header (Page header) -->
 <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      <?php
        if($_SESSION["Emp_permistion"] == 1){     
      ?>
      <a href="?admin-add" ><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> เพิ่มแอดมิน</button></a> 
      <?php
        }     
      ?>    
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index-admin.php">Home</a></li>
          <li class="breadcrumb-item active">Admin Manager</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Admin Manager</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <table id="admin_table" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อแอดมิน</th>
                <th>รหัสพนักงาน</th>
                <th>สถานะ</th>
                
            </tr>
        </thead>
        <tbody>
          <?php 
          $i=1;
          foreach ($rs_cate as $row_cate) { ?>

            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row_cate['Emp_name']; ?></td>
                <td><?php echo $row_cate['Employees_ID']; ?></td>
                <td>
                  <?php 
                  if($row_cate['Emp_permistion']==1){
                    echo "Extra Admin";
                  }elseif($row_cate['Emp_permistion']==2){
                    echo "Admin";
                  }
                  ?>
                </td>
                
            </tr>
        <?php $i++;  }?>
        </tbody>
        
    </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->


