<?php
include('connect/conn.php');
$today = date("Y-m-d H:i:s");
$time = date("H:i:s");
$date = date("Y-m-d");
$emp_id = $_SESSION["Employees_IDAdmin"];
$LOT_num = $_GET['pq_ID'];


if($_POST['submit'] == "Update"){
    $lot_name = mysqli_real_escape_string($con,trim($_POST['product_lot']));
    $product_code = mysqli_real_escape_string($con,trim($_POST['selectex']));
    $product_qty = mysqli_real_escape_string($con,trim($_POST['product_qty']));
    $product_qty_old = mysqli_real_escape_string($con,trim($_POST['product_qty_old']));
    $Product_opt = $_POST['Product_opt'];
    $a = intval($product_qty_old);
    $b = intval($product_qty);
    $ckk = $a + $b;
    $show = $a * -1;
    $status = "1";
    if ($ckk <0){
      echo "<script language='javascript'> alert('ไม่สามารถใส่จำนวนน้อยกว่า ".$show." ได้!');window.history.back(-1);  </script>";
      exit();
    }elseif($ckk == 0){
      $status = "0";
    }
    $cnt = intval($product_qty);
    if($cnt>0){
      $note = "เพิ่มสต็อคโดยแอดมิน";
    }elseif($cnt<0){
      $note = "ตัดสต็อคโดยแอดมิน";
    }else{
      $note = "";
    }

    $sql = " INSERT INTO `products_quantity` (`Products_Quantity_ID`, `Products_Code`, `Products_Quantity`, `Products_Quantity_Date`, `Products_Quantity_Time`, `Products_Lot`, `Employees_ID`,Products_Quantity_Status,Products_Quantity_Note, `DateCreate`, `LastUpdate`)  
    VALUES (NULL, '$product_code', '$product_qty ', '$date', '$time', '$lot_name ', '$emp_id','$status','$note', '$today', '$today')";
    $qry = mysqli_query($con,$sql);

    if ($qry == TRUE) {
        echo "<script language='javascript'> alert('อัปเดตสต็อคเรียบร้อย');window.location='index.php?stock';</script>";
        } else {
        //echo $sql ;
        echo "<script language='javascript'> alert('มีปัญหาการในการเพิ่มสต็อคสินค้า กรุณาตรวจสอบอีกครั้ง!'); </script>";

        }
 
       
}
$query_st = "SELECT *,SUM(Products_Quantity) as sum FROM `products_quantity` as q
INNER JOIN products as p
ON q.Products_Code = p.Products_Code
WHERE Products_Lot = '$LOT_num' " or die
("Error : ".mysqlierror($query_st));
$rs_st = mysqli_query($con, $query_st);
$objResult = mysqli_fetch_array($rs_st);

?>

 <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">แก้ไขสต็อคสินค้า</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="index.php?product">stocks</a></li>
            <li class="breadcrumb-item active">Add Stock</li>
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

    </div>
    <!-- /.card-header -->
    <div class="card-body">
    
    <form name="addtxt" method="post" action=""  enctype="multipart/form-data" >
    
    <div class="form-group row">
            <label for="product_lotSSS" class="col-md-2 col-form-label text-right">
            เลขที่ Lot สินค้า
            </label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="product_lotSSS" id="product_lot" value="<?php echo $objResult['Products_Lot']?>" disabled>
                <input type="hidden" name="product_lot" value="<?php echo $objResult['Products_Lot']?>">
            </div>    
        </div>
    <div class="form-group row">
      <input type="hidden" name="count" value="">
            <label for="selectex" class="col-md-2 col-form-label text-right">
            สินค้า
            </label>
            <div class="col-md-5">
                <select name="selectex" id="selectexSSS" class="form-control" disabled>
                    <option value="<?php echo $objResult['Products_Code']; ?>" ><?php echo $objResult['Products_Code2']."-".$objResult['Products_Name']; ?></option>
                    <!-- <option value="add">เพิ่มประเภทสินค้า</option> -->
                </select>    
                  
            </div>
            <input type="hidden" name="selectex" value="<?php echo $objResult['Products_Code']; ?>"  >

        </div>
        
        <div class="form-group row">
            <label for="product_pic" class="col-md-2 col-form-label text-right">
            จำนวนสินค้าที่มีในสต็อค
            </label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="product_qty_oldshow" id="product_qty_oldshow" value="<?php echo $objResult['sum']." ".$objResult['Products_Unit'];?>" required="required" disabled>
                <input type="hidden" name="product_qty_old" id="product_qty_old" value="<?php echo $objResult['sum']; ?>"  >
            </div>    
        </div> 
       
        <div class="form-group row">
            <label for="product_pic" class="col-md-2 col-form-label text-right">
            ใส่จำนวนสินค้า
            </label>
            <div class="col-md-5">
                <input type="number" class="form-control" name="product_qty" id="product_qty"  required="required">
            </div>    
        </div> 
        
         
        <div class="col-md-10" >
          <center>
            <input type="submit" name="submit" class="btn btn-success" value="Update" />
            <a href="index.php?stock" class="btn btn-secondary">กลับ</a>
          </center>  
        </div>    
        </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
