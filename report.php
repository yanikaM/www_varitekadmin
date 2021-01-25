<?php
include('connect/conn.php');


$query = "
SELECT p.Products_Name, SUM(d.Products_Qty*p.Products_price) AS total ,p.Products_Image
FROM orders_detail as d
INNER JOIN products as p ON p.Products_ID=d.Products_ID
GROUP BY d.Products_ID ORDER BY  total DESC LIMIT 5 
";
$result = mysqli_query($con, $query);
$resultchart = mysqli_query($con, $query);
$p_name = array();
$total = array();
while($rs = mysqli_fetch_array($resultchart)){
$p_name[] = "\"".$rs['Products_Name']."\"";
$total[] = "\"".$rs['total']."\"";
}
$p_name = implode(",", $p_name);
$total = implode(",", $total);



  

//   $sql_ord.= " GROUP BY d.Orders_No ORDER BY o.Orders_ID DESC" or die ("Error : ".mysqlierror($sql_product));

//echo ($query_level);//test query
?>
  <link rel="stylesheet" type="text/css" href="http://dev_inno.asefa.co.th/cdn/datatable/css/dataTables.bootstrap4.min.css">
	<script src="http://dev_inno.asefa.co.th/cdn/jquery-3.4.1.min.js"></script>
	<script src="http://dev_inno.asefa.co.th/cdn/datatable/js/jquery.dataTables.min.js"></script>
	<script src="http://dev_inno.asefa.co.th/cdn/datatable/js/dataTables.bootstrap4.min.js"></script>
 <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-2">
          
          </div><!-- /.col -->
          <div class="col-sm-2">
          </div><!-- /.col -->
          <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">report</li>
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
          <h3 class="card-title">รายงานสินค้าขายดี 5 อันดับ</h3>
        </div>
        
        <!-- /.card-header -->
        <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="50"><center>No.</center></th>
                    <th width="">ชื่อสินค้า</th>
                    <th width="">ภาพ</th>
                    <th width="">ยอดขาย</th>
                </tr>
            </thead>
            
            <?php 
            $i=1;
            while($row = mysqli_fetch_array($result)) { ?>
            <tr>
                <td align="center"><?php echo $i;?></td>
                <td><?php echo $row['Products_Name'];?></td>
                <td><img src="<?php echo $row['Products_Image']; ?>" alt="" width= "100"></td>
                <td><?php echo number_format($row['total'],2)." บาท";?></td>
            </tr>
            
            <?php
            $at += $row['total'];
            $i++;
            }
            //echo $at;
            ?>
            <tr>
                <td align="center" colspan="3">รวม</td>
                <td align="right" bgcolor="yellow"> <b> <?php echo number_format($at,2)." บาท";?></b></td>
            </tr>
        </table>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
        <hr>
        <p align="center">
            <!--devbanban.com-->
            <canvas id="myChart" width="800px" height="300px"></canvas>
        
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>

  <script>
    var ctx = document.getElementById("myChart").getContext('2d');
    
    var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
    labels: [<?php echo $p_name;?>
    
    ],
    datasets: [{
    label: 'รายงานสินค้าขายดี(บาท)',
    data: [<?php echo $total;?>
    ],
    backgroundColor: [
    'rgba(255, 99, 132, 0.2)',
    'rgba(54, 162, 235, 0.2)',
    'rgba(255, 206, 86, 0.2)',
    'rgba(75, 192, 192, 0.2)',
    'rgba(153, 102, 255, 0.2)',
    'rgba(255, 159, 64, 0.2)'
    ],
    borderColor: [
    'rgba(255,99,132,1)',
    'rgba(54, 162, 235, 1)',
    'rgba(255, 206, 86, 1)',
    'rgba(75, 192, 192, 1)',
    'rgba(153, 102, 255, 1)',
    'rgba(255, 159, 64, 1)'
    ],
    borderWidth: 1
    }]
    },
    options: {
    scales: {
    yAxes: [{
    ticks: {
    beginAtZero:true
    }
    }]
    }
    }
    });
    </script>
 

