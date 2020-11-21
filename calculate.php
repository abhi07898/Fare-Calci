<?php
// globally declared variabkle
$pickup_data  = $_POST['pick'];
$dest_data = $_POST['dest'];
$cab_data = $_POST['cab'];
$luggage_data = $_POST['luggage'];
$calculated_distance;
$output='';
$fare;
// define a array  with the name of cities and distance for calculating the distance..............................
$destpick = array("CHARBAGH"=>"0", "INDIRA NAGAR"=>"10", "BBD"=>"30", "BARABANKI"=>"60", "FAIZABAD"=>"100", "BASTI"=>"150", "GORAKHPUR"=>"210" );
if ((array_key_exists($pickup_data, $destpick))  and  (array_key_exists($dest_data, $destpick))) {
    $calculated_distance  = (abs($destpick[$dest_data] - $destpick[$pickup_data]));
} else {
    echo "something goes wrong";
}
$output.= '<tr><td>cab-service</td><td >'. $cab_data. '</td></tr>';
$output.= '<tr><td>Total-Distance</td><td >'. $calculated_distance. '.km </td></tr>';
// calculation for luggage data .. ..............................
$luggage_amount=0;
if ($luggage_data >0 and $luggage_data <= 10) {
    $luggage_amount = 50;
} else if($luggage_data >10 and $luggage_data <= 20) {
    $luggage_amount = 100;
} else if($luggage_data > 20) {
    $luggage_amount = 200;
}
// switch case for differentiate between different different cabs 
switch ($cab_data) {
case "CedMicro": 
    $fixedfare = 50;
    if ($calculated_distance<=10) {
        $farefor10 = $fixedfare + $calculated_distance * 13.50;
        $fare = $farefor10;
       
    } else if ($calculated_distance > 10 and $calculated_distance <= 60) {
        $calculated_distance = $calculated_distance - 10;
        $farefor50 = (50 + (10*13.50) + ($calculated_distance*12));
        $fare =  $farefor50;
    } else if ($calculated_distance > 60 and $calculated_distance <= 160) {
        $calculated_distance = $calculated_distance - 60;
        $farefor100 = $fixedfare + (10*13.50 + 50*12) + ($calculated_distance * 10.20);
        $fare =  $farefor100;
    } else if ($calculated_distance > 160 ) {
        $calculated_distance = $calculated_distance - 160;
        $fareforabove =$fixedfare + (10*13.50 + 50*12 + 100*10.20)  + ($calculated_distance * 8.50);
        $fare =  $fareforabove;
    }
    break;
case "CedMini": 
    $fixedfare = 150;
    if ($calculated_distance<=10) {
        $farefor10 = $fixedfare + $calculated_distance * 14.50;
        $fare = $farefor10;
    } else if ($calculated_distance > 10 and $calculated_distance <= 60) {
        $calculated_distance = $calculated_distance - 10;
        $farefor50 = ($fixedfare + (10*14.50) + ($calculated_distance*13.00));
        $fare =$farefor50;
    } else if ($calculated_distance > 60 and $calculated_distance <= 160) {
        $calculated_distance = $calculated_distance - 60;
        $farefor100 = $fixedfare + (10*14.50 + 50*13.00) + ($calculated_distance * 11.20);
        $fare = $farefor100;
    } else if ($calculated_distance > 160 ) {
        $calculated_distance = $calculated_distance - 160;
        $fareforabove =$fixedfare + (10*14.50 + 50*13.00 + 100*11.20)  + ($calculated_distance * 9.50);
        $fare = $fareforabove;
    }    
    break;
case "CedRoyal": 
    $fixedfare = 200;
    if ($calculated_distance<=10) {
        $farefor10 = $fixedfare + $calculated_distance * 15.50;
        $fare = $farefor10;
    } else if ($calculated_distance > 10 and $calculated_distance <= 60) {
        $calculated_distance = $calculated_distance - 10;
        $farefor50 = ($fixedfare + (10*15.50) + ($calculated_distance*14.00));
        $fare = $farefor50;
    } else if ($calculated_distance > 60 and $calculated_distance <= 160) {
        $calculated_distance = $calculated_distance - 60;
        $farefor100 = $fixedfare + (10*15.50 + 50*14.00) + ($calculated_distance * 12.20);
        $fare = $farefor100;
    } else if ($calculated_distance > 160 ) {
        $calculated_distance = $calculated_distance - 160;
        $fareforabove =$fixedfare + (10*15.50 + 50*14.00 + 100*12.20)  + ($calculated_distance * 10.50);
        $fare = $fareforabove;
    }
    break;   
case "CedSUV": 
    $fixedfare = 250;
    if ($calculated_distance<=10) {
        $farefor10 = $fixedfare + $calculated_distance * 16.50;
        $fare = $farefor10;
    } else if ($calculated_distance > 10 and $calculated_distance <= 60) {
        $calculated_distance = $calculated_distance - 10;
        $farefor50 = ($fixedfare + (10*16.50) + ($calculated_distance*15.00));
        $fare = $farefor50;
    } else if ($calculated_distance > 60 and $calculated_distance <= 160) {
        $calculated_distance = $calculated_distance - 60;
        $farefor100 = $fixedfare + (10*16.50 + 50*15.00) + ($calculated_distance * 13.20);
        $fare = $farefor100;
    } else if ($calculated_distance > 160 ) {
        $calculated_distance = $calculated_distance - 160;
        $fareforabove =$fixedfare + (10*16.50 + 50*15.00 + 100*13.20)  + ($calculated_distance * 11.50);
        $fare = $fareforabove;
    }
    $luggage_amount = 2* $luggage_amount;
    break;
} 
// print the output data in the form of table 
$output.= '<tr><td>Fare-Amout</td><td >'. $fare. '.Rs </td></tr>';
$output.='<tr><td>Fare for Luggage</td><td >'. $luggage_amount. '. Rs </td></tr>';
$output.='<tr><td>Total-Fare(fare+luggage) </td><td >'. ($fare + $luggage_amount ). '. Rs</td></tr>';
$output.='</table>';
echo $output;
?>
