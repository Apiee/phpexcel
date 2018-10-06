<?php
/**
 * @user    ee
 * @authors baicai (vbaicai@vbaicai.cn)
 * @date    2018-06-22 15:38:52
 * @version $Id$
 */
date_default_timezone_set("Asia/Shanghai");
$dir = '22.db';
$ctx = file_get_contents($dir);
// echo $ctx;

$dir = dirname(__FILE__);
require $dir."/phpexcel/phpexcel/IOFactory.php";
$filename = $dir."/22.xlsx";
$obj = PHPExcel_IOFactory::load($filename);

// $sheetCount = $obj->getSheetCount();
// for($i=0;$i<$sheetCount;$i++){
// 	$data = $obj->getSheet($i)->toArray();
// 	print_r($data);
// }


foreach ($obj->getWorkSheetIterator() as $sheet) {//循环sheet
	foreach ($sheet->getRowIterator() as $row ) {//循环行
		if($row->getRowIndex()<2){
			continue;
		}
		foreach ($row->getCellIterator() as $cell) {
			if($cell->getColumn()==A){
				$cellA[] = $cell->getValue();
			}
			if($cell->getColumn()==B){
				$cellB[] = $cell->getValue();
			}

		}

	}
}

// var_dump($cellA);
// var_dump($cellB);
$res="";
$i = 0;
foreach ($cellA as $key) {
	// echo $key;
		$res = str_replace($key,$cellB[$i],$ctx);
		$ctx =$res;
		$i++;
}

$flag = file_put_contents('22_1.db',$res);
if($flag){
	echo "success";
} else {
	echo "fail";
}