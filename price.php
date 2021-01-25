<?php
include('connect/conn.php');
$query_cate = "SELECT *
FROM `products_price` AS pr 
RIGHT JOIN `products_quantity` AS q 
ON pr.Products_Lot = q.Products_Lot
INNER JOIN products as p 
ON q.Products_Code = p.Products_Code
GROUP BY q.Products_Lot
ORDER BY Products_Price_ID ASC " or die
("Error : ".mysqlierror($query_cate));
$rs_cate = mysqli_query($con, $query_cate);
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
          <a href="?price-add" ><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> กำหนดราคาสินค้าเพิ่มเติม</button></a> 
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">price setting</li>
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
          <h3 class="card-title">รายการตารางราคาสินค้า</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>Lot สินค้า</th>
                <th>รหัสสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>ราคาสินค้า (บาท)</th>
                <th>วันที่อัปเดต</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
          <?php 
          $i=1;
          foreach ($rs_cate as $row_cate) { 
          $price = $row_cate['Products_Price'];  
          ?>
          
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row_cate['Products_Lot']; ?></td>
                <td><?php if($row_cate['Products_Code2']==""){ echo "-"; }else{ echo $row_cate['Products_Code2']; }?></td>
                <td><?php echo $row_cate['Products_Name']." ".$row_cate['Products_Option1']; ?></td>
                <td><?php 
                if($price==""){
                ?>
                  <a href="?price-add">
                  <font size="3" color="red">ยังไม่ได้กำหนดราคาสินค้า</font>
                  </a>
                <?php
                }else{
                  echo number_format($row_cate['Products_Price'],2);
                }?></td>
                <td><?php echo $row_cate['LastUpdate']; ?></td>
                <td>
                <?php if($row_cate['Products_Price_ID']!= "") {?>
                  <a class="btn btn-info btn-sm" href="?test=aaa%32b&price-edit&a=update&pr_ID=<?php echo $row_cate['Products_Price_ID']; ?> "><i class="fas fa-pencil-alt"></i> Edit</a>
                <?php }?>
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
 

