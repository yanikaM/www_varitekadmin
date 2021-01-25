<?php
  include("connect/conn.php");
$p_ID = $_GET['p_ID'];

$query_prd = "SELECT *,p.Products_Code as code FROM products as p 

INNER JOIN products_categorys as c 
ON p.Categorys_ID=c.Categorys_ID 
INNER JOIN products_types as t
ON p.Types_ID = t.Types_ID
WHERE p.Products_Code LIKE  '$p_ID%' 
GROUP BY p.Products_Code ";

$prd = mysqli_query($con, $query_prd) ;	
$row_prd = mysqli_fetch_assoc($prd);
$p_code= $row_prd['code'];
$p_name = $row_prd['Products_Name'];

//echo $query_prd;

?>
 <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">รายละเอียดสินค้า</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="index.php?product">products</a></li>
            <li class="breadcrumb-item active">View product</li>
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

    </div>
    <!-- /.card-header -->
    <div class="card-body">
    
    <div class="form-row">
        <div class="form-group col-md-2">
          <label>ภาพสินค้า</label>
        </div>
        <div class="form-group col-md-3">
           <img id="blah" style="width:200px" src="<?php echo $row_prd['Products_Image'];?>"/>
        </div>    
    </div> 
    <div class="form-row">
        <div class="form-group  col-md-2">
          <label>หมวดหมู่</label>
        </div> 
        <div class="form-group  col-md-3 text-primary">
          <?php echo $row_prd['Types_Name']?>  
        </div>         
    </div>
    <div class="form-row">
        <div class="form-group col-md-2">
          <label>ประเภทสินค้า</label>
        </div> 
        <div class="form-group col-md-3 text-primary">
          <?php echo $row_prd['Categorys_Name']?>  
        </div>         
    </div>
    <div class="form-row">
        <div class="form-group col-md-2">
          <label>ชื่อสินค้า</label>
        </div> 
        <div class="form-group col-md-3 text-primary">
          <?php echo $p_name ;?>  
        </div>         
    </div>
    <div class="form-row">
        <div class="form-group col-md-2">
          <label>รายละเอียดสินค้า</label>
        </div> 
        <div class="form-group col-md-3 text-primary">
          <?php echo $row_prd['Products_Description'];?>  
        </div>         
    </div>
    <div class="form-row">
        <div class="form-group col-md-2">
          <label>ราคา</label>
        </div> 
        <div class="form-group col-md-1 text-primary">
          <?php echo number_format($row_prd['Products_price'],2);?>  
        </div>  
        <label>บาท</label>       
    </div>
    <div class="form-row">
        <div class="form-group col-md-2">
          <label>หน่วยที่ใช้</label>
        </div> 
        <div class="form-group col-md-3 text-primary">
          <?php echo $row_prd['Products_Unit'];?>  
        </div>         
    </div>
     
        <?php
		
            $query_opt = "SELECT Products_Code2,Products_Option1 FROM products  WHERE Products_Code LIKE '$p_ID%' ";
            $opt  = mysqli_query($con, $query_opt);
            $totalRows_opt = mysqli_num_rows($opt);
            if($totalRows_opt>0){           
            $i=1;
				    while($rows = mysqli_fetch_assoc($opt)){
              if($rows['Products_Option1'] !=""){
            ?>
            <div class="form-row">
                <div class="form-group col-md-2">
                  <label for="">ตัวเลือกที่<?php echo $i;?>   </label>
                </div> 
                <div class="form-group col-md-3 text-primary"> 
                    <?php echo $rows['Products_Code2']." - ".$rows['Products_Option1'] ;?>
                </div>                
            </div>
            <?php
              }
            $i++;
            }
            ?>
        <?php
        }
        ?>
        
        
        <div class="form-row">
          <div class="form-group col-md-2">
            <label>สถานะ</label>
          </div> 
          <div class="form-group col-md-3">
                <?php
                if($row_prd['Products_Status'] == '1'){?>
                  <span class="badge badge-success">ON</span>
                <?php
                }else{
                ?>
                  <span class="badge badge-secondary">OFF</span>
                <?php
                }
                ?>
          </div>         
        </div>           
    
        <div class="col-md-10" >
          <center>
            <a href="?product" class="btn btn-secondary">กลับ</a>
          </center>  
        </div>    
      

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
<script>
  var cnt = 1;
  document.getElementById("count").value = cnt;
function btnShow(){
  var dp2 = document.getElementById("display02");
  dp2.style.display = 'block';
  
}
function sSelect(){
  var dp = document.getElementById("display");
  var chk = document.getElementById("selectex").value;

  document.getElementById("product__code2").value=chk;

  if (chk=="add"){
    dp.style.display = 'block';

  }else{
    dp.style.display = 'none';
    
  }
}

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

function add_fields() {
   var d = document.getElementById("content");
  if (cnt < 15){
    d.innerHTML += "<br><span><input type='text' class='form-control add_option' name='txtoption[]' placeholder='ใส่ตัวเลือกสินค้าเช่น S M....' value='' /></span>";

    cnt = cnt+1;
    document.getElementById("count").value = cnt;
  }else{
    alert('เพิ่ม ตัวเลือกได้ 15 ตัวเลือก เท่านั้น');
  }
   
}

</script>

