<?php
function sanitizeString($str)
 {
  $str=strip_tags($str);
  $str=htmlentities($str);
  return $str;	 
 }

function random_jobId( $length = 8 ) {
   $chars = "0123456789";
   $pass = substr( str_shuffle( $chars ), 0, $length );
   return $pass;
   }


function sanitise( $words )
 {
	$str = strip_tags( $words );
	$str = strtolower( $str );
	$str = str_replace(array('-','_','\\','/','.',','),' ',$str);
	$str = preg_replace( array(
		'/[^a-z0-9\s]/', // Leave only Letters and numbers
	), '', $str );
	$str = preg_replace('/\s+/', ' ', $str );
	return $str;
 }
 
 
function prepStr($data)
  {
	global $DB;  
	if(ini_get('magic_quotes_gpc')){
		$data=stripslashes($data);
	}
	$data = mysqli_real_escape_string($DB,strip_tags($data));
	return $data;

  }

 function prepStr2($data)
  {
  	global $DB;  
 
  	if(ini_get('magic_quotes_gpc')){
  		$data=stripslashes($data);
  	}
  	$data = mysqli_real_escape_string($DB,$data);
  	return $data;

  }
  
function addActivityLog($activity,$work)
 {
  global $DB;
  
  $data = [
            'login'    => $_SESSION['ADMIN_USER_ID'],
            'activity' => $activity,
            'work'     => json_encode($work),
            'ip'       => $_SERVER['REMOTE_ADDR'],
            'tstp'     => date("Y-m-d H:i:s")
          ];

  $DB->insert('activity_logs',$data); 
 }
 

function getClientIp()
{
	
	$serverVars = array(
		'HTTP_CLIENT_IP', 
		'REMOTE_ADDR',
		'HTTP_X_FORWARDED_FOR', 
		'HTTP_X_FORWARDED', 
		'HTTP_X_CLUSTER_CLIENT_IP', 
		'HTTP_FORWARDED_FOR',
		'HTTP_FORWARDED'
	);
	foreach( $serverVars as $str ) {
		if( !empty( $_SERVER[ $str ] ) )
			return $_SERVER[ $str ];
	}
	 
	return '0.0.0.0';
}


function calPercentage($total,$val)
 {
	$t_per=$total/100;
	$per=$t_per*$val;
	return round($per,2);
 } 	 
  
function getCountryByIp($ip)
 {
  $data =@json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=$ip"),true);
  return $data['geoplugin_countryName'];
 }


function sec_session_start() {
    session_start();            // Start the PHP session 
}

function RandomString()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 8; $i++) {
        $randstring.= $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}

function login($email, $password)
{
    global $DB;

    $row = $DB->getRow('login', [
        'email' => $email,
        'type'  => 'admin'
    ]);

    if (!$row) {
        return false;
    }

    $user_id     = (int)$row['id'];
    $username    = $row['username'];
    $db_password = $row['password'];
    $salt        = $row['salt'];
    $role        = $row['role'];

    // Brute force protection
    if (checkbrute($user_id)) {
        return false;
    }

    // Password verify (OLD sha512 + salt logic)
    $password_hash = hash('sha512', $password . $salt);

    if ($db_password !== $password_hash) {

        // Log failed attempt
        $DB->insert('login_attempts', [
            'user_id' => $user_id,
            'time'    => time()
        ]);

        return false;
    }

    // Secure session
    session_regenerate_id(true);

    $user_browser = $_SERVER['HTTP_USER_AGENT'];

    $_SESSION['ADMIN_USER_ID']    = $user_id;
    $_SESSION['ADMIN_USER_NAME']  = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
    $_SESSION['ADMIN_LOGIN_STR']  = hash('sha512', $db_password . $user_browser);
    $_SESSION['ADMIN_LOGIN_ROLE'] = json_decode($role, true);

    // Update last login
    $DB->update('login', [
        'last_login' => date("Y-m-d H:i:s"),
        'ip'         => $_SERVER['REMOTE_ADDR']
    ], $user_id);

    return true;
}





