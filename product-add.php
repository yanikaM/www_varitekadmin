<?php
include('connect/conn.php');
$today = date("Y-m-d H:i:s");
$status =1;
if(isset($_POST['submit'])&& $_POST['submit'] == "Upload"){

  $product_name = mysqli_real_escape_string($con,trim($_POST['product_name']));
  $product_detail = mysqli_real_escape_string($con,trim($_POST['product_detail']));
  $product_unit = mysqli_real_escape_string($con,trim($_POST['product_unit']));
 
  $count = mysqli_real_escape_string($con,trim($_POST['count']));
  $cate = mysqli_real_escape_string($con,trim($_POST['selectex']));
  $type = mysqli_real_escape_string($con,trim($_POST['select_type']));
  $status = mysqli_real_escape_string($con,trim($_POST['onoffswitch']));
  $brand = mysqli_real_escape_string($con,trim($_POST['select_brand']));
  $price = mysqli_real_escape_string($con,trim($_POST['product_price']));
  


  $create_prd_code2 = "SELECT Products_ID FROM products WHERE Categorys_ID = '$cate' ";
  $query_prd_code2 = mysqli_query($con,$create_prd_code2);
  $prd_code2 = mysqli_num_rows($query_prd_code2);
  $product_code3 = str_pad($prd_code2+1, 4, "0", STR_PAD_LEFT);
  

  $create_prd_code = "SELECT Products_Code FROM products GROUP BY Products_Code";
  $query_prd_code = mysqli_query($con,$create_prd_code);
  $prd_code = mysqli_num_rows($query_prd_code);
  $product_code4 = str_pad($prd_code+1, 4, "0", STR_PAD_LEFT);

  $product_code = "ITEM".$cate.$product_code3.$product_code4;

  

  if($status=="on"){
    $status = 1 ;
  }else {
    $status = 0 ;
  }

  $ext = pathinfo(basename($_FILES['product_pic']['name']), PATHINFO_EXTENSION);
            if($ext!=""){ 
              $new_pic_name = $product_code."_picture.".$ext;
              $img_path = "images/products/";
              $upload_path = $img_path.$new_pic_name;
              $success = move_uploaded_file($_FILES['product_pic']['tmp_name'], $upload_path);
              $q_pic = $upload_path;
            
            }

  $meSQL = "INSERT INTO `products`  ( `Types_ID`,`Categorys_ID`,brand_ID,`Products_Code`,`Products_Code2`, `Products_Name`,Products_price, `Products_Description`,`Products_Option1`,`Products_Option2`,`Products_Option3`,`Products_Image`, `Products_Unit`,`Products_Status`, `DateCreate`, `LastUpdate`) VALUES ";

  $values= array();
  $values = $_POST['txtoption'];
  $count = count($values);

  $codeoptions= array();
  $codeoptions = $_POST['codeoption'];

  if($_POST['txtoption'][0] !=  "")
  {
    $i = 0;  
    foreach($_POST['txtoption'] as $key => $val)
    {
      if($val !=  "")
      {   
        $createprd = str_pad($i+1, 6, "0", STR_PAD_LEFT);
        $product_codes= $product_code.$createprd;
        $meSQL .= "('$type','$cate','$product_codes','$codeoptions[$key]','$product_name','$product_detail','$values[$key]',NULL,NULL,'$q_pic','$product_unit','$status','$today','$today'),";
        $i++;
      }
   }
    $meSQL = substr($meSQL, 0, -1); 
    $meSQL .= "; ";
  }
  else
  {   
    $product_codes= $product_code."000001";
    $meSQL .= "('$type','$cate','$brand','$product_codes',NULL,'$product_name','$price','$product_detail',NULL,NULL,NULL,'$q_pic','$product_unit','$status','$today','$today') ;";
  }
   //echo $meSQL;

  $meQuery = mysqli_query($con,$meSQL);
  if($meQuery == TRUE) {
    echo "<script language='javascript'> alert('บันทึกข้อมูลเรียบร้อย');window.location='?product-view&p_ID=".$product_code."';</script>";
  }else{
    echo $meSQL;//"<script language='javascript'> alert('มีปัญหาในการบันทึกตัวเลือก กรุณาลองใหม่  err-01');</script>";
  }




/*
  if($count>0){
    for ($s=0;$s<=$count;$s++){
      if($values[$s] !=""){
        $meSQL .= "('$type','$cate','$product_code','$codeoptions[$s]','$product_name','$product_detail','$values[$s]',NULL,NULL,'$q_pic','$product_unit','$status','$today','$today'),";
      }

    }
    $meSQL = substr($meSQL, 0, -1); 
    $meSQL .= "; ";

  }else{
    $meSQL .= "('$type','$cate','$product_code',NULL,'$product_name','$product_detail',NULL,NULL,NULL,'$q_pic','$product_unit','$status','$today','$today') ;";
  }
  echo "<pre>";
  print_r($values);
  echo $count;
  echo $meSQL;
*/

 // $meQuery = mysqli_query($con,$meSQL);

}             
      
       
  

