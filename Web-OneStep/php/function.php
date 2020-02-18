<?php
    function connect($conf=[]){
      $link=mysqli_connect($conf['host'],$conf['user'],$conf['pass']);
      $link or die('连接数据库失败');
      mysqli_set_charset($link,"utf8");
      if(mysqli_select_db($link,$conf['db'])){
        return $link;
      } else {
        die('选择数据库失败');
      }
    }