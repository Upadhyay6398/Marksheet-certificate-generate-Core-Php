<?php
//echo "SELECT * FROM home_type WHERE id='$thumb_id' ORDER BY id DESC";
//die;
$thumb_res =mysqli_fetch_array(mysqli_query($DB,"SELECT * FROM home_type WHERE id='$thumb_id' ORDER BY id DESC"));
/********
for sidebar thumb and large image
*********/
$thumb =$thumb_res['thumb'];
$large =$thumb_res['large'];