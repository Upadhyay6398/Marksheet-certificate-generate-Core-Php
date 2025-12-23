<?php
include("config.php");
include("lock.php");

if(isset($_POST['Submit']))
 {
 $new_password = sanitizeString($_POST['new_password']);
 $con_password = sanitizeString($_POST['con_password']);
 $old_password = sanitizeString($_POST['old_password']);
 
 $row = $DB->getRowById('login',$_SESSION['ADMIN_USER_ID']);
 $old_salted = hash('sha512', $old_password . $row['salt']);
 
 if(empty($old_password)) 
  {
   $error="Please enter current password";
   $msg_type="error";
  }
 else if($row['password']!=$old_salted) 
  {
   $error="Your current password did not match";
   $msg_type="error";
  }
 else if(empty($new_password)) 
  {
   $error="Please enter new password";
   $msg_type="error";
  }
 else if(empty($con_password)) 
  {
   $error="Please enter con password";
   $msg_type="error";
  }
 else if($new_password != $con_password) 
  {
   $error="Your current and new password did not matched";
   $msg_type="error";
  }
 else
  {

   $salted_pwd = hash('sha512', $new_password . $row['salt']); 
	 $data = ['password'=>$salted_pwd];
   $res  = $DB->update('login',$data,$_SESSION['ADMIN_USER_ID']);
	
   if($res)
    {
	   /* Log Update */
	   $user_browser = $_SERVER['HTTP_USER_AGENT'];
     $_SESSION['ADMIN_LOGIN_STR'] = hash('sha512',$salted_pwd . $user_browser);

     $error="Password changed successfully.";
     $msg_type="success";
	
	} else {
     $error="Can't change password there were some error.";
	   $msg_type="error";
	}	
  } 
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=DEFAULT_TITLE?> | Change Password</title>
<?php
include("include/head.php");
?>

<script type="text/javascript" src="<?=BASE_URL?>assets/widgets/parsley/parsley.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>assets/password-score/password-score.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>assets/password-score/password-score-options.js"></script>
<script type="text/javascript" src="<?=BASE_URL?>assets/password-score/bootstrap-strength-meter.js"></script>
</head>

<body>
<?php include("include/header-include.php");?> 
<?php include("include/header.php");?> 
<?php include("include/sidebar.php");?>

 <div id="page-content-wrapper">
    <div id="page-content">
    <div id="page-title">
        <h2>Change Password</h2>
   </div> 
<?php include("include/message.php"); ?>
   
   
   <div class="col-md-6">  
   
        
   <div class="panel">
    <div class="panel-body">
        <h3 class="title-hero">
            Change Password
        </h3>
        <div class="example-box-wrapper">
            <form class="form-horizontal bordered-row" method="post"  id="change-password-form" data-parsley-validate="">
                
                <div class="form-group">
                    <label class="col-sm-4 control-label">Old Password</label>
                    <div class="col-sm-6">
                        <input type="password" autocomplete="off" class="form-control" id="old_password" name="old_password" required placeholder="Old Password">
                        
                    </div>
                    
                </div>
                
                <div class="form-group">
                    <label class="col-sm-4 control-label">New Password</label>
                    <div class="col-sm-6">
                        <input type="password" autocomplete="off" class="form-control" id="new_password" name="new_password" required placeholder="New Password">
                        
                    </div>
                    
                </div>
                <div class="form-group">
                 <label class="col-sm-4 control-label">Password Strength</label>
                <div class="col-sm-6" id="example-progress-bar-hierarchy-container">
 
                </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Confirm Password</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control"  id="con_password" name="con_password" autocomplete="off"  data-parsley-equalto="#new_password" required placeholder="Confirm Password">
                    </div>
                </div>
                
				<div class=" text-center pad20A ">
                     <a href="index.php" class="btn  btn-danger">Cancel</a>
                     <input type="submit" class="btn  btn-success" name="Submit" value="Confirm" />
                </div>
               
            </form>
        </div>
    </div>
</div>
   
   </div>


       
</div>
</div>
     
<?php include("include/footer-js.php");?>

<script type="text/javascript">
$(document).ready(function() {
 $('#new_password').strengthMeter('progressBar', {
            container: $('#example-progress-bar-hierarchy-container'),
            hierarchy: {
                '0': 'progress-bar-danger',
                '10': 'progress-bar-warning',
                '15': 'progress-bar-success'
            }
        });
    });
</script>
</body>
</html>
