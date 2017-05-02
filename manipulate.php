<?php 
$operations = ['Alphabeticize','Remove Duplicates','A in B'];

if (array_key_exists('getOperations',$_REQUEST)) {
	$outputResponse = json_encode($operations);
} elseif (array_key_exists('list',$_REQUEST)) {	
	$inputArray = $_REQUEST["list"]; 
	$inputArray2 = $_REQUEST["list2"];
	$outputArray = [];
	switch($_REQUEST['operation']) {
		case 'Alphabeticize':
			sort($inputArray);
			$outputArray = $inputArray;
			break;
		case 'Remove Duplicates':
			$outputArray = array_unique($inputArray);
			break;
		case 'A in B':
			$outputArray = aInB($inputArray,$inputArray2);
			break;
	}


/*	if ($_REQUEST['operation'] === 'Alphabetical') {
		sort($inputArray);
	} else {

	}*/

	$outputResponse = json_encode($outputArray);
} else {
	$outputResponse = 'wtf did you do';
}
echo $outputResponse;



function aInB($input1,$input2) {
	return(array_values(array_intersect($input1,$input2)));
}






?>