<?php
include('connect/conn.php');
$LOT_num = $_GET['pq_ID'];
$query_cate = "SELECT * FROM `products_quantity` as pq 
INNER JOIN  products as p
ON pq.Products_Code = p.Products_Code
INNER JOIN employees as e
ON e.Employees_ID = pq.Employees_ID
WHERE Products_Lot = '$LOT_num'
ORDER BY Products_Quantity_ID DESC" or die
("Error : ".mysqlierror($query_cate));
$rs_cate = mysqli_query($con, $query_cate);
$rs = mysqli_fetch_assoc($rs_cate);
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
          <h1 class="m-0 text-dark">สต็อคสินค้า</h1>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Stock view</li>
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
          <h3 class="card-title">รายการตารางสต็อคสินค้า</h3></br>
          <label for="">เลขที่ Lot สินค้า : </label> <?php echo $LOT_num; ?></br>
          <label for="">ชื่อสินค้า : </label> <?php echo $rs['Products_Name']." ".$rs['Products_Option1']; ?></br>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>เพิ่ม</th>
                <th>ลบ</th>
                <th>โดย</th>
                <th>หมายเหตุ</th>
                <th>วันที่</th>
            </tr>
        </thead>
        <tbody>
          <?php 
          $i=1;
          foreach ($rs_cate as $row_cate) {
            $qty = $row_cate['Products_Quantity'];
            $cnt = intval($qty);
                if($cnt>0){
                $note = "add";
                }elseif($cnt<0){
                $note = "div";
                }

              ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><font color="blue"><?php if($note=="add"){ echo $qty." ".$row_cate['Products_Unit'] ;  }  ?></font></td>
                <td><font color="red"><?php if($note=="div"){ echo $qty." ".$row_cate['Products_Unit'] ;  }  ?></font></td>
                <td><?php echo $row_cate['Emp_name']; ?></td>
                <td><?php echo $row_cate['Products_Quantity_Note']; ?></td>
                <td><?php echo $row_cate['LastUpdate']; ?></td>
               
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
 

