   <?php
   if(!empty($_SESSION['msg']))
   {
	$error   =$_SESSION['msg'];
	$msg_type=$_SESSION['msg_type'];
	
    unset($_SESSION['msg']);
    unset($_SESSION['msg_type']);
   } 
   
   if(!empty($error))
   {
   ?>
    <div class="alert alert-<?=($msg_type=="success"  ? "success" : "danger")?>">
        <a href="#" title="Close" data-dismiss="alert" class="glyph-icon alert-close-btn icon-remove"></a>
        <?php echo $error?>
    </div>
   <?php
   }
   ?>