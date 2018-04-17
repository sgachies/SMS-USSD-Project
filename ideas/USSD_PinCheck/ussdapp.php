<?php
header('Content-type: text/plain');

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
//var_dump($level);

//check first level
if($level == 1 or $level ==0){
mainmenu();
}

//check if level is greater than 1
if($level > 1){
switch($splitteddata[0]){//switch array at index 1

case 1://call bank function
banks($splitteddata);
break;
case 2:
//call function
break;
default:
$ussd_text = "Invalid Entry!";
ussd_proceed($ussd_text);
}
}



function banks($splitteddata){
//display list of banks
if(count($splitteddata)==2){
$ussd_text="1.Equity\n2.KCB\n3.Family\n";
ussd_proceed($ussd_text);
}
if(count($splitteddata)==3){
switch($splitteddata[1]){
case 1://equity selection
$ussd_text="Equity\n1.Fees Loan\n2.Personal Loan";
ussd_proceed($ussd_text);
break;
case 2://KCB selection
$ussd_text="KCB\n1.Fees Loan\n2.Personal Loan";
ussd_proceed($ussd_text);
break;
case 3://Family bank selection
$ussd_text="Family Bank\n1.Fees Loan\n2.Personal Loan";
ussd_proceed($ussd_text);
break;

default://Invalid selection
$ussd_text="Invalid Entry!!";
ussd_proceed($ussd_text);
break;
}
}


//level 4
if(count($splitteddata)==4){
switch($splitteddata[1]){
case 1://for equity bank
if($splitteddata[2] == 1){//fees loan choice
$ussd_text="Equity \nRate of 1.8";
ussd_stop($ussd_text);
}
else if($splitteddata[2] == 2){//personal loan choice
$ussd_text="Equity\nRate of 2%";
ussd_stop($ussd_text);
}
else {
$ussd_text="Invalid Entry!!";
ussd_stop($ussd_text);
}
break;
case 2://for KCB bank
if($splitteddata[2] == 1){//fees loan choice
$ussd_text="KCB\nRate of 4%";
ussd_stop($ussd_text);
}
else if($splitteddata[2] == 2){//personal loan choice
$ussd_text="KCB\nRate of 3%";
ussd_stop($ussd_text);
}
else {
$ussd_text="Invalid Entry!!";
ussd_stop($ussd_text);
}
break;
case 3://for Family bank
if($splitteddata[2] == 1){//fees loan choice
$ussd_text="Family\nRate of 5%";
ussd_stop($ussd_text);
}
else if($splitteddata[2] == 2){//personal loan choice
$ussd_text="Family\nRate of 6%";
ussd_stop($ussd_text);
}
else {
$ussd_text="Invalid Entry!!";
ussd_stop($ussd_text);
}
break;

default:
$ussd_text="Invalid Entry!!";
ussd_stop($ussd_text);
break;
}
}
}



//main menu
function mainmenu(){
$ussd_text="Select a Choice\n1.Banks\n2.Sacco";
ussd_proceed($ussd_text);
}

//function to print content
function ussd_proceed($ussd_text){
echo "CON\n\n".$ussd_text;
exit(0);
}
//function to END a session
function ussd_stop($ussd_text){
echo "END\n\n".$ussd_text;
exit(0);
}


?>