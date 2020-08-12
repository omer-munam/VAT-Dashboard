<?php

$detail="phone1";
$phone="033644897870231";
$abc=array('phone1'=>$phone);
echo $jsonformat=json_encode($abc);
$jsondformat=json_decode($jsonformat);

echo $jsondformat->{'phone1'};


?>