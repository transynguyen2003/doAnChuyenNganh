<?php
 include("connect.php");
    function checkUser($name,$pass){
        $conn=connectdb();
        $stmt=$conn->prepare("SELECT * FROM nguoi_dung WHERE ten_dang_nhap='".$name."' AND mat_khau='".$pass."'");
        $stmt->execute();
        $result=$stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq=$stmt->fetchAll();
        if(count($kq)>0)
            return $kq[0]['role'];
        else
            return -1;
    }
?>