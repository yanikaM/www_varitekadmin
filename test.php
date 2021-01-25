<?php
  include("connect/conn.php");
$p_ID = $_GET['p_ID'];
$today = date("Y-m-d h:i:s");
$query_prd = "SELECT *,p.Products_Manualcode as code  FROM products as p 
LEFT JOIN products_price as pr
ON p.Products_Code=pr.Products_Code 
INNER JOIN products_categorys as c ON p.Categorys_ID=c.Categorys_ID 
WHERE Products_ID = '$p_ID' ";
// echo 	$query_prd;
$prd = mysqli_query($con, $query_prd) ;	
$row_prd = mysqli_fetch_assoc($prd);
$p_code= $row_prd['code'];
$p_name = $row_prd['Products_Name'];;


if($_POST['submit'] == "Update"){

    $prd_ID = $_POST['p_ID'];
    $cate = mysqli_real_escape_string($con,trim($_POST['selectex']));
    $product_name = mysqli_real_escape_string($con,trim($_POST['product_name']));
    $product_detail = mysqli_real_escape_string($con,trim($_POST['product_detail']));
    $product_unit = mysqli_real_escape_string($con,trim($_POST['product_unit']));
    $option_name = mysqli_real_escape_string($con,trim($_POST['option_name']));
    $option_id = mysqli_real_escape_string($con,trim($_POST['option_id']));
    
    $count = mysqli_real_escape_string($con,trim($_POST['count']));
    $pic_name = mysqli_real_escape_string($con,trim($_POST['pic_name']));
    $status = mysqli_real_escape_string($con,trim($_POST['onoffswitch']));
    if($status=="on"){
        $status = 1 ;
    }else {
        $status = 2 ;
    }
    $ext = pathinfo(basename($_FILES['product_pic']['name']), PATHINFO_EXTENSION);
            if($ext!=""){ 
              $success = move_uploaded_file($_FILES['product_pic']['tmp_name'], $pic_name);

            }
    $meSQL = "UPDATE `products`  SET
    Products_Name = '$product_name',
    Categorys_ID = '$cate',
    Products_Image = '$pic_name',
    Products_Status = '$status',
    Products_Description = '$product_detail',
    Products_Unit = '$product_unit',
    LastUpdate = '$today'
    WHERE Products_ID = '$p_ID' ";
 
    $meQuery = mysqli_query($con,$meSQL);
     if ($meQuery == TRUE) {
        $meSQL_option = "UPDATE `products_option` SET Option_Name =  '$option_name' WHERE Products_ID = '$p_ID' ";
       
         $meQuery_option = mysqli_query($con,$meSQL_option);
         if( $meQuery_option == TRUE){
             $values = array(); 
             $values = $_POST['txtoption'];
             $count = count($values);
             $meSQL_opd = "SELECT * FROM products_optiondetails WHERE Option_ID = '$option_id'  ";
             $meQuery_opd = mysqli_query($con,$meSQL_opd);
            print_r($values);
            

             $s=1;
            
             while($row_opd= mysqli_fetch_assoc($meQuery_opd)){
                 $id = $row_opd['Optiondetails_ID']; 
                 if($values[$s] !=""){
                     $meSQL_optiondetails = " UPDATE products_optiondetails SET Optiondetails_Name = '$values[$s]' WHERE Optiondetails_ID = '$id' ";
                     $meQuery_optiondetails  = mysqli_query($con,$meSQL_optiondetails);
                 }
                 $s++;
            }
            if($meQuery_optiondetails==TRUE){
                echo "<script language='javascript'> alert('แก้ไขสินค้าเรียบร้อย');window.location='?product-edit&p_ID=".$prd_ID."';</script>";
            }else{
                echo "<script language='javascript'> alert('มีปัญหาในการบันทึกตัวเลือก กรุณาลองใหม่  err-01');</script>";
            }
         }
        
     }    
    
    
    
    


}

