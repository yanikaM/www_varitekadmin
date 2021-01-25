



    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

        <!-- Small boxes (Stat box) -->
<?php
$sql_ord= "SELECT *,COUNT(d.Products_Qty) as cnt,SUM(Products_price*Products_Qty) as sum FROM `orders` as o
INNER JOIN customers as c
ON o.Customer_ID = c.Customer_ID
INNER JOIN orders_detail as d
ON o.Orders_No = d.Orders_No
INNER JOIN products as p
                    ON d.Products_ID = p.Products_ID
WHERE 1 AND Orders_Status = '2' GROUP BY d.Orders_No ORDER BY d.Orders_Detail_ID DESC";
$query_ord = mysqli_query($con, $sql_ord);
$cnt_ord = mysqli_num_rows($query_ord);
?>
<div class="row">
        <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $cnt_ord;?></h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-notifications"></i>
              </div>
              <a href="index.php?order&f=2" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <?php
            $sql_ord2= "SELECT *,COUNT(d.Products_Qty) as cnt,SUM(Products_price*Products_Qty) as sum FROM `orders` as o
            INNER JOIN customers as c
            ON o.Customer_ID = c.Customer_ID
            INNER JOIN orders_detail as d
            ON o.Orders_No = d.Orders_No
            INNER JOIN products as p
            ON d.Products_ID = p.Products_ID
            WHERE 1 GROUP BY d.Orders_No ORDER BY d.Orders_Detail_ID DESC";
            $query_ord2 = mysqli_query($con, $sql_ord2);
            $cnt_ord2 = mysqli_num_rows($query_ord2);
            ?>  
                      <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $cnt_ord2;?></h3>

                <p>All Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-cart"></i>
              </div>
              <a href="index.php?order" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <?php
            $sql_cust= "SELECT * FROM `customers`";
            $query_cust = mysqli_query($con, $sql_cust);
            $cnt_cust = mysqli_num_rows($query_cust);
            ?>  
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $cnt_cust;?></h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <?php
            $sql_prd= "SELECT * FROM `products` WHERE Products_Status = '1' ";
            $query_prd = mysqli_query($con, $sql_prd);
            $cnt_prd = mysqli_num_rows($query_prd);
            ?>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h2><?php echo $cnt_prd;?></h2>

                <p>Products active</p>
              </div>
              <div class="icon">
                <i class="ion ion-pricetag"></i>
              </div>
              <a href="index.php?product" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        


        <!-- Main row -->
        <div class="row">
          <div class="col-md-6">

            <!-- TABLE: LATEST ORDERS -->
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Latest Orders</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Item qty</th>
                      <th>Status</th>
                      <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
              
                    $sql_ord3= "SELECT *,COUNT(d.Products_Qty) as cnt,SUM(Products_price*Products_Qty) as sum FROM `orders` as o
                    INNER JOIN customers as c
                    ON o.Customer_ID = c.Customer_ID
                    INNER JOIN orders_detail as d
                    ON o.Orders_No = d.Orders_No
                    INNER JOIN products as p
                    ON d.Products_ID = p.Products_ID
                    WHERE 1 GROUP BY d.Orders_No ORDER BY o.LastUpdate DESC LIMIT 7";
                    $query_ord3 = mysqli_query($con, $sql_ord3);
                    $i=1;
                    while ($row_ords = mysqli_fetch_assoc($query_ord3)) { 
                      $order_no =   $row_ords['Orders_No'];
                    ?>
                    <tr>
                      <td><?php echo $order_no;?></td>
                      <td><?php echo $row_ords['cnt'];?></td>
                      <td>
                      <?php 
                        $status = $row_ords['Orders_Status']; 
                            if($status==1){ ?>
                                <span class="badge badge-info"> รอชำระเงิน</span>
                            <?php  }elseif($status==2){
                                ?>
                                <span class="badge badge-warning">  ชำระเงินแล้วรอยืนยัน   </span>
                                <?php 
                            }elseif($status==3){
                                ?>
                                <span class="badge badge-primary">รอจัดส่งสินค้า</span>
                                <?php 
                            }elseif($status==4){
                                ?>
                                <span class="badge badge-success">จัดส่งสินค้าเรียบร้อย</span>
                                <?php 
                            }
                            elseif($status==0){
                                ?>
                                <span class="badge badge-secondary"> ยกเลิกคำสั่งซื้อ </span>
                                <?php 
                            }

                        ?>
                      </td>
                      <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20"><?php echo $row_ords['LastUpdate'];?></div>
                      </td>
                    </tr>
                    <?php 
                    }
                    ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="index.php?order" class="uppercase">View All Orders</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>

          <?php
            $sql_prd2= "SELECT * FROM `products` as p 
            
            INNER JOIN products_categorys as c ON p.Categorys_ID=c.Categorys_ID WHERE Products_Status = '1' ORDER BY p.LastUpdate DESC Limit 5 ";
            $query_prd2 = mysqli_query($con, $sql_prd2);
            ?>
          <div class="col-md-6">
            <!-- PRODUCT LIST -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Recently Added Products</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  <?php
                    while ($row_prd2 = mysqli_fetch_assoc($query_prd2)) { 
                    ?>
                  <li class="item">
                    <div class="product-img">
                      <img src="<?php echo $row_prd2['Products_Image'];?>" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="?product-view&p_ID=<?php echo $row_prd2['Products_ID'];?>" class="product-title"><?php echo $row_prd2['Products_Name'];?>
                        <span class="badge badge-danger float-right">฿ <?php echo $row_prd2['Products_price'];?></span></a>
                      <span class="product-description">
                          <?php echo $row_prd2['Products_Description'];?>
                      </span>
                    </div>
                  </li>
                  <!-- /.item -->
                  <?php
                    }
                    ?>
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="index.php?product" class="uppercase">View All Products</a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
      
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 