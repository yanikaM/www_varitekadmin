<?php

include("connect/conn.php");
$today = date("Y-m-d h:i:s");
$brand_ID = $_GET['brand_ID'];
$SQL = " SELECT * FROM brand WHERE brand_ID = '$brand_ID' ";
$Query = mysqli_query($con,$SQL);
$ROW = mysqli_fetch_assoc($Query);



  if( $_POST['submit'] == "Update"){
    $brand_name = mysqli_real_escape_string($con,trim($_POST['brand_name']));
    $brand_ID = mysqli_real_escape_string($con,trim($_POST['brand_ID']));
    

    $edit_SQL = " UPDATE brand SET brand_name = '$brand_name' WHERE brand_ID = '$brand_ID ' ";
    $edit_Query = mysqli_query($con,$edit_SQL);


    if($edit_Query == TRUE) {
        echo "<script language='javascript'> alert('แก้ไขแบรนด์เรียบร้อย');window.location='?brand';</script>";
        }else{
          echo "<script language='javascript'> alert('มีปัญหาในการแก้ไขข้อมูล กรุณาลองใหม่');</script>";
        }

  }

?>
 <!-- Content Header (Page header) -->
 <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">แก้ไขแบรนด์หมู่สินค้า</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="index.php?type">Brand</a></li></li>
          <li class="breadcrumb-item active">Edit Brand</li>
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
            <label for="brand_name" class="col-md-2 col-form-label text-right">
            ชื่อแบรนด์สินค้า
            </label>
            
            <div class="col-md-5">
                <input type="text" class="form-control" name="brand_name" id="brand_name" value="<?php echo $ROW['brand_name'];?>" placeholder="ใส่ชื่อหมวดหมู่สินค้า"> 
                <input type="hidden" name="brand_ID" value="<?php echo $brand_ID?>">
            </div> 
                
        </div>


        <div class="col-md-10" >
          <center>
            <input type="submit" name="submit" class="btn btn-success" value="Update" />
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


