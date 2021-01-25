<?php
include('connect/conn.php');
$today = date("Y-m-d H:i:s");
$time = date("H:i:s");
$date = date("Y-m-d");
$emp_id = $_SESSION["Employees_IDAdmin"];


if($_POST['submit'] == "Upload"){

  $create_prd_code2 = "SELECT Products_Quantity_ID FROM products_quantity ";
  $query_prd_code2 = mysqli_query($con,$create_prd_code2);
  $prd_code2 = mysqli_num_rows($query_prd_code2);
  $product_code4 = str_pad($prd_code2+1, 10, "0", STR_PAD_LEFT);

  
    $lot_name = "LOT".$product_code4;

    $select_prd = mysqli_real_escape_string($con,trim($_POST['select_prd']));
    

    $product_code = mysqli_real_escape_string($con,trim($_POST['Product_opt']));

    $product_qty = $_POST['product_qty'];
    $cnt = intval($product_qty);
    if($cnt>0){
      $note = "เพิ่มสต็อคโดยแอดมิน";
    }elseif($cnt<0){
      $note = "ตัดสต็อคโดยแอดมิน";
    }else{
      $note = "";
    }

   if($product_code==""){
    $product_code = $select_prd."000001";
   }

    $sql = " INSERT INTO `products_quantity` (`Products_Quantity_ID`, `Products_Code`, `Products_Quantity`, `Products_Quantity_Date`, `Products_Quantity_Time`, `Products_Lot`, `Employees_ID`,Products_Quantity_Note, `DateCreate`, `LastUpdate`)  
    VALUES (NULL, '$product_code', '$product_qty ', '$date', '$time', '$lot_name ', '$emp_id','$note', '$today', '$today')";
    $qry = mysqli_query($con,$sql);

    if ($qry == TRUE) {
        echo "<script language='javascript'> alert('เพิ่มสต็อคเรียบร้อย');window.location='index.php?stock';</script>";
        } else {
        // echo $sql ;
        echo "<script language='javascript'> alert('มีปัญหาการในการเพิ่มสต็อคสินค้า กรุณาตรวจสอบอีกครั้ง!'); </script>";

        }
 
       
}
  

?>

 <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">เพิ่มสต็อคสินค้า</h1>
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
    
    <!-- <div class="form-group row">
            <label for="product_lot" class="col-md-2 col-form-label text-right">
            เลขที่ Lot สินค้า
            </label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="product_lot" id="product_lot" value="">
            </div>    
    </div> -->
    <div class="form-group row">
      <input type="hidden" name="count" value="">
            <label for="select_prd" class="col-md-2 col-form-label text-right">
            รหัสสินค้า
            </label>
            <div class="col-md-5">
                <select name="select_prd" id="select_prd" class="form-control" required="required" required="required">
                    <option value="">เลือกรหัสสินค้า</option>
                    <?php
                    $CtSQL = "SELECT *,SUBSTRING(Products_Code, 1, 16) AS 'prd_code' FROM  `products` GROUP BY prd_code ORDER BY Products_ID";
                    $CtQuery = mysqli_query($con,$CtSQL);

                    $i=1;
                    while ($CtResult = mysqli_fetch_assoc($CtQuery)){ ?>
                        <option value="<?php echo $CtResult['prd_code']; ?>"><?php echo $CtResult['Products_Name']; ?></option>
                    <?php
                    $i++;
                    }
                    ?>
                    <!-- <option value="add">เพิ่มประเภทสินค้า</option> -->
                </select>    
                  
            </div>
        

        </div>
        <!-- <div class="form-group row">
            <label for="product_lot" class="col-md-2 col-form-label text-right">
           ตัวเลือก
            </label>
            <div class="col-md-5">
                <select name="Product_opt" id="Product_opt" class="form-control Product_opt">
                    <option value="">ไม่มีตัวเลือก</option>
                </select>
            </div>    
      </div>  -->
       
        <div class="form-group row">
            <label for="product_pic" class="col-md-2 col-form-label text-right">
            จำนวนสินค้า
            </label>
            <div class="col-md-5">
                <input type="number" class="form-control" name="product_qty" id="product_qty"  value="" OnKeyPress="return chkNumber(this)" required="required">
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
  $(function(){
    var productObject = $('#select_prd');
    var optionObject = $('#Product_opt');

 
    // on change province
    productObject.on('change', function(){
        var productId = $(this).val();
 
        optionObject.html('<option value="">เลือกตัวเลือก</option>');

 
        $.get('get_option.php?p_id=' + productId, function(data){
            var result = JSON.parse(data);
            $.each(result, function(index, item){
                optionObject.append(
                    $('<option></option>').val(item.Products_Code).html(item.Products_Option1)
                );
            });
        });
    });
 
});

function chkNumber(ele)
	{
	var vchar = String.fromCharCode(event.keyCode);
	if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
	ele.onKeyPress=vchar;
	}
</script>