<?php
include('connect/conn.php');
$query_type = "SELECT * FROM `products_claim` as pc
INNER JOIN products as p
ON pc.Products_ID = p.Products_ID
 ORDER BY pc_ID  DESC " or die
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
            <h2>แจ้งเคลมสินค้า</h2> 
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">claims</li>
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
          <h3 class="card-title">รายการแจ้งเคลม</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>วันที่</th>
                <th>เลที่ออเดอร์</th>
                <th>สินค้า</th>
                <th>รายละเอียด</th>
                <th>สถานะ</th>
                <th>ดำเนินการ</th>
                
            </tr>
        </thead>
        <tbody>
          <?php 
          $i=1;
          foreach ($rs_type as $row_cate) { ?>

            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row_cate['LastUpdate']; ?></td>
                <td><?php echo $row_cate['Orders_No']; ?></td>
                <td><?php echo $row_cate['Products_Name']; ?></td>
                <td><?php echo $row_cate['note']; ?></td>
                <td><?php 
                $status = $row_cate['status']; 
                if($status==1){ ?>
                    <span class="badge badge-info"> แจ้งเคลม</span>
                <?php  }elseif($status==2){
                    ?>
                    <span class="badge badge-warning">  กำลังดำเนินการ   </span>
                    <?php 
                }elseif($status==3){
                    ?>
                    <span class="badge badge-success">เคลมสำเร็จ</span>
                    <?php 
                }
                elseif($status==0){
                    ?>
                    <span class="badge badge-danger"> ปฏิเสธการเคลม </span>
                    <?php 
                }
               
                ?></td>
                
                <td>
                <?php 
                if($status==1){
                ?>
                    <a class="btn btn-info btn-sm" href="update.php?a=claim&pc_ID=<?php echo $row_cate['pc_ID']; ?>"> ยืนยันการเคลม</a>
                    <a class="btn btn-danger btn-sm" href="update.php?a=unclaim&pc_ID=<?php echo $row_cate['pc_ID']; ?>" onclick="return confirm('กรุณากดยืนยัน เพื่อปฏิเสธการเคลม')"><i class="fas fa-trash"></i> ปฏิเสธ</a>
                <?php
                }elseif($status==2){
                ?>
                     <a class="btn btn-success btn-sm" href="update.php?a=claimdone&pc_ID=<?php echo $row_cate['pc_ID']; ?>"> เคลมสำเร็จ</a>
                <?php
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
 

