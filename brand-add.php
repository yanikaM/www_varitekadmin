<?php

include("connect/conn.php");
$today = date("Y-m-d-h-i-s");
  if($_POST['submit'] == "Upload"){
    $ex_gname = $_POST['brand_name'];
    $ext = pathinfo(basename($_FILES['brand_pic']['name']), PATHINFO_EXTENSION);
            if($ext!=""){ 
              $new_pic_name = $today."_picture.".$ext;
              $img_path = "images/brands/";
              $upload_path = $img_path.$new_pic_name;
              $success = move_uploaded_file($_FILES['brand_pic']['tmp_name'], $upload_path);
              $q_pic = $upload_path;
            
            }

    $add_SQL = " INSERT INTO brand (brand_name,brand_img) VALUE ('$ex_gname','$upload_path')";
    $add_Query = mysqli_query($con,$add_SQL);


    if($add_Query == TRUE) {
        echo "<script language='javascript'> alert('เพิ่มแบรนนด์เรียบร้อย');window.location='?brand';</script>";
        }else{
          echo "<script language='javascript'> alert('มีปัญหาในการบันทึกข้อมูล กรุณาลองใหม่');</script>";
        }

  }

?>
 <!-- Content Header (Page header) -->
 <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">เพิ่มแบรนด์สินค้า</h1>
      </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="index.php?type">Brand</a></li></li>
          <li class="breadcrumb-item active">Add Brand</li>
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
          <label for="brand_pic" class="col-md-2 col-form-label text-right">
          ภาพแบรนด์สินค้า
            </label>
    </div>
  
            <div class="form-group col-md-12">
          <center>
          <img id="blah" style="width:200px" src="images/up_img.png"/>
          <div class="form-group col-md-3">
          <input type="file" class="form-control" name="brand_pic" id="brand_pic" onchange="readURL(this);" required= "required">
          </div>
          </div>
    <div class="form-group row">
            <label for="type_name" class="col-md-2 col-form-label text-right">
            ชื่อแบรนด์สินค้า
            </label>
            
            <div class="col-md-5">
                <input type="text" class="form-control" name="brand_name" id="brand_name" value="" placeholder="ใส่ชื่อแบรนด์สินค้า" required= "required"> 
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
<script>
function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>

