<?php
include("connect/conn.php");
$custs = $_GET['Customer_ID'];
$query_cust = "SELECT * FROM `customers` WHERE Customer_ID = '$custs'" ;

$rs_cust = mysqli_query($con, $query_cust);
$ROW = mysqli_fetch_assoc($rs_cust);


if($_POST['submit'] == "saveedit"){

  
    $name = $_POST['cust_name'];
    $email = $_POST['cust_email'];
    $phone = $_POST['cust_phone'];
    $cust = $_POST['cust_ID'];
    
    

    $meSQL = "UPDATE customers SET Customer_Name = '$name',Customer_Email= '$email',Customer_Phone='$phone' WHERE Customer_ID = '$cust'";
        $meQuery = mysqli_query($con,$meSQL);

        if ($meQuery == TRUE) {
            echo "<script language='javascript'> alert('บันทึกข้อมูลลูกค้าเรียบร้อย');window.location='?cust';</script>";
		    } else {

               echo "<script language='javascript'> alert('มีปัญหาในการบันทึกข้อมูล กรุณาลองใหม่');</script>";
               
		    }
		     
		
}

?>

<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Customer Edit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index-admin.php">Home</a></li>
              <li class="breadcrumb-item">Customer Manager</li>
              <li class="breadcrumb-item active">Customer Edit</li>
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
          <h3 class="card-title">แก้ไขลูกค้า</h3>
        </div>
      
        <!-- /.card-header -->
        <div class="card-body">
        
        <form name="add_admin" method="post" action="">
        <input type="hidden" name="cust_ID" value="<?php echo $custs;?>">
        <div class="form-group row">
            <label for="cust_name" class="col-md-2 col-form-label text-right">
            ชื่อลูกค้า
            </label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="cust_name" id="cust_name" value="<?php echo $ROW['Customer_Name'];?>" required="required"> 
            </div>    
        </div>
        
        <div class="form-group row">
            <label for="cust_phone" class="col-md-2 col-form-label text-right" required="required">
            เบอร์โทร
            </label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="cust_phone" id="cust_phone" value="<?php echo $ROW['Customer_Phone'];?>"> 
            </div>    
        </div>
        <div class="form-group row">
            <label for="cust_email" class="col-md-2 col-form-label text-right" required="required">
            อีเมล
            </label>
            <div class="col-md-5">
                <input type="email" class="form-control" name="cust_email" id="cust_email" value="<?php echo $ROW['Customer_Email'];?>"> 
            </div>    
        </div>
      
        <div class="form-group row">
            <div class="col-md-1 offset-3">
              <input type="submit" name="submit" class="btn btn-success" value="saveedit" />
            </div>
        </div>
        </form>
        <br />

            <br />
           

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>