?>

 <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">เพิ่มสินค้า</h1>
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
    <input type="hidden" name="count" id="count" value="1">
      <div class="form-row">
        <div class="form-group col-md-12">
          <center>
          <img id="blah" style="width:200px" src="images/up_img.png"/>
          <div class="form-group col-md-3">
          <input type="file" class="form-control" name="product_pic" id="product_pic" onchange="readURL(this);" required= "required">
          </div>
          </center>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="select_type">หมวดหมู่สินค้า</label>
              <select name="select_type" id="select_type" class="form-control"  required= "required">
                    <option value="">เลือกหมวดสินค้า</option>
                    <?php
                    $tSQL = "SELECT * FROM  `products_types` ORDER BY Types_ID";
                    $tQuery = mysqli_query($con,$tSQL);

                    $i=1;
                    while ($tResult = mysqli_fetch_assoc($tQuery)){ ?>
                        <option value="<?php echo $tResult['Types_ID']; ?>"><?php echo $i.". ".$tResult['Types_Name']; ?></option>
                    <?php
                    $i++;
                    }
                    ?> 
              </select>
        </div>
       
        <div class="form-group col-md-6">
          <label for="selectex">ประเภทสินค้า</label>
            <select name="selectex" id="selectex" class="form-control selectex" onchange="" required= "required">
                <option value="">เลือกประเภทสินค้า</option> 
          </select>
        </div>
      </div>
      <div class="form-row">
      <div class="form-group col-md-6">
          <label for="select_brand">แบรนด์สินค้า</label>
           
                <select name="select_brand" id="select_brand" class="form-control"  required= "required">
                    <option value="">เลือกประเภทแบรนด์สินค้า</option>
                    <?php
                    $tSQL = "SELECT * FROM  `brand` ORDER BY brand_ID";
                    $tQuery = mysqli_query($con,$tSQL);

                    $i=1;
                    while ($tResult = mysqli_fetch_assoc($tQuery)){ ?>
                        <option value="<?php echo $tResult['brand_ID']; ?>"><?php echo $i.". ".$tResult['brand_name']; ?></option>
                    <?php
                    $i++;
                    }
                    ?> 
              </select>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="product_price">ราคา (บาท)</label>
          <input type="text" class="form-control" name="product_price" id="product_price" value="" pattern="[0-9]{1,}" title="กรอกตัวเลขเท่านั้น"  pattern="[0-9]{1,}" title="กรอกตัวเลขเท่านั้น" required="required"> 
        </div> 
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="product_name">ชื่อสินค้า</label>
          <input type="text" class="form-control" name="product_name" id="product_name" value="" required="required"> 
        </div>  
        <div class="form-group col-md-6">
          <label for="product_unit">หน่วยที่ใช้</label>
          <input type="text" class="form-control" name="product_unit" id="product_unit" value="" required= "required">
        </div>         
      </div>
      <div class="form-row">
      <div class="form-group col-md-12">
            <label for="product_detail" >รายละเอียดสินค้า</label>
            <textarea type="text" class="form-control" name="product_detail" id="product_detail" value="" required= "required"> </textarea>
        </div> 
      </div> 
      <!-- <div class="form-row" id="display01">
            <div class="form-group col-md-4">
              <input type="button" class="btn btn-block btn-outline-primary" value="สร้างตัวเลือกสินค้า"  onclick="btnShow()">
            </div>    
      </div>   -->
      <div class="form-row" id='display02' style='display:none;'>
        <div class="form-group col-md-12">
          <label for="product_name">ตัวเลือก</label>
          <div  id="content">
            <div class="form-group row " id="option1">
              <div class="col-md-4">
                <input type="text" class="form-control code_option" name="codeoption[]" id="optioncode" value="" placeholder="ใส่รหัสสินค้า"> 
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control add_option" name="txtoption[]" id="optiondetails" value="" placeholder="ใส่ตัวเลือกสินค้าเช่น S M...."> 
              </div>
              <div class="col-md-1">
                <input type="button" class="btn btn-danger btn-sm" value="X"  onclick="del_fields('option1');">
                </div>  
            </div>
          </div>  
        </div>
        <div class="form-row" id='display03'>
          <div class="col-md-4">
              <input type="button" class="btn btn-block btn-outline-primary" value="เพิ่มตัวเลือก"  onclick="add_fields();">
          </div>
         
        </div>
      </div>
      <div class="form-group row">
            <label for="product_status" >
            สถานะ
            </label>
            <div class="col-md-3">
              <div class="onoffswitch">
              <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" <?php echo empty($status)?'':'checked'?> >    
              <label class="onoffswitch-label" for="myonoffswitch">
                  <span class="onoffswitch-inner"></span>
                  <span class="onoffswitch-switch"></span>
              </label>
              </div>
            </div>   
        </div> 
      <div class="form-row">
        <div class="col-md-12">
            <center>
            <input type="submit" name="submit" class="btn btn-success" value="Upload" />
            <a href="?product" class="btn btn-secondary">กลับ</a> 
            </center> 
        </div>     
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

