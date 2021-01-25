<?php
include('connect/conn.php');
$today = date("Y-m-d h:i:s");
$emp_id = $_SESSION["Employees_ID"];
$pr_ID = $_GET['pr_ID'];
$test = $_GET['test'];
echo $test;


if($_POST['submit'] == "Update"){




    $product_price = mysqli_real_escape_string($con,trim($_POST['product_price']));
    $prd_ID = mysqli_real_escape_string($con,trim($_POST['pr_ID']));

    
    $sql = " UPDATE products_price SET Products_Price = '$product_price',LastUpdate = '$today' WHERE Products_Price_ID= '$prd_ID' ";
    $qry = mysqli_query($con,$sql);

        if ($qry == TRUE) {
        echo "<script language='javascript'> alert('แก้ไขราคาเรียบร้อย');window.location='index.php?price';</script>";
        } else {
            // echo $meSQL_cate;
        echo "<script language='javascript'> alert('มีปัญหาการในการเพิ่มสต็อคสินค้า กรุณาตรวจสอบอีกครั้ง!'); </script>";

        }
 

    
  
}
    $query_st = "SELECT * 
    FROM `products_price` AS pr 
    INNER JOIN products as p 
    ON pr.Products_Code = p.Products_Code
    WHERE Products_Price_ID = '$pr_ID'
    " or die
    ("Error : ".mysqlierror($query_st));
    $rs_st = mysqli_query($con, $query_st);
    $objResult = mysqli_fetch_array($rs_st);
  

?>

 <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">แก้ไขราคาสินค้า</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="index.php?price">products price</a></li>
            <li class="breadcrumb-item active">Edit product price</li>
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
            <label for="product_lot" class="col-md-2 col-form-label text-right">
            เลขที่ Lot สินค้า
            </label>
            <div class="col-md-5">
                <select name="product_lot" id="product_lot" class="form-control" required="required" disabled>
                    <option value="<?php echo $objResult['Products_Lot']; ?>"><?php echo $objResult['Products_Lot']." - ".$objResult['Products_Code2']." (".$objResult['Products_Name']." ".$objResult['Products_Code2']." ".$objResult['Products_Option1'].")"; ?></option>
                   
                </select>  
            </div>    
        </div>
    
       
       
        <div class="form-group row">
            <label for="product_pic" class="col-md-2 col-form-label text-right">
            ราคาสินค้า
            </label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="product_price" id="product_price" required="required" value="<?php echo number_format($objResult['Products_Price'],2);?>">
            </div>    
        </div>
        <input type="hidden" name="pr_ID" value="<?php echo $pr_ID;?>"> 
        
         
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
