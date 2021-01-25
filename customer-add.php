<?php
include("connect/conn.php");

if($_POST['submit'] == "add"){

    $cust_username = $_POST['cust_username'];
    $cust_password = $_POST['cust_password'];
    $cust_name = $_POST['cust_name'];
    $level = $_POST['level'];
    $cust_password = $_POST['cust_email'];
    $cust_password = $_POST['cust_phone'];
    
    

    $meSQL = "INSERT INTO `customers`";
		$meSQL .= "(Customer_Name	,Customer_Username,Customer_Password,Customer_Phone,Customer_Email,Customer_Lavel) VALUES ";
		$meSQL .= "('{$cust_name}','{$cust_username}','{$cust_password}','{$cust_phone}','{$cust_email}','{$level}'";
		$meSQL .= ") ";
        $meQuery = mysqli_query($con,$meSQL);

        if ($meQuery == TRUE) {
            echo "<script language='javascript'> alert('บันทึกข้อมูลลูกค้าเรียบร้อย');window.location='?cust';</script>";
		    } else {
          echo $meSQL;
               // echo "<script language='javascript'> alert('มีปัญหาในการบันทึกข้อมูล กรุณาลองใหม่');</script>";
               
		    }
		     
		
}

?>

<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Customer add</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index-admin.php">Home</a></li>
              <li class="breadcrumb-item">Customer Manager</li>
              <li class="breadcrumb-item active">Customer add</li>
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
          <h3 class="card-title">เพิ่มลูกค้า</h3>
        </div>
      
        <!-- /.card-header -->
        <div class="card-body">
        
        <form name="add_admin" method="post" action="">
        <div class="form-group row">
            <label for="cust_name" class="col-md-2 col-form-label text-right">
            ชื่อลูกค้า
            </label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="cust_name" id="cust_name" value="" required="required"> 
            </div>    
        </div>
        <div class="form-group row">
            <label for="cust_username" class="col-md-2 col-form-label text-right">
            username
            </label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="cust_username" id="cust_username" value="" required="required"> 
            </div>    
        </div>
        <div class="form-group row">
            <label for="cust_password" class="col-md-2 col-form-label text-right">
            password
            </label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="cust_password" id="cust_password" value="" required="required"> 
            </div>    
        </div>
        <div class="form-group row">
            <label for="cust_phone" class="col-md-2 col-form-label text-right" required="required">
            เบอร์โทร
            </label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="cust_phone" id="cust_phone" value=""> 
            </div>    
        </div>
        <div class="form-group row">
            <label for="cust_email" class="col-md-2 col-form-label text-right" required="required">
            อีเมล
            </label>
            <div class="col-md-5">
                <input type="email" class="form-control" name="cust_email" id="cust_email" value=""> 
            </div>    
        </div>
        <div class="form-group row">
						<label for="keyword" class="col-md-2 col-form-label text-right">
            Level
            </label>
            <div class="col-md-5">
								<input type="radio" name="level" value="1" disabled /> Dealer
                &nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="level" value="2"/> Member 
            </div>       
				</div>
        <div class="form-group row">
            <div class="col-md-1 offset-3">
              <input type="submit" name="submit" class="btn btn-success" value="add" />
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

