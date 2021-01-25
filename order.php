<?php
include('connect/conn.php');

  $Products_ID = $_GET['Products_ID'];
  $sql_ord= "SELECT *,COUNT(d.Products_Qty) as cnt,SUM(Products_price*Products_Qty) as sum FROM `orders` as o
  INNER JOIN customers as c
  ON o.Customer_ID = c.Customer_ID
  INNER JOIN orders_detail as d
  ON o.Orders_No = d.Orders_No
  INNER JOIN products as p
  ON d.Products_ID = p.Products_ID
  WHERE 1 
   ";

  if(isset($_GET["f"])){
    if($_GET["f"]=='all'){
      $sql_ord.= " AND Orders_Status > '0' ";
    }elseif($_GET["f"]==1){
        $sql_ord.= " AND Orders_Status = '1' ";
    }elseif($_GET["f"]==2){
        $sql_ord.= " AND Orders_Status = '2' ";

    }elseif($_GET["f"]==3){
        $sql_ord.= " AND Orders_Status = '3' ";

    }elseif($_GET["f"]==4){
        $sql_ord.= " AND Orders_Status = '4' ";

    }elseif($_GET["f"]==0){
        $sql_ord.= " AND Orders_Status = '0' ";

    }

  }

  $sql_ord.= " GROUP BY d.Orders_No ORDER BY d.Orders_Detail_ID DESC " or die ("Error : ".mysqlierror($sql_product));

//echo $sql_ord;

$query_ord = mysqli_query($con, $sql_ord);
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
          
          </div><!-- /.col -->
          <div class="col-sm-2">
          </div><!-- /.col -->
          <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">orders</li>
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
          <h3 class="card-title">รายการออเดอร์</h3>
        </div>
        <div class="card-header">
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item active">
                    <a class="nav-link <?php if($_GET["f"]=="all"){echo "active" ;} ?>" href="?order&f=all"> ทั้งหมด</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php if($_GET["f"]=='1'){echo "active" ;} ?>" href="?order&f=1">รอชำระ</a>
                </li>
    
                <li class="nav-item">
                    <a class="nav-link <?php if($_GET["f"]=='2'){echo "active" ;} ?>" href="?order&f=2">รอจัดส่ง</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($_GET["f"]=='3'){echo "active" ;} ?>" href="?order&f=3">อยู่ระหว่างจัดส่ง</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($_GET["f"]=='4'){echo "active" ;} ?>" href="?order&f=4">สำเร็จแล้ว</a>
                </li>
            
                <li class="nav-item">
                    <a class="nav-link <?php if($_GET["f"]=='0'){echo "active" ;} ?>" href="?order&f=0">ยกเลิกแล้ว</a>
                </li>
            
            </ul>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th align="center">รหัสสั่งซื้อ</th>
                <th align="center">ลูกค้า</th>
                <th align="center">จำนวนสินค้า</th>
                <th align="center">ราคารวม</th>
                <th align="center">วันที่ทำรายการ</th>
                <th align="center">สถานะ</th>
                <?php
                if($_GET["f"]==1 || $_GET["f"]==2 || $_GET["f"]==3){
                ?>
                <th align="center">ดำเนินการ</th>
                <?php }?>
            </tr>
        </thead>
        <tbody>
          <?php 
          $i=1;
          foreach ($query_ord as $row_ord) { 
            $order_no =   $row_ord['Orders_No'];
          ?>

            <tr>
                <td><?php echo $order_no; ?></td>
                <td><?php echo $row_ord['Customer_Name']; ?></td>
                <td><?php 
                $sql_cnt	= "SELECT * FROM orders as o, orders_detail as d, products as p WHERE o.Orders_No= '$order_no' AND  o.Orders_No=d.Orders_No AND d.Products_ID=p.Products_ID  ";
                $query_cnt = mysqli_query($con, $sql_cnt);
                $count = mysqli_num_rows($query_cnt);
                $total=0;
                while ($row_cnt = mysqli_fetch_assoc($query_cnt)) {
                    $sum_cnt	= $row_cnt['Products_Qty'];
                    $total += $sum_cnt;
                }
                echo $total; 
                ?></td>
                <td><?php echo $row_ord['sum']; ?></td>
                <td><?php echo $row_ord['Orders_Date']; ?></td>
                <td><?php 
                $status = $row_ord['Orders_Status']; 
                    if($status==1){ ?>
                        <span class="badge badge-info"> รอชำระเงิน</span>
                    <?php  }elseif($status==2){
                        ?>
                        <span class="badge badge-warning">  รอจัดส่ง   </span>
                        <?php 
                    }elseif($status==3){
                        ?>
                        <span class="badge badge-primary">อยู่ระหว่างจัดส่ง</span>
                        <?php 
                    }elseif($status==4){
                        ?>
                        <span class="badge badge-success">สำเร็จแล้ว</span>
                        <?php 
                    }
                    elseif($status==0){
                        ?>
                        <span class="badge badge-secondary"> ยกเลิกคำสั่งซื้อ </span>
                        <?php 
                    }

                ?>
                </td>
                <?php
                if($_GET["f"]==1 || $_GET["f"]==2){
                ?>
                <td>
                  <a class="btn btn-primary btn-sm" href="?order-view&o_ID=<?php echo $row_ord['Orders_No']; ?> "><i class="fas fa-folder"></i> View</a>
                  <a class="btn btn-danger btn-sm" href="delete.php?o_ID=<?php echo $row_ord['Orders_No']; ?> " onclick="return confirm('กรุณากดยืนยัน เพื่อยกเลิกรายการสั่งซื้อ')"><i class="fas fa-trash"></i> Delete</a>
                </td>
                <?php }elseif($_GET["f"]==3) {?>  
                <td>
                  <a class="btn btn-primary btn-sm" href="?order-view&o_ID=<?php echo $row_ord['Orders_No']; ?> "><i class="fas fa-folder"></i> View</a>
                  <a class="btn btn-info btn-sm" href="https://track.thailandpost.co.th/?trackNumber=<?php echo $row_ord['Orders_TAG']; ?> "  target="_blank"> <i class="fas fa-truck"></i> สถานะการจัดส่ง</a>
                  <a class="btn btn-success btn-sm" href="update.php?a=send&o_ID=<?php echo $row_ord['Orders_No']; ?> "> จัดส่งสำเร็จ</a>
                </td>    
                <?php }?> 
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
 

