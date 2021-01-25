<?php
include('connect/conn.php');
$today = date("Y-m-d H:i:s");

if($_POST['submit'] == "Upload"){



    $lot_name = mysqli_real_escape_string($con,trim($_POST['product_lot']));
    $product_price = mysqli_real_escape_string($con,trim($_POST['product_price']));
    $searh_code ="SELECT `Products_Code` FROM `Products_Quantity` WHERE `Products_Lot`= '$lot_name' ";
    $qry_code = mysqli_query($con,$searh_code);
    $row_code = mysqli_fetch_assoc($qry_code);
    $Products_Code = $row_code['Products_Code'];
    if($Products_Code != ""){
      $sql = " INSERT INTO products_price (Products_Code,Products_Lot,Products_Price,DateCreate,LastUpdate) 
    VALUES ('$Products_Code','$lot_name','$product_price','$today','$today') ";
    $qry = mysqli_query($con,$sql);

    if ($qry == TRUE) {
        echo "<script language='javascript'> alert('เพิ่มราคาเรียบร้อย');window.location='index.php?price';</script>";
        } else {
            // echo $meSQL_cate;
        echo "<script language='javascript'> alert('มีปัญหาการในการเพิ่มสต็อคสินค้า กรุณาตรวจสอบอีกครั้ง!'); </script>";

        }
 

    }


    

    

  
}
  

?>

 <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">เพิ่มราคาสินค้า</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="index.php?product">products</a></li>
            <li class="breadcrumb-item active">Add product</li>
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
                <select name="product_lot" id="product_lot" class="form-control" required="required" onchange="sSelect()">
                    <option value="">เลือก Lot สินค้า</option>
                    <?php
                    $CtSQL = "SELECT pr.products_price,q.Products_Lot,q.Products_Code,p.Products_Name,p.Products_Code2,Products_Option1
                    FROM `products_price` AS pr 
                    RIGHT JOIN `products_quantity` AS q 
                    ON pr.Products_Lot = q.Products_Lot
                    INNER JOIN products as p 
                    ON q.Products_Code = p.Products_Code
                    WHERE products_price is NULL
                    GROUP BY q.Products_Lot
                    ";
                    $CtQuery = mysqli_query($con,$CtSQL);
                    $Cnt= mysqli_num_rows($CtQuery);

                    $i=1;
                    while ($CtResult = mysqli_fetch_assoc($CtQuery)){ ?>
                        <option value="<?php echo $CtResult['Products_Lot']; ?>"><?php echo $CtResult['Products_Lot']." - ".$CtResult['Products_Code2']." (".$CtResult['Products_Name'].$CtResult['Products_Option1'].")"; ?></option>
                    <?php
                    $i++;
                    }
                    if($Cnt==0){
                    ?>
                     <option value="">ไม่มี Lot สินค้าที่ต้องกำหนดราคา เพิ่มเติม</option>
                     <?php
                    }
                    ?>
                </select>  
            </div>    
        </div>
    
       
       
        <div class="form-group row">
            <label for="product_pic" class="col-md-2 col-form-label text-right">
            ราคาสินค้า
            </label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="product_price" id="product_price" required="required"  title="กรอกตัวเลขเท่านั้น">
            </div>    
        </div> 
        
         
        <div class="col-md-10" >
          <center>
            <input type="submit" name="submit" class="btn btn-success" value="Upload" />
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
<script>
function sSelect(){

  var chk = document.getElementById("Products_Code").value;
  document.getElementById("selectex").value=chk;

}
</script>