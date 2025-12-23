<?php
if (login_check() == false) 
 {
   header("location:login.php");
 }