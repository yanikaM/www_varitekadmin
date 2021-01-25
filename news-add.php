<?php

include("connect/conn.php");
$today = date("Y-m-d-h-i-s");
  if($_POST['submit'] == "Upload"){
    $ext = pathinfo(basename($_FILES['news_pic']['name']), PATHINFO_EXTENSION);
            if($ext!=""){ 
              $new_pic_name = $today."_picture.".$ext;
              $img_path = "images/news/";
              $upload_path = $img_path.$new_pic_name;
              $success = move_uploaded_file($_FILES['news_pic']['tmp_name'], $upload_path);
              $q_pic = $upload_path;
            
            }
    
    
   
    //** ทำการเพิ่มข้อมูลลงในตาราง news และแสดง popupว่าทำรายการเสร็จ **/
    $txt = "INSERT INTO news(news_topic,news_detail,news_photo,LastUpdate) VALUES ('".$_POST['news_topic']."','".$_POST['news_detail']."','".$q_pic."',CURDATE() )";
    $add_Query = mysqli_query($con,$txt);


    if($add_Query == TRUE) {

        echo "<script language='javascript'> alert('เพิ่มบทความเรียบร้อย');window.location='?news';</script>";
        }else{
          echo $txt;
        }

  }

?>
<script src="https://cdn.ckeditor.com/ckeditor5/12.1.0/classic/ckeditor.js"></script>
  <style type="text/css">
        html{
            font-family:tahoma, Arial,"Times New Roman";
            font-size:15px;
        }
        body{
            font-family:tahoma, Arial,"Times New Roman";
            font-size:15px;
        }.container{ /* กำหนดส่วนของ เนื้อหา ทั้งหมด */
            width: 700px; /* กำหนดความกว้าง ของทั้ง 3 คอลัมน์รวมกัน */
            margin:auto;
        }   
    </style>
 <!-- Content Header (Page header) -->
 <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">เพิ่มบทความ</h1>
      </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="index.php?news">News</a></li></li>
          <li class="breadcrumb-item active">Add News</li>
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
    <form action="" name="news-add" method="post" enctype="multipart/form-data">
      <br>
          <div class="input-group mt-3 mb-3">
            <p>หัวข้อข่าว &nbsp :</p> &nbsp&nbsp&nbsp<input type="text" class="form-control form-control " name="news_topic">
          </div>

          <p>รายละเอียด &nbsp&nbsp:</p>
          
          <!-- <textarea class="form-control" name="news_detail" rows="4" cols="50"></textarea> -->
          <p><textarea name="news_detail" id="editor"></textarea>
                    <script>
                            ClassicEditor
                                    .create( document.querySelector( '#editor' ) )
                                    .then( editor => {
                                            console.log( editor );
                                    } )
                                    .catch( error => {
                                            console.error( error );
                                    } );
            </script></p>
            <br><p>รูปภาพประกอบ  : &nbsp </p>
            <div class="form-group col-md-12">
          <center>
          <img id="blah" style="width:200px" src="images/up_img.png"/>
          <div class="form-group col-md-3">
          <input type="file" class="form-control" name="news_pic" id="news_pic" onchange="readURL(this);" required= "required">
          </div>
          </center>
        </div>
            <p align="center"><br>
              <input type="submit" name="submit" class="btn btn-primary" value="Upload" />
            </p>
    </form>
    
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
function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>


