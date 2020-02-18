<?php


header('Access-Control-Allow-Origin:*');
// header("refresh:3;url=http://localhost/index.html");
$arr = require "./config.php";
include "./function.php";
$link = connect($arr);
$res = @$_POST;




$sql = "select tel from user_info";
$res_sql = mysqli_query($link, $sql);
while ($result = mysqli_fetch_assoc($res_sql)) {
  
}
