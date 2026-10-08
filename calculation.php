<?php

$showbill = false; // Initialize the variable to control the display of the bill
 
 //what user type in each form will be given here 
 $block1 = "";
 $block2 = "";
 $block3 = "";
 $block4 = "";
 $block5 = "";

if(isset($_POST['calculate'])) {

//get data from the form user entered
$block1 = $_POST['block1'];
$block2 = $_POST['block2'];
$block3 = $_POST['block3'];
$block4 = $_POST['block4'];
$block5 = $_POST['block5'];

//check if the user enter any value or not, if not then set it to 0
if ($block1 == "") {
    $block1 = 0;
}
if ($block2 == "") {
    $block2 = 0;
}
if ($block3 == "") {
    $block3 = 0;
}
if ($block4 == "") {
    $block4 = 0;
}
if ($block5 == "") {
    $block5 = 0;
}

// charge for each block 
$charge1 = $block1 * 0.218;
$charge2 = $block2 * 0.344;
$charge3 = $block3 * 0.516;
$charge4 = $block4 * 0.546;
$charge5 = $block5 * 0.571;   

$totalkWh = $block1 + $block2 + $block3 + $block4 + $block5;
$totalCharge = $charge1 + $charge2 + $charge3 + $charge4 + $charge5;

//minimum charge  
if ($totalkWh < 3.00) {
    $totalCharge = $totalCharge * 3.00; // Apply 6% SST
}

//charge SST
if ($totalkWh > 600) {
    $totalCharge = $totalCharge * 0.06; // Apply 6% SST
} else {
    $sst = 0; // No SST applied
}

//VALIDATION

//make sure it is a numeric number which 
If(!is_numeric($block1) ||
   !is_numeric($block2) ||
   !is_numeric($block3) ||
   !is_numeric($block4) ||
   !is_numeric($block5)) {

    $error = "Please enter numbers only.";
}



// Enter reading cannot be less than zero
else if (
    $block1 < 0 || 
    $block2 < 0 || 
    $block3 < 0 || 
    $block4 < 0 || 
    $block5 < 0
) {
    $error = "kWh cannot be negative number.";
}


else if ($block1 > 200){
    $error = "The first block is only 200 kWh. Please enter 200 or less.";
}
else if ($block2 > 100)
{
    $error = "The second block is only 100 kWh. Please enter 100 or less.";
}
else if ($block3 > 300)
{
    $error = "The third block is only 300 kWh. Please enter 300 or less.";
}
else if ($block4 > 300)
{
    $error = "The fourth block is only 300 kWh. Please enter 300 or less.";
}



//check if the user enter any value or not, if not then set it to 0
else if($block1 + $block2 + $block3 + $block4 + $block5 == 0)
{
    $error = "Please enter your electricity usage.";
}


//final bill
$totalBill = $totalCharge + $sst;


$showbill = true; // Set the variable to true to display the bill

}

?>