<?php

include("connect/conn.php");
$today = date("Y-m-d h:i:s");
$type_ID = $_GET['type_ID'];
$SQL = " SELECT * FROM products_types WHERE Types_ID = '$type_ID' ";
$Query = mysqli_query($con,$SQL);
$ROW = mysqli_fetch_assoc($Query);



  if( $_POST['submit'] == "Update"){
    $type_name = mysqli_real_escape_string($con,trim($_POST['type_name']));
    $type_id = mysqli_real_escape_string($con,trim($_POST['type_id']));
    

    $edit_SQL = " UPDATE products_types SET Types_Name = '$type_name' WHERE Types_ID = '$type_id ' ";
    $edit_Query = mysqli_query($con,$edit_SQL);


    if($edit_Query == TRUE) {
        echo "<script language='javascript'> alert('แก้ไขหมวดหมู่เรียบร้อย');window.location='?type';</script>";
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
        <h1 class="m-0 text-dark">แก้ไขหมวดหมู่สินค้า</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="index.php?type">Types</a></li></li>
          <li class="breadcrumb-item active">Edit Type</li>
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
                <input type="text" class="form-control" name="type_name" id="type_name" value="<?php echo $ROW['Types_Name'];?>" placeholder="ใส่ชื่อหมวดหมู่สินค้า"> 
                <input type="hidden" name="type_id" value="<?php echo $type_ID?>">
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


