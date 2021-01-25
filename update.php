<?php
session_start();
include("connect/conn.php");
$a =  $_GET["a"];
$o_ID =  $_GET["o_ID"];
$today = date("Y-m-d h:i:s");
$time = date("h:i:s");
$date = date("Y-m-d");
$trak= $_GET['trak'];

if($a == "accept" ){
    $meSQL_o= " UPDATE orders SET Orders_Status = 3 , Orders_TAG = '$trak'  WHERE Orders_No = '$o_ID' ";
    $meQueryo = mysqli_query($con,$meSQL_o);
    if ($meQueryo == TRUE) {

        $meSQL_st= " SELECT * FROM orders_detail as d 
        INNER JOIN products as p ON d.Products_ID = p.Products_ID 
        INNER JOIN products_quantity as q ON q.Products_Code=p.Products_Code 
        WHERE Orders_no = '$o_ID' GROUP BY q.Products_Lot ORDER BY d.Products_Qty DESC";
       // echo $meSQL_st."<br>";

        $meQueryst = mysqli_query($con,$meSQL_st);

        while( $row_st = mysqli_fetch_assoc($meQueryst)){
            $p_code = $row_st['Products_Code'];
            $lot_name = $row_st['Products_Lot'];
            $product_qty = '-'.$row_st['Products_Qty'];
            $emp_id = $_SESSION["Employees_IDAdmin"];
            
            $meSQL_qty = " INSERT products_quantity (`Products_Quantity_ID`, `Products_Code`, `Products_Quantity`, `Products_Quantity_Date`, `Products_Quantity_Time`, `Products_Lot`, `Employees_ID`, `DateCreate`, `LastUpdate`,Products_Quantity_Note)
             VALUES (NULL, '$p_code', '$product_qty', '$date', '$time', '$lot_name ', '$emp_id', '$today', '$today','ตัดสต็อคจากออเดอร์') ";
             //echo $meSQL_qty."<br>";
            $meQuery_qty  = mysqli_query($con,$meSQL_qty);
           // echo $meSQL_qty."<br>" ;

        }
      

        if ($meQuery_qty == TRUE) {
        echo "<script language='javascript'> alert('ยืนยันออเดอร์เรียบร้อย');window.location='index.php?order&f=3';</script>";
        } else {
            // echo $meSQL_cate;
        echo "<script language='javascript'> alert('มีปัญหาการยืนยันออเดอร์ กรุณาตรวจสอบอีกครั้ง!'); </script>";

        }

    }

    
    
}elseif($a == "send"){
    $meSQL_o= " UPDATE orders SET Orders_Status = 4  WHERE Orders_No = '$o_ID' ";
    $meQueryo = mysqli_query($con,$meSQL_o);
   

    if ($meQueryo == TRUE) {
        echo "<script language='javascript'> alert('ยืนยันการจัดส่งเรียบร้อย');window.location='index.php?order&f=4';</script>";
        } else {
            // echo $meSQL_cate;
        echo "<script language='javascript'> alert('มีปัญหาการยืนยันออเดอร์ กรุณาตรวจสอบอีกครั้ง!'); </script>";

        }
}elseif($a == "claim"){
    $pc_ID =  $_GET["pc_ID"];
    $meSQL_o= " UPDATE products_claim SET status = 2  WHERE pc_ID = '$pc_ID' ";
    $meQueryo = mysqli_query($con,$meSQL_o);
   

    if ($meQueryo == TRUE) {
        echo "<script language='javascript'> alert('ยืนยันการเคลมเรียบร้อย');window.location='index.php?claim';</script>";
        } else {
            // echo $meSQL_cate;
        echo "<script language='javascript'> alert('มีปัญหาการยืนยันออเดอร์ กรุณาตรวจสอบอีกครั้ง!'); </script>";

        }
}elseif($a == "unclaim"){
    $pc_ID =  $_GET["pc_ID"];
    $meSQL_o= " UPDATE products_claim SET status = 0  WHERE pc_ID = '$pc_ID' ";
    $meQueryo = mysqli_query($con,$meSQL_o);

    if ($meQueryo == TRUE) {
        echo "<script language='javascript'> alert('ปฏิเสธการเคลมเรียบร้อย');window.location='index.php?claim';</script>";
        } else {
            // echo $meSQL_cate;
        echo "<script language='javascript'> alert('มีปัญหาการยืนยันออเดอร์ กรุณาตรวจสอบอีกครั้ง!'); </script>";

        }
}elseif($a == "claimdone"){
    $pc_ID =  $_GET["pc_ID"];
    $meSQL_o= " UPDATE products_claim SET status = 3  WHERE pc_ID = '$pc_ID' ";
    $meQueryo = mysqli_query($con,$meSQL_o);
   

    if ($meQueryo == TRUE) {
        echo "<script language='javascript'> alert('ยืนยันสถานะการเคลมสำเร็จ');window.location='index.php?claim';</script>";
        } else {
            // echo $meSQL_cate;
        echo "<script language='javascript'> alert('มีปัญหาการยืนยันออเดอร์ กรุณาตรวจสอบอีกครั้ง!'); </script>";

        }
}

?>