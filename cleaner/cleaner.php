<?php

include('../Classes/PHPexcel.php');
require_once('utils.php');

if ( isset($_FILES['uploadfile']) ){
	
	$xls = $_FILES['uploadfile']['tmp_name'];
	$obj = PHPExcel_IOFactory::load($xls);
	$obj->setActiveSheetIndex(0);
	$table = $obj->getActiveSheet()->toArray();
	
	//~ 2) в перой строке нет имен
	//~ ***
	$column_num = -1;
	foreach( $table[0] as $key=>$name ) {
		if (mb_strtoupper($name) == 'COMMENT') {
			$column_num = $key;
			//~ echo $key,' ',$name,'<br>';
			break;
		}
	}	
	if ($column_num == -1) {
		echo "Comment are not found!";
	} else {
		$rows = array_slice($table,1);
		//~ var_dump($rows);
		//~ проверить, что ячейка не пустая
		foreach($rows as $row ) {
			$number = $row[$column_num];
			if (strlen($number) ) 				
				//~ echo $number,' ',cleanNumber($number),'<br>';
				echo $number,' => ',cleanNumber($number),'<br>';
		}
	}
	
} else {
	die("Error!");
}
