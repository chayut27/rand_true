<?php

$cnf_rnd=array(200,100,60,30,15,10,5); //กำหนดตัวเลขใช้ในการสุ่ม
$cnf_vl=array(0,50,90,150,300,500,1000); // กำหนดราคา card

$max_rnd = array_sum($cnf_rnd); // จำนวนตัวเลขสุดสำหรับสุ่ม
$rnd = rand(0, $max_rnd-1); // สุ่มตัวเลข
$count_card = count($cnf_rnd); // จำนวน card
$rate = 0;
for($i=0; $i<$count_card; $i++){
   $rate += $cnf_rnd[$i];
   if($rnd < $rate){
      echo $cnf_vl[$i]; break;
   }
}








?>