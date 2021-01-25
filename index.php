<?php
session_start();

header("Cache-Control: max-age=0; no-cache; no-store; must-revalidate");
error_reporting(E_ALL ^ E_NOTICE);
if (($_SESSION['LOGIN_ADMIN']) != 'adminlogin'){
  echo "<script>";
  echo "window.location ='login.php'";
  echo "</script>";
  exit();
}

include('connect/conn.php');

// $query_cate = "SELECT * FROM `products_price` as pr 
//  RIGHT JOIN  products as p
// ON pr.Products_Code = p.Products_Code
// WHERE Products_Status = 1  ORDER BY Products_ID " ;
// $rs_cate = mysqli_query($con, $query_cate);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Varitek | Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- jsGrid -->
  <link rel="stylesheet" href="plugins/jsgrid/jsgrid.min.css">
  <link rel="stylesheet" href="plugins/jsgrid/jsgrid-theme.min.css">
  
<style>
.onoffswitch {
    position: relative; width: 90px;
    -webkit-user-select:none; -moz-user-select:none; -ms-user-select: none;
}
.onoffswitch-checkbox {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}
.onoffswitch-label {
    display: block; overflow: hidden; cursor: pointer;
    border: 2px solid #999999; border-radius: 20px;
}
.onoffswitch-inner {
    display: block; width: 200%; margin-left: -100%;
    transition: margin 0.3s ease-in 0s;
}
.onoffswitch-inner:before, .onoffswitch-inner:after {
    display: block; float: left; width: 50%; height: 30px; padding: 0; line-height: 30px;
    font-size: 16px; color: white; font-family: Trebuchet, Arial, sans-serif; font-weight: bold;
    box-sizing: border-box;
}
.onoffswitch-inner:before {
    content: "ON";
    padding-left: 17px;
    background-color: #28D622; color: #FFFCFC;
}
.onoffswitch-inner:after {
    content: "OFF";
    padding-right: 17px;
    background-color: #FF0000; color: #FFFFFF;
    text-align: right;
}
.onoffswitch-switch {
    display: block; width: 18px; margin: 6px;
    background: #FFFFFF;
    position: absolute; top: 0; bottom: 0;
    right: 56px;
    border: 2px solid #999999; border-radius: 20px;
    transition: all 0.3s ease-in 0s; 
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-inner {
    margin-left: 0;
}
.onoffswitch-checkbox:checked + .onoffswitch-label .onoffswitch-switch {
    right: 0px; 
}

</style>
  
  <script type="text/javascript" src="../cdn/datatable/js/jquery.dataTables.min.js">
    </script>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-primary">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Menu -->
      <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            
            <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="images/user.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <label for="name" style="color:white;">
              <?php echo $_SESSION["emp_name"] ; ?>
            </label>
              
  
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item">
              <i class="fas fa-user-edit"></i> แก้ไขข้อมูลส่วนตัว
               
              </a>
              
              <div class="dropdown-divider"></div>
              
              <a href="logout.php" class="dropdown-item dropdown-footer" onclick="return confirm('คุณต้องการออกจากระบบใช่ไหม?')"><i class="fas fa-sign-out-alt"></i>ออกจากระบบ</a>
            </div>
          </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index-admin.php#" class="brand-link">
      <img src="images/asefa_logo.jpg" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Varitek-Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="?index" class="nav-link  <?php if(isset($_GET['index'])) echo 'active'; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
            <i class="fas fa-folder-open"></i>

              <p>
                จัดการข้อมูลหลัก
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="?news" class="nav-link  <?php if(isset($_GET['news']) || isset($_GET['news-add']) || isset($_GET['news-edit']) ) echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p> บทความข่าวสาร</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?type" class="nav-link  <?php if(isset($_GET['type']) || isset($_GET['type-add']) || isset($_GET['type-edit']) ) echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p> หมวดหมู่สินค้า</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?cate" class="nav-link  <?php if(isset($_GET['cate']) || isset($_GET['cate-add']) || isset($_GET['cate-edit'])) echo 'active'; ?>">
                <i class="far fa-circle nav-icon"></i>
                  <p> ประเภทสินค้า</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?brand" class="nav-link  <?php if(isset($_GET['brand']) || isset($_GET['brand-add']) || isset($_GET['brand-edit'])) echo 'active'; ?>">
                <i class="far fa-circle nav-icon"></i>
                  <p> แบรนด์สินค้า</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?product" class="nav-link <?php if(isset($_GET['product']) || isset($_GET['product-add']) || isset($_GET['product-edit']) || isset($_GET['product-view'])) echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>รายการสินค้า</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link <?php if(isset($_GET['promotion']) || isset($_GET['promotion-add']) || isset($_GET['promotion-edit']) || isset($_GET['promotion-view'])) echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>โปรโมชัน</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="?admin-manage" class="nav-link <?php if(isset($_GET['admin-manage']) || isset($_GET['admin-add'])) echo 'active'; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ผู้ใช้งานระบบ</p>
                </a>
              </li>
              
              
          </ul>
          <li class="nav-item" >
            <a href="?stock" class="nav-link <?php if(isset($_GET['stock']) || isset($_GET['stock-add']) || isset($_GET['stock-edit']) ) echo 'active'; ?>">
            <i class="fas fa-cog"></i>
              <p>
              จัดการสต็อคสินค้า
              </p>
            </a>
          </li>
          </li>
          

          

          <li class="nav-item" >
            <a href="?order&f=2" class="nav-link <?php if(isset($_GET['order']) || isset($_GET['order-view']) ) echo 'active'; ?>">
            <i class="fas fa-file-invoice"></i>
              <p>
              ออเดอร์
              </p>
            </a>
          </li>
          
          <li class="nav-item" >
            <a href="?cust" class="nav-link <?php if(isset($_GET['cust']) || isset($_GET['cust-add']) || isset($_GET['cust-edit']) ) echo 'active'; ?>">
            <i class="fas fa-users"></i>
              <p>
              ลูกค้า
              </p>
            </a>
          </li>

          <li class="nav-item" >
            <a href="?claim" class="nav-link <?php if(isset($_GET['claim']) ) echo 'active'; ?>">
            <i class="fas fa-wrench"></i>
              <p>
              แจ้งเคลม
              </p>
            </a>
          </li>
          
          <li class="nav-item" >
            <a href="?report" class="nav-link <?php if(isset($_GET['report'])) echo 'active'; ?>">
            <i class="fas fa-scroll"></i>
              <p>
              รายงาน
              </p>
            </a>
          </li>
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="col-md-12">
        <?php 
        if(isset($_GET['cate'])) {
          include('cate.php');                 
        }else if(isset($_GET['cate-add'])) {
          include('cate-add.php');                 
        }else if(isset($_GET['cate-edit'])) {
          include('cate-edit.php');                 
        }else if(isset($_GET['type'])) {
          include('type.php');                 
        }else if(isset($_GET['type-add'])) {
          include('type-add.php');                 
        }else if(isset($_GET['type-edit'])) {
          include('type-edit.php');                 
        }else if(isset($_GET['product'])) {
          include('product.php');                 
        }else if(isset($_GET['product-add'])) {
          include('product-add.php');                 
        }else if(isset($_GET['product-view'])) {
          include('product-view.php');                 
        }else if(isset($_GET['order-view'])) {
          include('order-view.php');                 
        }else if(isset($_GET['report'])) {
          include('report.php');                 
        }else if(isset($_GET['product-edit'])) {
          include('product-edit.php');                 
        }else if(isset($_GET['stock'])) {
          include('stock.php');                 
        }else if(isset($_GET['stock-add'])) {
          include('stock-add.php');                 
        }else if(isset($_GET['stock-edit'])) {
          include('stock-edit.php');                 
        }else if(isset($_GET['stock-view'])) {
          include('stock-view.php');                 
        }else if(isset($_GET['order'])) {
          include('order.php');                 
        }else if(isset($_GET['admin-add'])) {
          include('admin-manage-add.php');                 
        }else if(isset($_GET['admin-manage'])) {
          include('admin-manage.php');                 
        }else if(isset($_GET['price'])) {
          include('price.php');                 
        }else if(isset($_GET['price-add'])) {
          include('price-add.php');                 
        }else if(isset($_GET['price-edit'])) {
          include('price-edit.php');                 
        }else if(isset($_GET['news'])) {
          include('news.php');                 
        }else if(isset($_GET['news-add'])) {
          include('news-add.php');                 
        }else if(isset($_GET['news-edit'])) {
          include('news-edit.php');                 
        }else if(isset($_GET['brand'])) {
          include('brand.php');                 
        }else if(isset($_GET['brand-add'])) {
          include('brand-add.php');                 
        }else if(isset($_GET['brand-edit'])) {
          include('brand-edit.php');                 
        }else if(isset($_GET['promotion'])) {
          include('promotion.php');                 
        }else if(isset($_GET['promotion-add'])) {
          include('promotion-add.php');                 
        }else if(isset($_GET['promotion-edit'])) {
          include('promotion-edit.php');                 
        }else if(isset($_GET['cust'])) {
          include('customer.php');                 
        }else if(isset($_GET['cust-add'])) {
          include('customer-add.php');                 
        }else if(isset($_GET['cust-edit'])) {
          include('customer-edit.php');                 
        }else if(isset($_GET['claim'])) {
          include('claim.php');                 
        }else if(isset($_GET['index'])) {
          include('dashboard.php');                 
        }else{
          include('dashboard.php'); 
        }
        ?>

        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="">Asefa Public Company limited</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 2.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<!-- <script src="plugins/jquery/jquery.min.js"></script> -->
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>


</body>
</html>