function checkbrute($user_id) {
	global $DB;
  
  $now = time();
  $valid_attempts = $now - (2 * 60 * 60);
    
	$sql  = "SELECT count(*) as total  FROM login_attempts  WHERE user_id =:user_id  AND time > :time";				
  $stmt = $DB->DB->prepare($sql);
  $stmt->execute(['user_id'=>$user_id,'time'=>$valid_attempts]);
  $num = $stmt->fetchColumn();

  if ($num > 5) {
     return true;
  } else {
     return false;
  }
}


function login_check() 
{
	global $DB;
     
    if(isset($_SESSION['ADMIN_USER_ID'],$_SESSION['ADMIN_USER_NAME'],$_SESSION['ADMIN_LOGIN_STR'])) {
 
        $user_id      = $_SESSION['ADMIN_USER_ID'];
        $login_string = $_SESSION['ADMIN_LOGIN_STR'];
        $username     = $_SESSION['ADMIN_USER_NAME'];
 
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
		    $row = $DB->getRowById('login',$user_id);

        if ($row) {

			      $password    = $row['password'];
            $login_check = hash('sha512', $password . $user_browser);

            if ($login_check == $login_string) {
               return true;
            } else {
               return false;
            }
        } else {
           return false;
        }
    } else {
       return false;
    }
}


function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}

function isAjax()
 {
	if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=="xmlhttprequest")
	 {
	  return true;
	 }
	else
	 {
	  return false;
	 } 
 }

function isAllowed($resource)
 {
  if(in_array($resource,$_SESSION['ADMIN_LOGIN_ROLE']))
    {
	return true;	
	}	 
  else
    {
	return true;	
	}	
 } 
 
function valUser($email,$exc='')
{
 global $DB;
 if(!empty($exc))
   {
   $sql=" AND id !='$exc'";   
   }	
	 
 $num=mysqli_num_rows(mysqli_query($DB,"select id from login where email='$email' $sql "));
 if($num>0)
  {
  return false;	  
  }	
 else
  {
 return true;	  
  } 
}

function genParam($param)
 {
  return base64_encode($param);	 
 }

function cleanId($param)
 {
  return intval(base64_decode($param));	 
 }
  
function cleanUrl($str)
  {
  $str = preg_replace("^[\\\\/:\*\?\"<>\|`~,'+]^", "", $str) ;	  
  $str=strtolower($str);	  
  $str=str_replace(array("&","é","'"),array("-and-",'e',"r"),$str);
  $str=preg_replace('/[^a-zA-Z0-9-]/', '-', $str);
  $str=str_replace(array("---","--"),"-",$str);
  $str=str_replace(array("---","--"),"-",$str);
  $str=trim($str,"-");
  return $str;	  
  }

function getFileDirectory()
 {
  $folder = date("Y");
  if(!file_exists(UPLOAD_PATH.$folder)){
     mkdir(UPLOAD_PATH.$folder);
  }

  $folder = date("Y")."/".date("m");
  if(!file_exists(UPLOAD_PATH.$folder)){
     mkdir(UPLOAD_PATH.$folder);
  }

  return "/".$folder."/";
 }

 function getProductImageName($filename)
 {
     $folder = "uploads/project/"; // Define the folder where images are stored
     $filename = time() . "_" . strtolower($filename);
     return $folder . $filename;
 }
  
 
 
function insertKeyWords($pid, $keyword)
{
  global $DB;
  
    $stmt = $DB->DB->prepare("DELETE FROM product_keyword WHERE product_id = :id");
    $stmt->bindParam(':id', $pid, PDO::PARAM_INT);   
    $stmt->execute();
        
        
  $keywordArray = explode(",", $keyword);
  foreach ($keywordArray as $keywordStr) {
    $data = ['product_id' => $pid, 'keywords' => $keywordStr];
    try {
        $res = $DB->insert('product_keyword', $data);
    } catch (Exception $e) {
        return false;
    }
    
  }
  return true;
}
?>