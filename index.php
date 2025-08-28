<?php
$base_url = 'http';
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $base_url .= 's';
}
$base_url .= '://' . $_SERVER['HTTP_HOST'];

$request = $_SERVER['REQUEST_URI'];
$req = explode('?',$request);
$root = rtrim(substr($req[0], 1),'/');


date_default_timezone_set('ASIA/MANILA');
$nowStrDate = strtotime(date('M d, Y'));
$nowStrTime = strtotime(date('M d, Y h:i:s a'));


$doc = new DOMDocument();


function connect(){
	$con = new mysqli ('localhost','u331796773_HinDBjef','Hin2022WebAdmin','u331796773_hinigarandb');
	return $con;
}

function viewPOST($findRow){
	$con = connect();
	$result = array();
	$sql = "SELECT * FROM tbl_post ". $findRow;
	$fetchResult = mysqli_query($con,$sql);
	if(mysqli_num_rows($fetchResult)){while($row = mysqli_fetch_assoc($fetchResult)){$result[] = $row;}}
	return $result;
}


function viewCollege($collgeID){
	$con = connect();
	$result = array();
	$collgeID = mysqli_real_escape_string($con, $collgeID);
	$sql = "SELECT * FROM tbl_colleges WHERE college_id='".$collgeID."' ";
	$fetchResult = mysqli_query($con,$sql);
	if(mysqli_num_rows($fetchResult)){while($row = mysqli_fetch_assoc($fetchResult)){$result[] = $row;}}
	return $result;
}

function viewProgram($cpID){
	$con = connect();
	$result = array();
	$cpID = mysqli_real_escape_string($con, $cpID);
	$sql = "SELECT * FROM tbl_programs WHERE college_id='".$cpID."' OR program_id = '".$cpID."' ";
	$fetchResult = mysqli_query($con,$sql);
	if(mysqli_num_rows($fetchResult)){while($row = mysqli_fetch_assoc($fetchResult)){$result[] = $row;}}
	return $result;
}

function viewJobs($progID){
	$con = connect();
	$result = array();
	$progID = mysqli_real_escape_string($con, $progID);
	$sql = "SELECT * FROM tbl_prog_job_offer WHERE program_id='".$progID."' OR pjo_id = '".$progID."' ";
	$fetchResult = mysqli_query($con,$sql);
	if(mysqli_num_rows($fetchResult)){while($row = mysqli_fetch_assoc($fetchResult)){$result[] = $row;}}
	return $result;
}

function viewSocialMedia($collegeID){
	$con = connect();
	$result = array();
	$collegeID = mysqli_real_escape_string($con, $collegeID);
	$sql = "SELECT * FROM tbl_socialmedia_links WHERE college_id='".$collegeID."' OR sclmdname = '".$collegeID."' ";
	$fetchResult = mysqli_query($con,$sql);
	if(mysqli_num_rows($fetchResult)){while($row = mysqli_fetch_assoc($fetchResult)){$result[] = $row;}}
	return $result;
}

function logs($linkName){
$logFile = 'logs/access_logs.txt';
$linkName = 'logs/'.$linkName;
$timeout = 24 * 60 * 60;

$ipAddress = $_SERVER['REMOTE_ADDR'];

$logData = file_get_contents($logFile);
$logLines = explode("\n", $logData);
$isLogged = false;
foreach ($logLines as $logLine) {
  $logFields = explode('|', $logLine);
  if (count($logFields) == 3 && $logFields[0] == $ipAddress && $logFields[1] == $linkName) {
    $lastAccessTime = strtotime($logFields[2]);
    if (time() - $lastAccessTime < $timeout) {
      $isLogged = true;
      break;
    }
  }
}

if (!$isLogged) {
  $fp = fopen($logFile, 'a');
  $logMessage = "{$ipAddress}|{$linkName}|".date('Y-m-d H:i:s')."\n";
  fwrite($fp, $logMessage);
  fclose($fp);
  $linkCountFile = "{$linkName}_count.txt";
  $linkCount = file_exists($linkCountFile) ? (int) file_get_contents($linkCountFile) : 0;
  $linkCount++;
  file_put_contents($linkCountFile, $linkCount);
}else{
	$linkCountFile = "{$linkName}_count.txt";
	$linkCount = file_exists($linkCountFile) ? (int) file_get_contents($linkCountFile) : 0;
}

	return $linkCount;
}















switch ($root) {
    case '' :
		logs('cpsu-home');
        require 'public/cpsu-home.php';
        break;
    case 'main-home' :
		logs('cpsu-home');
        require 'public/cpsu-home.php';
        break;
    case 'main-updates' :
        require 'public/cpsu-updates.php';
        break;
    case 'main-announcements' :
        require 'public/cpsu-announcements.php';
        break;
    case 'main-events' :
        require 'public/cpsu-events.php';
        break;
    case 'main-about' :
        require 'public/cpsu-about.php';
        break;
    case 'main-admission' :
        require 'public/cpsu-admission.php';
        break;
    case 'main-program-offers' :
        require 'public/cpsu-program-offers.php';
        break;
    case 'main-key-official' :
        require 'public/cpsu-key-official.php';
        break;
    case 'main-program-chair' :
        require 'public/cpsu-program-chair.php';
        break;
    case 'main-administrative-functions' :
        require 'public/cpsu-administrative-functions.php';
        break;
    case 'main-faculty' :
        require 'public/cpsu-faculty.php';
        break;
    case 'main-extension' :
        require 'public/cpsu-extension.php';
        break;
		
		
		
	// Colleges Link
    case 'main-colleges' :
        require 'public/cpsu-colleges.php';
        break;
		
		
		
		
    case 'main-calendar' :
        require 'public/cpsu-calendar.php';
        break;



    default:
        http_response_code(404);
        require __DIR__ . '/errorpages/error404.php';
        break;
}
