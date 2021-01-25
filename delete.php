<?php


include("connect/conn.php");
$c_id =  isset($_GET["cate_ID"]);
$t_ID =  isset($_GET["type_ID"]);
$o_ID =  isset($_GET["o_ID"]);
$p_ID = isset( $_GET["p_ID"]);
$n_ID = isset($_GET["News_ID"]);
$today = date("Y-m-d h:i:s");



if($t_ID != ""){
    
    $update_SQL = "DELETE FROM `products_types`  WHERE Types_ID = '$t_ID'";
    $update_Query = mysqli_query($con,$update_SQL);

    $meSQL_cate = " DELETE FROM  products_categorys WHERE Types_ID = '$t_ID' ";
    $meQuery = mysqli_query($con,$meSQL_cate);

    if($meQuery == TRUE) {
        echo "<script language='javascript'> alert('ลบหมวดหมู่เรียบร้อย');window.location='index.php?type';</script>";
        }else{
          echo "<script language='javascript'> alert('มีปัญหาในการลบข้อมูล กรุณาลองใหม่');</script>";
          echo "<meta http-equiv='refresh' content='0; url= index.php?type'>";
        }


}elseif($c_id != ""){
    $meSQL_cate = " DELETE FROM  products_categorys WHERE Categorys_ID = '$c_id' ";
    $meQuery = mysqli_query($con,$meSQL_cate);
   

    if ($meQuery == TRUE) {
        echo "<script language='javascript'> alert('ลบประเภทสินค้าเรียบร้อย');window.location=' index.php?cate';</script>";
        } else {
            // echo $meSQL_cate;
        echo "<script language='javascript'> alert('มีปัญหาการลบข้อมูล กรุณาตรวจสอบอีกครั้ง!'); </script>";
        echo "<meta http-equiv='refresh' content='0; url= index.php?cate'>";
        }
}elseif($o_ID != ""){
    $meSQL_o= " UPDATE orders SET Orders_Status = 0  WHERE Orders_No = '$o_ID' ";
    $meQueryo = mysqli_query($con,$meSQL_o);
   

    if ($meQueryo == TRUE) {
        echo "<script language='javascript'> alert('ยกเลิกออเดอร์เรียบร้อย');window.location='index.php?order&f=0';</script>";
        } else {
            // echo $meSQL_cate;
        echo "<script language='javascript'> alert('มีปัญหาการยกเลิกออเดอร์ กรุณาตรวจสอบอีกครั้ง!'); </script>";
        echo "<meta http-equiv='refresh' content='0; url= index.php?order&f=0'>";
        }
}elseif($p_ID != ""){
    $meSQL_p= " DELETE FROM products  WHERE Products_Code LIKE '$p_ID%' ";
    $meQueryp = mysqli_query($con,$meSQL_p);
   

    if ($meQueryp == TRUE) {
        echo "<script language='javascript'> alert('ลบสินค้าเรียบร้อย');window.location='index.php?product';</script>";
        } else {
            // echo $meSQL_cate;
        echo "<script language='javascript'> alert('มีปัญหาในการลบสินค้า กรุณาตรวจสอบอีกครั้ง!'); </script>";
        echo "<meta http-equiv='refresh' content='0; url= index.php?product'>";
        }
}elseif(isset($_GET["itemId"])){
    $itemId =$_GET["itemId"];
    $code1 = substr($itemId, 0, -1); 



    $sql ="SELECT Products_ID,Products_Code,Products_Code2,Products_Option1 FROM products WHERE Products_Code LIKE '$code1%' ";
    $qry = mysqli_query($con,$sql);
    $cnt = mysqli_num_rows($qry);

    if($cnt>1){
        $meSQL_p= " DELETE FROM products  WHERE Products_Code = '$itemId' ";
        $meQueryp = mysqli_query($con,$meSQL_p);
    }elseif($cnt ==1){
        $meSQL_p= " UPDATE products  SET Products_Code2=NULL,Products_Option1=NULL WHERE Products_Code = '$itemId' ";
        $meQueryp = mysqli_query($con,$meSQL_p);
    }


  
  
        
}elseif($n_ID != ""){
    $meSQL_cate = " DELETE FROM  news WHERE News_ID = '$n_ID' ";
    $meQuery = mysqli_query($con,$meSQL_cate);
   

    if ($meQuery == TRUE) {
        echo "<script language='javascript'> alert('ลบบทความเรียบร้อย');window.location=' index.php?news';</script>";
        } else {
            // echo $meSQL_cate;
        echo "<script language='javascript'> alert('มีปัญหาการลบข้อมูล กรุณาตรวจสอบอีกครั้ง!'); </script>";
        echo "<meta http-equiv='refresh' content='0; url= index.php?news'>";
        }
}else{
    
}


?>