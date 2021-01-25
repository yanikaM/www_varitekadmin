<?php
    include('connect/conn.php');

    if(isset($_GET['p_id'])){
        $p_id = $_GET['p_id'];
        $sql = "SELECT Products_Code ,Products_Option1 FROM products 
        WHERE Products_Code LIKE '$p_id%'";
        $query = mysqli_query($con, $sql);
        $json = array();
    
        while($result = mysqli_fetch_assoc($query)) {   
            if($result['Products_Option1']==NULL){
                $json = '{"Products_Code":'.$p_id."0001".',"Products_Option1":"ไม่มีตัวเลือก"}';
            }else{
                array_push($json, $result);
            }
        
        }
        echo json_encode($json); 

    }elseif(isset($_GET['t_id'])){
        $sql = "SELECT * FROM `products_categorys` 
        WHERE Types_ID = '{$_GET['t_id']}'";
        $query = mysqli_query($con, $sql);
        $json = array();
    
        while($result = mysqli_fetch_assoc($query)) {    
        array_push($json, $result);
        }
        echo json_encode($json); 
    }
   