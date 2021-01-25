<?php
include('connect/conn.php');
$order_no = $_GET["o_ID"];

$sql_ord= "SELECT * FROM orders as o, orders_detail as d, products as p WHERE o.Orders_No= '$order_no' AND  o.Orders_No=d.Orders_No AND d.Products_ID=p.Products_ID  ORDER BY o.Orders_ID ASC";
$query_ord = mysqli_query($con, $sql_ord);
$row_ord  = mysqli_fetch_assoc($query_ord);
$status = $row_ord['Orders_Status'];
$or_date= $row_ord['Orders_Date'];

$sqlcus = "SELECT * FROM orders as o INNER JOIN customers as c ON o.Customer_ID = c.Customer_ID
 
 WHERE o.Orders_No= '$order_no' ";
$query_cus = mysqli_query($con, $sqlcus);
$row_cus  = mysqli_fetch_assoc($query_cus);
$cusname = $row_cus['Customer_Name'];
  

//   $sql_ord.= " GROUP BY d.Orders_No ORDER BY o.Orders_ID DESC" or die ("Error : ".mysqlierror($sql_product));

//echo ($query_level);//test query
?>
  <link rel="stylesheet" type="text/css" href="http://dev_inno.asefa.co.th/cdn/datatable/css/dataTables.bootstrap4.min.css">
	<script src="http://dev_inno.asefa.co.th/cdn/jquery-3.4.1.min.js"></script>
	<script src="http://dev_inno.asefa.co.th/cdn/datatable/js/jquery.dataTables.min.js"></script>
	<script src="http://dev_inno.asefa.co.th/cdn/datatable/js/dataTables.bootstrap4.min.js"></script>
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
              <li class="breadcrumb-item"><a href="index.php?order&f=2">oders</a></li>
              <li class="breadcrumb-item active">order detail</li>
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
          <h3 class="card-title">รายละเอียดออเดอร์</h3>
        </div>
        
        <!-- /.card-header -->
        <div class="card-body">
        <table class="table"  style="">
                    <thead>
                        <tr>
                            <th scope="col" width="60%"><?php echo $order_no;?></th>
                            <th scope="col"  width="20%"></th>
                            <th scope="col">สถานะ : <?php 
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
                            </th>
                        </tr>
                            <th scope="col" width="50%">ผู้สั่ง <?php echo $cusname;?></th>
                            <th></th>
                            <th scope="col">วันที่ <?php echo $or_date;?></th>
                        <tr>
                        </tr>
                    </thead>
               
                    <tbody>
                    <?php
                        $sqlo	= "SELECT * FROM orders as o, orders_detail as d, products as p WHERE o.Orders_No= '$order_no' AND  o.Orders_No=d.Orders_No AND d.Products_ID=p.Products_ID  ORDER BY o.Orders_ID ASC";
                        $queryo = mysqli_query($con, $sqlo);
                        $total = 0;
                        while ($row_cartdone = mysqli_fetch_assoc($queryo)) {
                            $opt_id = $row_cartdone['Optiondetails_ID'];
                            $totals = $row_cartdone['Products_price']*$row_cartdone['Products_Qty'];

                        ?>
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="<?php echo $row_cartdone['Products_Image']; ?>" alt="" width="100" height="100">
                                    </div>
                                    <div class="media-body">
                                        <p><?php echo $row_cartdone['Products_Name'];?></p>
                                        <p>ราคา <?php echo $row_cartdone['Products_price'];?></p>
                                        
                                       
                                        <p>x <?php echo $row_cartdone['Products_Qty']; ?></p>
                                    </div>
                                </div>
                            </td>
                            <td> สต็อคที่มี : 
                                <font size="4" color="blue">
                                 <?php
                                    $p_code= $row_cartdone['Products_Code'];
                                    $sql_st = "SELECT *,SUM(Products_Quantity) as sum FROM `products_quantity` as q 
                                    INNER JOIN  products as p
                                    ON q.Products_Code = p.Products_Code
                                     WHERE q.Products_Code = '$p_code'  
                                     GROUP BY Products_Lot
                                     ORDER BY Products_Quantity_ID ASC LIMIT 1";
                                    $st = mysqli_query($con, $sql_st) ;	
                                    $row_st = mysqli_fetch_assoc($st);
                                    if ($row_st['sum']==""){
                                        echo "0 ".$row_cartdone['Products_Unit'];
                                    }else{
                                        echo $row_st['sum']." ".$row_cartdone['Products_Unit'];
                                    }
                                   
                                ?>
                                </font>
                            </td>
                    
                            <td>
                                <?php 
                                  $sum	= $row_cartdone['Products_price']*$row_cartdone['Products_Qty'];
                                echo "รวม ".number_format($sum,2); ?> บาท
                            </td>
                        </tr>
                        <?php

                            $checckstok = $row_st['sum']-$row_cartdone['Products_Qty'];
                            if($checckstok >= 0){
                                $checckstok = "ok";
                            }else{
                                $checckstok = "notok";
                            }
                      
                        
                            $total += $sum;

                            
                        }

                        ?>
                        <tr>
                            <td colspan='3' align='right'>ยอดคำสั่งซื้อทั้งหมด : <font size="5" color="#ff0000"><?php echo number_format($total,2); ?> บาท</font></td>
                        </tr>
                        
                        <?php 

	  if($status == '2'){ 

      $query_rb = "SELECT * FROM payments WHERE Orders_No = '$order_no' ";
      $rb = mysqli_query($con, $query_rb);
      $row_rb = mysqli_fetch_assoc($rb);
      $totalRows_rb = mysqli_num_rows($rb);
    ?>

    <tr>

        <td colspan='3'>   
    
    
        <p>รายละเอียดการโอนเงิน</p> 
         </tr>
      <tr>
      <td colspan='2'>   
          <p>หลักฐานการโอน</p>
          <!-- <p><img id="blah" style="width:200px" src="../asefa-shop-admin/images/up_img.png"/></p> -->
          <img src="../asefa-shop-admin/<?php echo $row_rb['payments_File']; ?>" width="500" >
          <input name="order_id" type="hidden" id="order_id" value="<?php echo $order_no;?>" />
      </td>
      </tr> 
      <tr>
        <td>ช่องทางการจัดส่ง</td>
      </tr>  
      <form action="update.php" method="get">
      <tr>
        <td><label for="select_posts">
            ขนส่ง
            </label>
            <select name="select_posts" id="select_posts" class="form-control" >
                    <option value="">1. EMS (Thailand POST)</option>
                </select></td>
        

      
      <td colspan='2'> <label for="trak">
      เลขพัสดุ
            </label> <input type="text" name="trak" id="trak" class="form-control"> </td>
 
      </tr>
      <input type="hidden" name="a" value="accept">
      <input type="hidden" name="o_ID" value="<?php echo $row_ord['Orders_No']; ?>">

  
                            <td colspan='2' align='center'> 
                           
                                
                          
                            <input type="submit" value="ยืนยันคำสั่งซื้อ" class="btn btn-success btn-sm" <?php if($checckstok=="notok"){ echo "disabled"; }?>>
                            <a href="delete.php?o_ID=<?php echo $row_ord['Orders_No']; ?> " onclick="return confirm('ยืนยันการยกเลิกรายการสั่งซื้อ')"><button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="ยกเลิก"  id = "<?echo $row_ord['Orders_No']?>">ยกเลิกคำสั่งซื้อ</button></a>
                            </td>&
                            
                        </tr>
     </form>             
  <?php 
      }
  ?>
                       
                        

                    </tbody>
                </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
 

