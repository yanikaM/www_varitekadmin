<?php

include("connect/conn.php");
$today = date("Y-m-d h:i:s");
  if($_POST['submit'] == "Upload"){
    $ex_gname = mysqli_real_escape_string($con,trim($_POST['type_name']));

    $add_SQL = " INSERT INTO products_types (Types_Name) VALUE ('$ex_gname')";
    $add_Query = mysqli_query($con,$add_SQL);


    if($add_Query == TRUE) {
        echo "<script language='javascript'> alert('เพิ่มหมวดหมู่เรียบร้อย');window.location='?type';</script>";
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
        <h1 class="m-0 text-dark">เพิ่มหมวดหมู่สินค้า</h1>
      </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="index.php?type">Types</a></li></li>
          <li class="breadcrumb-item active">Add Type</li>
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
            <label for="type_name" class="col-md-2 col-form-label text-right">
            ชื่อหมวดหมู่สินค้า
            </label>
            
            <div class="col-md-5">
                <input type="text" class="form-control" name="type_name" id="type_name" value="" placeholder="ใส่ชื่อหมวดหมู่สินค้า" required= "required"> 
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


