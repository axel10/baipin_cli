<?php
/**
 * Created by PhpStorm.
 * User: axel10
 * Date: 2017/12/21
 * Time: 18:22
 */

function _get($str){
    $val = !empty($_GET[$str]) ? $_GET[$str] : null;
    return $val;
}

$name = _get("name");

if(empty($name)){
    die;
}

$dbh = new PDO("mysql:host=localhost;dbname=demo", "root", "123");
$dbh->query("SET NAMES utf8");

$sql = "SELECT * FROM dl_link WHERE name = :name";

$stmt = $dbh->prepare($sql);
$stmt->execute(array('name'=>$name));
$res = $stmt->fetch();
echo '<script>window.location.href="'. $res["url"] .'"</script>';
