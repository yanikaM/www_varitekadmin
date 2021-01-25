<?php
include("connect/conn.php");

if($_POST['submit'] == "add"){

    $add_username = $_POST['add_username'];
    $add_password = $_POST['add_password'];
    $add_name = $_POST['add_name'];
    $emp_ID = $_POST['emp_ID'];
    $permission = $_POST['permission'];

    $meSQL = "INSERT INTO `employees`";
		$meSQL .= "(Emp_username,Emp_password,Emp_name,Employees_ID,Emp_permistion) VALUES ";
		$meSQL .= "('{$add_username}','{$add_password}','{$add_name}','{$emp_ID}','{$permission}'";
		$meSQL .= ") ";
        $meQuery = mysqli_query($con,$meSQL);

        if ($meQuery == TRUE) {
            echo "<script language='javascript'> alert('บันทึกข้อมูลเรียบร้อย');window.location='?admin-manage';</script>";
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
            <h1 class="m-0 text-dark">Addmin add</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index-admin.php">Home</a></li>
              <li class="breadcrumb-item">Admin Manager</li>
              <li class="breadcrumb-item active">Admin add</li>
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
          <h3 class="card-title">เพิ่มชุดแอดมิน</h3>
        </div>
      
        <!-- /.card-header -->
        <div class="card-body">
        
        <form name="add_admin" method="post" action="">
        <div class="form-group row">
            <label for="add_name" class="col-md-2 col-form-label text-right">
            ชื่อแอดมิน
            </label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="add_name" id="add_name" value="" required="required"> 
            </div>    
        </div>
        <div class="form-group row">
            <label for="add_username" class="col-md-2 col-form-label text-right">
            username
            </label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="add_username" id="add_username" value="" required="required"> 
            </div>    
        </div>
        <div class="form-group row">
            <label for="add_password" class="col-md-2 col-form-label text-right">
            password
            </label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="add_password" id="add_password" value="" required="required"> 
            </div>    
        </div>
        <div class="form-group row">
            <label for="add_password" class="col-md-2 col-form-label text-right" required="required">
            รหัสพนักงาน
            </label>
            <div class="col-md-5">
                <input type="text" class="form-control" name="emp_ID" id="emp_ID" value=""> 
            </div>    
        </div>
        <div class="form-group row">
						<label for="keyword" class="col-md-2 col-form-label text-right">
            สถานะผู้ใช้งาน
            </label>
            <div class="col-md-5">
								<input type="radio" name="permission" value="1"/> Extra Admin
                &nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="permission" value="2"/> Admin 
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

