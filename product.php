<?php
include('connect/conn.php');

  
  $sql_product = "SELECT *,SUBSTRING(Products_Code, 1, 16) AS 'prd_code' FROM `products` as p INNER JOIN products_categorys as c ON p.Categorys_ID = c.Categorys_ID 
  GROUP BY prd_code  ORDER BY Products_ID DESC" or die ("Error : ".mysqlierror($sql_product));



$query_product = mysqli_query($con, $sql_product);
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
          <div class="col-sm-2">
          <a href="?product-add" ><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> เพิ่มสินค้า</button></a> 
          </div><!-- /.col -->
          <div class="col-sm-2">
          </div><!-- /.col -->
          <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">products</li>
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
          <h3 class="card-title">รายการสินค้า</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>ประเภทสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>ภาพ</th>
                <th>สถานะ</th>
                <th>ดำเนินการ</th>
            </tr>
        </thead>
        <tbody>
          <?php 
          $i=1;
          foreach ($query_product as $row_product) { 
            $prd = substr($row_product['Products_Code'], 0, -6); 
            ?>

            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row_product['Categorys_Name']; ?></td>
                <td><?php echo $row_product['Products_Name']; ?></td>
                <td> <img src="<?php echo $row_product['Products_Image']; ?>" width="100" height="100"></td>
                <td>
                <?php
                if($row_product['Products_Status'] == '1'){?>
                  <span class="badge badge-success">ON</span>
                <?php
                }else{
                ?>
                  <span class="badge badge-secondary">OFF</span>
                <?php
                }
                ?>
                  
                </td>
                <td>
                  <a class="btn btn-primary btn-sm" href="?product-view&p_ID=<?php echo $prd ; ?>"><i class="fas fa-folder"></i> View</a>
                  <a class="btn btn-info btn-sm" href="?product-edit&p_ID=<?php echo $prd ; ?> "><i class="fas fa-pencil-alt"></i> Edit</a>
                  <a class="btn btn-danger btn-sm" href="delete.php?p_ID=<?php echo $prd ; ?> " onclick="return confirm('ยืนยันการลบ')"><i class="fas fa-trash"></i> Delete</a>

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
 

