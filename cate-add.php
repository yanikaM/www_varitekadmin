<?php

include("connect/conn.php");
$today = date("Y-m-d h:i:s");
  if(isset($_POST['submit']) && $_POST['submit'] == "Upload"){
    $cate_name = mysqli_real_escape_string($con,trim($_POST['cate_name']));
    

    if($_POST['select_type']=="add"){
      $type_name = mysqli_real_escape_string($con,trim($_POST['type_name']));
      if($type_name==""){
        echo "<script language='javascript'> alert('กรุณากรอกชื่อหมวดสินค้า');window.history.back(-1);</script>";
        exit();
        }

      $type_SQL = "INSERT INTO products_types (Types_Name) VALUES ('$type_name')";
      $type_Query = mysqli_query($con,$type_SQL);

      
  
        if ($type_Query == FALSE) {
          echo "<script language='javascript'> alert('มีปัญหาในการบันทึกข้อมูล err-01');</script>";
          
        }else{
         
          $SQL = "SELECT Types_ID FROM products_types WHERE Types_ID != '9999' ORDER BY Types_ID DESC ";
          $Query = mysqli_query($con,$SQL);
          $ROW = mysqli_fetch_assoc($Query);
          $select_type = $ROW["Types_ID"];
        }
    }else{
          $select_type = mysqli_real_escape_string($con,trim($_POST['select_type']));
    }
    
    
    $add_SQL = " INSERT INTO products_categorys (Categorys_Name,Types_ID) VALUE ('$cate_name','$select_type')";
    
    $add_Query = mysqli_query($con,$add_SQL);


    if($add_Query == TRUE) {
        echo "<script language='javascript'> alert('เพิ่มข้อมูลเรียบร้อย');window.location='?cate';</script>";
        }else{
          echo "<script language='javascript'> alert('มีปัญหาในการบันทึกข้อมูล กรุณาลองใหม่ err-02');</script>";
        }

  }

?>
 <!-- Content Header (Page header) -->
 <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">เพิ่มประเภทสินค้า</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">category</li>
          <li class="breadcrumb-item active">Add category</li>
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
      <h3 class="card-title"></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <form name="addtxt" method="post" action=""  enctype="multipart/form-data" >
    <div class="form-group row">
            <label for="cate_name" class="col-md-2 col-form-label text-right">
            หมวดหมู่สินค้า
            </label>
            
            <div class="col-md-5">
                <select name="select_type" id="select_type" class="form-control" onchange="sSelect()" required= "required">
                    <option value="">เลือกหมวดหมู่สินค้า</option>
                    <?php
                    $CtSQL = "SELECT * FROM  `products_types`  ORDER BY Types_ID ASC";
                    $CtQuery = mysqli_query($con,$CtSQL);

                    $i=1;
                    while ($CtResult = mysqli_fetch_assoc($CtQuery)){ ?>
                        <option value="<?php echo $CtResult['Types_ID']; ?>"><?php echo $i.". ".$CtResult['Types_Name']; ?></option>
                    <?php
                    $i++;
                    }
                    ?>
                    <option value="add">เพิ่มหมวดหมู่สินค้า</option>
                </select>             
            </div>
            
        </div>
            <div id='display' style='display:none;' class="col-md-5 offset-2">
                <input type="text" class="form-control" name="type_name" id="type_name" value="" placeholder="ใส่ชื่อหมวดหมู่สินค้า"> 
            </div>
        <div class="form-group row">
        </div>
    <div class="form-group row">
            <label for="cate_name" class="col-md-2 col-form-label text-right">
            ชื่อประเภทสินค้า
            </label>
            
            <div class="col-md-5">
                <input type="text" class="form-control" name="cate_name" id="cate_name" value="" placeholder="ใส่ชื่อประเภทสินค้า" required= "required"> 
            </div> 

        </div>


        <div class="col-md-10" >
          <center>
            <input type="submit" name="submit" class="btn btn-success" value="Upload" />
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

<script>
function sSelect(){
  var dp = document.getElementById("display");

  var chk = document.getElementById("select_type").value;
  if (chk=="add"){
    dp.style.display = 'block';
  }else{
    dp.style.display = 'none';
  }
}
</script>

