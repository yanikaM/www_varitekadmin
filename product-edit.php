<?php
include('connect/conn.php');
$today = date("Y-m-d H:i:s");
$status =1;
if(isset($_POST['submit'])&& $_POST['submit'] == "Update"){

  $product_code= mysqli_real_escape_string($con,trim($_POST['p_ID']));
  $product_name = mysqli_real_escape_string($con,trim($_POST['product_name']));
  $product_detail = mysqli_real_escape_string($con,trim($_POST['product_detail']));
  $product_unit = mysqli_real_escape_string($con,trim($_POST['product_unit']));
 
  $count = mysqli_real_escape_string($con,trim($_POST['count']));
  $cate = mysqli_real_escape_string($con,trim($_POST['selectex']));
  $type = mysqli_real_escape_string($con,trim($_POST['select_type']));
  $status = mysqli_real_escape_string($con,trim($_POST['onoffswitch']));
  $brand = mysqli_real_escape_string($con,trim($_POST['select_brand']));
  $price = mysqli_real_escape_string($con,trim($_POST['product_price']));

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
            }else{
              $q_pic = mysqli_real_escape_string($con,trim($_POST['pic_name']));
            }

  $meSQL_del_p= " DELETE FROM products  WHERE Products_Code  LIKE '$product_code%'  ";
  $meQuerydel_p = mysqli_query($con,$meSQL_del_p);        
  if($meQuerydel_p == TRUE) {
    
      $meSQL = "INSERT INTO `products`  ( `Types_ID`,`Categorys_ID`,`brand_ID`,`Products_price`,`Products_Code`,`Products_Code2`, `Products_Name`, `Products_Description`,`Products_Option1`,`Products_Option2`,`Products_Option3`,`Products_Image`, `Products_Unit`,`Products_Status`, `DateCreate`, `LastUpdate`) VALUES ";

      $values= array();
      $values = $_POST['txtoption'];
      $count = count($values);

      $codeoptions= array();
      $codeoptions = $_POST['codeoption'];

      if($_POST['txtoption'][0] !=  "")
      {
        foreach($_POST['txtoption'] as $key => $val)
        {
          if($val !=  "")
          {   
            $createprd = str_pad($i+1, 6, "0", STR_PAD_LEFT);
            $product_codes= $product_code.$createprd;
            $meSQL .= "('$type','$cate','$product_codes','$codeoptions[$key]','$product_name','$product_detail','$values[$key]',NULL,NULL,'$q_pic','$product_unit','$status','$today','$today'),";
          }
          
      }
        $meSQL = substr($meSQL, 0, -1); 
        $meSQL .= "; ";
      }
      else
      {   
        $product_codes= $product_code."000001";
        $meSQL .= "('$type','$cate','$brand','$price','$product_codes',NULL,'$product_name','$product_detail',NULL,NULL,NULL,'$q_pic','$product_unit','$status','$today','$today') ;";
      }
     

      $meQuery = mysqli_query($con,$meSQL);
      if($meQuery == TRUE) {
        echo "<script language='javascript'> alert('บันทึกการแก้ไขข้อมูลเรียบร้อย');window.location='?product-edit&p_ID=".$product_code."';</script>";
      }else{
        echo "<script language='javascript'> alert('มีปัญหาในการบันทึกตัวเลือก กรุณาลองใหม่  err-02');</script>";
      }

  }else{
    echo "<script language='javascript'> alert('มีปัญหาในการบันทึกตัวเลือก กรุณาลองใหม่  err-01');</script>";
  }


}             

