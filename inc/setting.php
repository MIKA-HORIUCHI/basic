<?php 
  $host = $_SERVER['HTTP_HOST'];
  $count = 0;
  $word_list = array("local","test","33324");
  str_replace($word_list,"",$host,$count);
  $checktime = strtotime(date('Y-m-d H:i'));
?>