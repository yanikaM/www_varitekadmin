<?php
include('connect/conn.php');
$query_type = "SELECT * FROM `brand` ORDER BY brand_ID  ASC " or die
("Error : ".mysqlierror($query_type));
$rs_type = mysqli_query($con, $query_type);
//echo ($query_level);//test query
?>

	<link rel="stylesheet" type="text/css" href="http://dev_inno.asefa.co.th/cdn/datatable/css/dataTables.bootstrap4.min.css">
	<script src="http://dev_inno.asefa.co.th/cdn/jquery-3.4.1.min.js"></script>
	<script src="http://dev_inno.asefa.co.th/cdn/datatable/js/jquery.dataTables.min.js"></script>
	<script src="http://dev_inno.asefa.co.th/cdn/datatable/js/dataTables.bootstrap4.min.js"></script>



<script>
		$(document).ready(function() {
	    	$('#example').DataTable();
		} );
	</script>
 <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <a href="?promotion-add" ><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> เพิ่มโปรโมชัน</button></a> 
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">brand</li>
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
          <h3 class="card-title">รายการบทความ</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>โปรโมชัน</th>
                <th>ดำเนินการ</th>
                
            </tr>
        </thead>
        <tbody>
          <?php 
          $i=1;
          foreach ($rs_type as $row_cate) { ?>

            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row_cate['news_topic']; ?></td>

                <td>
                  <a class="btn btn-info btn-sm" href="?promotion-edit&promotion_ID=<?php echo $row_cate['promotion_ID']; ?> "><i class="fas fa-pencil-alt"></i> Edit</a>
                  <a class="btn btn-danger btn-sm" href="delete.php?promotion_ID=<?php echo $row_cate['promotion_ID']; ?> " onclick="return confirm('กรุณากดยืนยัน เพื่อลบบทความ')"><i class="fas fa-trash"></i> Delete</a>
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
 