$p_ID = $_GET['p_ID'];
$today = date("Y-m-d h:i:s");
$query_prd = "SELECT *,p.Products_Code as code FROM products as p 
INNER JOIN brand as b
ON p.brand_ID = b.brand_ID
INNER JOIN products_categorys as c 
ON p.Categorys_ID=c.Categorys_ID 
INNER JOIN products_types as t
ON p.Types_ID = t.Types_ID
WHERE p.Products_Code  LIKE  '$p_ID%' 
GROUP BY p.Products_Code ";
$prd = mysqli_query($con, $query_prd) ;	
$row_prd = mysqli_fetch_assoc($prd);
$p_code= $row_prd['code'];
$p_name = $row_prd['Products_Name'];
  

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
    <input type="hidden" name="p_ID" id="p_ID" value="<?php echo $p_ID;?>">
    
      <div class="form-row">
        <div class="form-group col-md-12">
          <center>
          <img id="blah" style="width:200px" src="<?php echo $row_prd['Products_Image']?>"/>
          <div class="form-group col-md-3">
          <input type="file" class="form-control" name="product_pic" id="product_pic" onchange="readURL(this);" >
          <input type="hidden" name="pic_name" value="<?php echo $row_prd['Products_Image'];?>">  
          </div>
          </center>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="select_type">หมวดหมู่สินค้า</label>
              <select name="select_type" id="select_type" class="form-control"  required= "required">
                    <option value="<?php echo $row_prd['Types_ID']?>">ปัจจุบัน : <?php echo $row_prd['Types_Name']?></option>
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
                <option value="<?php echo $row_prd['Categorys_ID']?>">ปัจจุบัน : <?php echo $row_prd['Categorys_Name']?></option> 
          </select>
        </div>
      </div>
      <div class="form-row">
      <div class="form-group col-md-6">
          <label for="select_brand">แบรนด์สินค้า</label>
           
                <select name="select_brand" id="select_brand" class="form-control"  required= "required">
                    <option value="<?php echo $row_prd['brand_ID']?>">ปัจจุบัน : <?php echo $row_prd['brand_name']?></option>
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
          <input type="text" class="form-control" name="product_price" id="product_price" value="<?php echo $row_prd['Products_price']?>" pattern="[0-9]{1,}" title="กรอกตัวเลขเท่านั้น"  pattern="[0-9]{1,}" title="กรอกตัวเลขเท่านั้น" required="required"> 
        </div> 
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="product_name">ชื่อสินค้า</label>
          <input type="text" class="form-control" name="product_name" id="product_name" value="<?php echo $p_name;?>" required="required"> 
        </div>  
        <div class="form-group col-md-6">
          <label for="product_unit">หน่วยที่ใช้</label>
          <input type="text" class="form-control" name="product_unit" id="product_unit" value="<?php echo $row_prd['Products_Unit'];?>" required= "required">
        </div>         
      </div>
      <div class="form-row">
      <div class="form-group col-md-12">
            <label for="product_detail" >รายละเอียดสินค้า</label>
            <textarea type="text" class="form-control" name="product_detail" id="product_detail" value="" required= "required"><?php echo $row_prd['Products_Description'];?></textarea>
        </div> 
      </div> 

      
      <?php
		
              $query_opt = "SELECT Products_Code,Products_Code2,Products_Option1 FROM products  WHERE Products_Code LIKE '$p_ID%' ";
              $opt  = mysqli_query($con, $query_opt);
              $totalRows_opt = mysqli_num_rows($opt);
                 
              $i=1;
              ?>
              <div class="form-row" >
                <div class="form-group col-md-12">
                  <!-- <label for="product_name">ตัวเลือก</label> -->
                  <div  id="content">
                  <?php
                  while($rows = mysqli_fetch_assoc($opt)){
                    if($rows['Products_Option1'] !=""){
                  ?>
              
                    <div class="form-group row " id="option<?php echo $i;?>">
                      <div class="col-md-4">
                        <input type="text" class="form-control code_option" name="codeoption[]" id="optioncode" value="<?php echo $rows['Products_Code2'];?>" placeholder="ใส่รหัสสินค้า" > 
                      </div>
                      <div class="col-md-4">
                        <input type="text" class="form-control add_option" name="txtoption[]" id="optiondetails" value="<?php echo $rows['Products_Option1'];?>" placeholder="ใส่ตัวเลือกสินค้าเช่น S M...."> 
                      </div>
                      <div class="col-md-1">
                        <input type="button" class="btn btn-danger btn-sm" value="X"  onclick=" 
                                            var itemId = '<?php echo $rows['Products_Code'];?>';
                                            var option_d = '<?php echo $rows['Products_Option1'];?>';
                                                var r = confirm('ต้องการลบตัวเลือก '+option_d+' ใช่หรือไม่?');
                                                if(r == true){
                                                    get(itemId);
                                                }">
                        </div>  
                    </div>
                  
                <?php
                  }
                $i++;
              }
              
              ?>
              <input type="hidden" name="count" id="count" value="<?php echo $i-1;?>">
                </div>  
            </div>
          </div>
         
      
        <!-- <div class="form-row" id='display03'>
          <div class="col-md-4">
              <input type="button" class="btn btn-block btn-outline-primary" value="เพิ่มตัวเลือก"  onclick="add_fields();">
          </div>
         
        </div> -->
      </br>
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
            <input type="submit" name="submit" class="btn btn-success" value="Update" />
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

function get(itemId){
  var p_id = document.getElementById("p_ID").value;
$.ajax({
type: "GET",
data: {itemId: itemId},
url: "delete.php",
success: function(){
    
    window.location ='?product-edit&p_ID='+p_id;

    }
});

}
</script>

