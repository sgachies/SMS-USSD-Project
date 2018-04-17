<?php
header('Content-type: text/plain');
$dsn = 'mysql:dbname=students;host=localhost;'; //db connection
$user = 'root'; 
$password = '';
try {
    $conn = new PDO($dsn, $user, $password);
}
catch(PDOException $e) {
    var_dump($e);
    echo("PDO error occurred");
}
//set parameters
$phone = $_GET['phoneNumber'];
$session_id = $_GET['sessionid'];
$service_code = $_GET['serviceCode'];
$user_response = $_GET['text'];
//intialize level
$level = 0;
//split user response
$splitteddata = explode("*",$user_response);
//count splitted data
$level = count($splitteddata);
var_dump($level);
//----------level check-------------
if($level == 1 or $level ==0){
mainmenu();
}
if($level > 1){
switch($splitteddata[0]){
case 1:
LevelCheck($splitteddata);//call this function
break;
case 2:
//call help function - to do
break;
default:
$ussd_text = "\nInvalid Choice!!";//invalid entry
ussd_proceed($ussd_text);
break;
}
}

//-----------function to check level ------------------
function LevelCheck($splitteddata){

if(count($splitteddata)==2){//check level  = 2
$ussd_text = "\nEnter Your Pin";//prompt for pin number
ussd_proceed($ussd_text);
//check level = 3
}

if(count($splitteddata)==3){
$r = Login($splitteddata);//call login function

if($r == "Error"){
$ussd_text = "\nCheck Your Pin!!";
ussd_stop($ussd_text);
}
else {
session_start();//else create a session with the pin code
//session associative array
$_SESSION['pin'] = $r;
$ussd_text = "\n\n1. Check Balance\n2. Check Airtime";//show this menu
ussd_proceed($ussd_text);
}
}

//check if 'check balance is selected' - level 4 now
if(count($splitteddata)==4){
checkbalance();//call this function - retrieve balance using pin
}
}

//------------this function authenticate the user pin-------------
//this function returns a value i.e Error or user's pin
function Login($splitteddata){
global $conn;


$stmt=$conn->prepare("SELECT * FROM users
WHERE pin = '$splitteddata[1]'"); 


$stmt->execute();
if ($stmt->rowCount() > 0)//row count
{

while ($colm = $stmt->fetch())//fetch results
    {
$r = $colm['pin'];//return user's pin
return $r;
    }
}

else {
$r = "Error";//return error
return $r;
}

}

//-----------function to check balance using the pin number------
function checkbalance(){
session_start(); // NEVER forget this!
if(!isset($_SESSION['pin']))//check if session exist
{
$ussd_text = "Please Check your Pin!!";
ussd_stop($ussd_text);
}
else {
$r = $_SESSION['pin'];

global $conn;

//$course = $_GET['c'];

$stmt=$conn->prepare("SELECT * FROM users
WHERE pin = '$r'"); 

$stmt->execute();
if ($stmt->rowCount() > 0)
{
while ($colm = $stmt->fetch())
    {
session_destroy();//clear the session
$ussd_text = "\nWelcome: ".$colm['username']."\nYour Balance is:".$colm['balance'];//return balance
ussd_stop($ussd_text);

    }
}

else {
$ussd_text = "\nThere was an error";//return balance
ussd_stop($ussd_text);
}
}
}



//main menu
function mainmenu(){
$ussd_text="\nSelect a Choice\n1.My Account\n2.Help";
ussd_proceed($ussd_text);
}

//function to print content
function ussd_proceed($ussd_text){
echo "CON".$ussd_text;
exit(0);
}
//function to END a session
function ussd_stop($ussd_text){
echo "END".$ussd_text;
exit(0);
}


?>