?>
 <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">แก้ไขสินค้า</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="index.php?product">products</a></li>
            <li class="breadcrumb-item active">Edit product</li>
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
    <input type="hidden" name="p_ID" value="<?php echo $p_ID;?>">
    
    <div class="form-group row">
      <input type="hidden" name="count" value="">
            <label for="selectex" class="col-md-2 col-form-label text-right">
            ประเภทสินค้า
            </label>
            <div class="col-md-5">
                <select name="selectex" id="selectex" class="form-control" onchange="sSelect()">
                    <option value="<?php echo $row_prd['Categorys_ID']?>">ปัจจุบัน : <?php echo $row_prd['Categorys_Name']?></option>
                    <?php
                    $CtSQL = "SELECT * FROM  `products_categorys` WHERE Categorys_Status = 1 ORDER BY Categorys_ID";
                    $CtQuery = mysqli_query($con,$CtSQL);

                    $i=1;
                    while ($CtResult = mysqli_fetch_assoc($CtQuery)){ ?>
                        <option value="<?php echo $CtResult['Categorys_ID']; ?>"><?php echo $i.". ".$CtResult['Categorys_Name']; ?></option>
                    <?php
                    $i++;
                    }
                    ?>
                    <!-- <option value="add">เพิ่มประเภทสินค้า</option> -->
                </select>    
                  
            </div>
           

        </div>
        <!-- <div class="form-group row" id='display' style='display:none;' >
            <div class="col-md-5 offset-2">
                <input type="text" class="form-control" name="cate_name" id="cate_name" value="" placeholder="ใส่ชื่อประเภทสินค้า"> 
            </div> 
          </div>      -->
        <div class="form-group row">
            <label for="product_code" class="col-md-2 col-form-label text-right">
            รหัสสินค้า
            </label>
            <div class="col-md-5">
              <input type="text" class="form-control" name="product_code" id="product__code1" value="<?php echo $p_code ;?>" disabled>
            </div>
           
        </div>
        <div class="form-group row">
            <label for="product_name" class="col-md-2 col-form-label text-right">
            ชื่อสินค้า
            </label>
            <div class="col-md-5">
            <textarea type="text" class="form-control" name="product_name" id="product_name" value=""><?php echo $p_name;?></textarea>
            </div>    
        </div>
        <div class="form-group row">
            <label for="product_pic" class="col-md-2 col-form-label text-right">
            ภาพสินค้า
            </label>
            <div class="col-md-5">
                <img id="blah" style="width:200px" src="<?php echo $row_prd['Products_Image'];?>"/>
                <input type="file" class="form-control" name="product_pic" id="product_pic" onchange="readURL(this);">
            </div>  
            <input type="hidden" name="pic_name" value="<?php echo $row_prd['Products_Image'];?>">  
        </div> 
        <div class="form-group row">
            <label for="product_detail" class="col-md-2 col-form-label text-right">
            รายละเอียดสินค้า
            </label>
            <div class="col-md-5">
            <textarea type="text" class="form-control" name="product_detail" id="product_detail" value=""><?php echo $row_prd['Products_Description'];?></textarea>
            </div> 
        </div> 
        <div class="form-group row">
            <label for="product_unit" class="col-md-2 col-form-label text-right">
            หน่วยที่ใช้
            </label>
            <div class="col-md-5">
            <input type="text" class="form-control" name="product_unit" id="product_unit" value="<?php echo $row_prd['Products_Unit'];?>">
            </div>    
        </div> 
        <?php
		
            $query_opt = "SELECT * FROM products_option  WHERE Products_ID =".$row_prd['Products_ID'];
            $opt  = mysqli_query($con, $query_opt );
            $row_opt  = mysqli_fetch_assoc($opt);
            $opt_name = $row_opt['Option_Name'];
            $opt_id = $row_opt['Option_ID'];
            $totalRows_opt = mysqli_num_rows($opt);

            if($totalRows_opt>0){
        ?>
        <div class="form-group row">
              <label for="option_name" class="col-md-2 col-form-label text-right">
                ชื่อตัวเลือก
              </label>
              <div class="col-md-5">
                <input type="text" class="form-control add_option" name="option_name" id="option_name" value="<?php echo $opt_name;?>" placeholder="ใส่ชื่อตัวเลือกสินค้าเช่น สี ไซซ์...."> 
                <input type="hidden" name="option_id" value="<?php echo $opt_id ;?>">
              </div>    
        </div>
            <?php
            $did = $row_opt['Option_ID'];
            $query_opt_d = "SELECT * FROM products_optiondetails  WHERE Option_ID = '$did ' ";
            $opt_d  = mysqli_query($con, $query_opt_d );
            $i=1;
				while($rows = mysqli_fetch_assoc($opt_d)){
            ?>
            <div class="form-group row">
                <label for="ex_a2" class="col-md-2 col-form-label text-right">
                ตัวเลือกที่<?php echo $i;?>     
                </label>       
                <div class="col-md-5 ">  
                    <input type="text" class="form-control add_option" name="txtoption[<?php echo $i;?>]" id="optiondetails" value="<?php echo $rows['Optiondetails_Name'] ;?>" placeholder="ใส่ตัวเลือกสินค้าเช่น S M...."> 
                </div>            
            </div>
            <?php
            $i++;
            }
            ?>
        <?php
        }
        ?>
        
        
        <!-- <div id='display02' style='display:none;'>
          <div class="form-group row">
              <label for="option_name" class="col-md-2 col-form-label text-right">
                ชื่อตัวเลือก
              </label>
              <div class="col-md-5">
                <input type="text" class="form-control add_option" name="option_name" id="option_name" value="" placeholder="ใส่ชื่อตัวเลือกสินค้าเช่น สี ไซซ์...."> 
              </div>    
          </div>
          <div class="form-group row">
            <label for="ex_a2" class="col-md-2 col-form-label text-right">
              ตัวเลือก    
            </label>       
            <div class="col-md-5 ">  
              <div id="content">     
                <input type="text" class="form-control add_option" name="txtoption[]" id="optiondetails" value="" placeholder="ใส่ตัวเลือกสินค้าเช่น S M...."> 
              </div>
                 
            </div>
            
          </div>
          
          <div class="form-group row">
              <label for="ex_a2" class="col-md-2 col-form-label text-right">
              </label>
              <div class="col-md-5">
                  <input type="button" class="btn btn-block btn-outline-primary" value="เพิ่มตัวเลือก"  onclick="add_fields();">
              </div>   
          </div>
        </div> -->
                   
        <div class="form-group row">
            <label for="product_status" class="col-md-2 col-form-label text-right">
            สถานะ
            </label>
            <div class="col-md-3">
              <div class="onoffswitch">
              <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" <?php echo empty($row_prd['Products_Status'])?'':'checked'?> >    
              <label class="onoffswitch-label" for="myonoffswitch">
                  <span class="onoffswitch-inner"></span>
                  <span class="onoffswitch-switch"></span>
              </label>
              </div>
            </div>   
        </div> 
         
        <div class="col-md-10" >
          <center>
            <input type="submit" name="submit" class="btn btn-success" value="Update" />
            <a href="?product" class="btn btn-secondary">กลับ</a>
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
  var cnt = 1;
  document.getElementById("count").value = cnt;
function btnShow(){
  var dp2 = document.getElementById("display02");
  dp2.style.display = 'block';
  
}
function sSelect(){
  var dp = document.getElementById("display");
  var chk = document.getElementById("selectex").value;

  document.getElementById("product__code2").value=chk;

  if (chk=="add"){
    dp.style.display = 'block';

  }else{
    dp.style.display = 'none';
    
  }
}

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

function add_fields() {
   var d = document.getElementById("content");
  if (cnt < 15){
    d.innerHTML += "<br><span><input type='text' class='form-control add_option' name='txtoption[]' placeholder='ใส่ตัวเลือกสินค้าเช่น S M....' value='' /></span>";

    cnt = cnt+1;
    document.getElementById("count").value = cnt;
  }else{
    alert('เพิ่ม ตัวเลือกได้ 15 ตัวเลือก เท่านั้น');
  }
   
}

</script>

