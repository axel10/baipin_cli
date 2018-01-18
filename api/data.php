<?php

$keyword = $_GET["keyword"];
if (strlen($keyword) >= 255):
    return;
endif;

$dbh = new PDO("mysql:host=localhost;dbname=baidu_baipin", "root", "123");
$dbh->query("SET NAMES utf8");
//$dbh->query("use baidu_baipin");

$sql = "SELECT * FROM baipin_date WHERE keyword=:keyword";

$stmt = $dbh->prepare($sql);

try{
    $stmt->execute(array('keyword'=>$keyword));
//var_dump($stmt->rowCount());
    if($stmt->rowCount() == 0){
        $sql = "INSERT INTO baipin_date (keyword) VALUES (:keyword)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array('keyword'=>$keyword));
    }else{
        $sql = "UPDATE baipin_date SET num = num+1 WHERE keyword=:keyword";
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array('keyword'=>$keyword));
    }
    echo "true";
}catch (Exception $e){
    echo "false";
}


