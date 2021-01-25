
<?php

include("connect/conn.php");

    $id = $_GET["cate_ID"];
    $SQL = " SELECT * FROM products_categorys WHERE Categorys_ID = '$id' ";
    $Query = mysqli_query($con,$SQL);
    $ROW = mysqli_fetch_assoc($Query);

    if($_POST['submit'] == "Update"){

        

        $cate_name = mysqli_real_escape_string($con,trim($_POST['cate_name']));

        $update_SQL = " UPDATE products_categorys SET Categorys_Name = '$cate_name' WHERE Categorys_ID = '$id' ";
        $update_Query = mysqli_query($con,$update_SQL);

    
        if($update_Query == TRUE) {
            echo "<script language='javascript'> alert('แก้ไขข้อมูลเรียบร้อย');window.location='?cate';</script>";
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
        <h1 class="m-0 text-dark">แก้ไขประเภทสินค้า</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">categorys</li>
          <li class="breadcrumb-item active">Edit category</li>
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
      <h3 class="card-title"><?php echo $cname?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <form name="addtxt" method="post" action=""  enctype="multipart/form-data" >
    <div class="form-group row">
            <label for="cate_name" class="col-md-2 col-form-label text-right">
            ชื่อประเภทสินค้า
            </label>
            
            <div class="col-md-5">
                <input type="text" class="form-control" name="cate_name" id="cate_name" value="<?php  echo $ROW['Categorys_Name']; ?>" placeholder="ใส่ชื่อประเภทชุดแบบทดสอบ"> 
            </div> 

        </div>
        <div>
        <input type="hidden" name="cate_ID" class="btn btn-primary" value="<?php echo $ROW['Categorys_ID']; ?>" />
        <div class="col-md-10" >
          <center>

                       <input type="submit" name="submit" class="btn btn-primary" value="Update" />
  
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
