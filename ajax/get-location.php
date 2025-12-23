<?php
include("../config.php");
include("../lock.php"); 

if(isAjax())
 { 
  
  $city_id = intval($_POST['city_id']);
?>
    <option value="">Select Location</option>
   <?php
     $locationList = $DB->getRows('location',['city_id'=>$city_id]);
     foreach($locationList as $location){
   ?>
     <option value="<?=$location['id']?>" <?=($location['id']==$location_id ? $selected : '')?>><?=$location['name']?></option>
   <?php
    } 
   
 }