function btnShow(){
  var dp2 = document.getElementById("display02");
  var dp1 = document.getElementById("display01");
  dp2.style.display = 'block';
  dp1.style.display = 'none';
  
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
   var elm = document.getElementById("content");
   var cnt =  parseInt(document.getElementById("count").value);
  if (cnt < 15){
    count = cnt+1;
    var Sting = "<div class='form-group row' id='option"+count+"'><div class='col-md-4'><input type='text' class='form-control code_option' name='codeoption[]' id='optioncode' value='' placeholder='ใส่รหัสสินค้า'> </div><div class='col-md-4'><input type='text' class='form-control add_option' name='txtoption[]' id='optiondetails' value='' placeholder='ใส่ตัวเลือกสินค้าเช่น S M....'> </div><div class='col-md-1'><input type='button' class='btn btn-danger btn-sm' value='X'  onclick='del_fields("+'"'+"option"+count+'"'+");'> </div></div>"
    elm.insertAdjacentHTML( "beforeend", Sting )
    document.getElementById("count").value = count;
  }else{
    var dp3 = document.getElementById("display03");
    dp3.style.display = 'none';
  }
   
}
function del_fields(prm) {
   var d = document.getElementById("content");
   var elm = document.getElementById(prm);
   var cnt =  parseInt(document.getElementById("count").value);
    count = cnt-1;
    d.removeChild(elm);
    document.getElementById("count").value = count;
    if(count==0){
      var dp1 = document.getElementById("display01");
      dp1.style.display = 'block';
      var dp3 = document.getElementById("display03");
      dp1.style.display = 'none';
    }
  }
   



$(function(){
    var typeObject = $('#select_type');
    var optionObject = $('#selectex');

 
    // on change province
    typeObject.on('change', function(){
        var typeId = $(this).val();
 
        optionObject.html('<option value="">เลือกประเภทสินค้า</option>');

 
        $.get('get_option.php?t_id=' + typeId, function(data){
            var result = JSON.parse(data);
            $.each(result, function(index, item){
                optionObject.append(
                    $('<option></option>').val(item.Categorys_ID).html(item.Categorys_Name)
                );
            });
        });
    });
 
});
</script>

