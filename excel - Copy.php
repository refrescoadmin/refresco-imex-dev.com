<?php 

include('phpexcel/Classes/PHPExcel.php');
include "include/db.inc";
include "include/functions.php";

 



$objPHPExcel = new PHPExcel(); 

$filename = "Imex " . date("D jS Gi") . ".xlsx";      


	
	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(40);
	
	 
	 $objPHPExcel->getActiveSheet()->getStyle('A1:J999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	 $objPHPExcel->getActiveSheet()->getStyle('A1:J999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
	
	$objPHPExcel->getActiveSheet()->setTitle("Exports");

$rowCount = 1; 
$objPHPExcel->setActiveSheetIndex(0);




$qrystr = "SELECT dh_primary_id, dh_bu, dh_country, dh_inco_term, dh_business_link_id, dh_status, dh_partner_name, dh_despatch_point, dh_imex_duedate, " .
						  "dh_header_child, dh_import_export, dh_btr_ref, dh_imex_creation_date FROM decloration_header where dh_status not in ('COMP','FTPSENT','FTP','CANC') AND dh_header_child <> 'C'" .
							" and dh_import_export like 'EXP'  order by dh_imex_creation_date DESC";
$result = mysql_query($qrystr) or die(mysql_error());



PrintHeaders($rowCount,$objPHPExcel,'Shipments Awaiting Export Informaton');
$rowCount = $rowCount + 2;
PrintDetail($rowCount,$objPHPExcel,$result);
$num_rows = mysql_num_rows($result);
$rowCount = $rowCount + $num_rows + 1;



$qrystr = "SELECT dh_primary_id, dh_bu, dh_country, dh_inco_term, dh_business_link_id, dh_status, dh_partner_name, dh_despatch_point, dh_imex_duedate, " .
						  "dh_header_child, dh_import_export, dh_btr_ref, dh_imex_creation_date FROM decloration_header where dh_status in ('FTPSENT','FTP') AND dh_header_child <> 'C'" .
							" and dh_import_export like 'EXP'  order by dh_imex_creation_date DESC";
$result = mysql_query($qrystr) or die(mysql_error());



PrintHeaders($rowCount,$objPHPExcel,'Shipments With Export Agent (Awaiting Paperwork) ');
$rowCount = $rowCount + 2;
PrintDetail($rowCount,$objPHPExcel,$result);
$num_rows = mysql_num_rows($result);
$rowCount = $rowCount + $num_rows + 1;



$today = date('Y-m-d H:i:s', strtotime('-7 days'));

$qrystr = "SELECT dh_primary_id, dh_bu, dh_country, dh_inco_term, dh_business_link_id, dh_status, dh_partner_name, dh_despatch_point, dh_imex_duedate, " .
						  "dh_header_child, dh_import_export, dh_btr_ref, dh_imex_creation_date FROM decloration_header where dh_status in ('COMP') AND dh_header_child <> 'C'" .
							" and dh_import_export like 'EXP' and dh_imex_creation_date > '" . $today . "'  order by dh_imex_creation_date DESC";
$result = mysql_query($qrystr) or die(mysql_error());



PrintHeaders($rowCount,$objPHPExcel,'Shipments complete in last 48 hours');
$rowCount = $rowCount + 2;
PrintDetail($rowCount,$objPHPExcel,$result);
$num_rows = mysql_num_rows($result);
$rowCount = $rowCount + $num_rows + 1;




$objPHPExcel->createSheet(1);
     $objPHPExcel->setActiveSheetIndex(1);

$objPHPExcel->getActiveSheet()->setTitle("Imports");


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
	$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
	$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(40);
	
	 
	 $objPHPExcel->getActiveSheet()->getStyle('A1:J999')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	 $objPHPExcel->getActiveSheet()->getStyle('A1:J999')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
	

$rowCount = 1; 




$qrystr = "SELECT dh_primary_id, dh_bu, dh_country, dh_inco_term, dh_business_link_id, dh_status, dh_partner_name, dh_despatch_point, dh_imex_duedate, " .
						  "dh_header_child, dh_import_export, dh_btr_ref, dh_imex_creation_date FROM decloration_header where dh_status not in ('COMP','FTPSENT','FTP','CANC') AND dh_header_child <> 'C'" .
							" and dh_import_export like 'IMP%'  order by dh_imex_creation_date DESC";
$result = mysql_query($qrystr) or die(mysql_error());



PrintHeaders($rowCount,$objPHPExcel,'Shipments Awaiting Export Informaton');
$rowCount = $rowCount + 2;
PrintDetail($rowCount,$objPHPExcel,$result);
$num_rows = mysql_num_rows($result);
$rowCount = $rowCount + $num_rows + 1;



$qrystr = "SELECT dh_primary_id, dh_bu, dh_country, dh_inco_term, dh_business_link_id, dh_status, dh_partner_name, dh_despatch_point, dh_imex_duedate, " .
						  "dh_header_child, dh_import_export, dh_btr_ref, dh_imex_creation_date FROM decloration_header where dh_status in ('FTPSENT','FTP') AND dh_header_child <> 'C'" .
							" and dh_import_export like 'IMP%'  order by dh_imex_creation_date DESC";
$result = mysql_query($qrystr) or die(mysql_error());



PrintHeaders($rowCount,$objPHPExcel,'Shipments With Export Agent (Awaiting Paperwork) ');
$rowCount = $rowCount + 2;
PrintDetail($rowCount,$objPHPExcel,$result);
$num_rows = mysql_num_rows($result);
$rowCount = $rowCount + $num_rows + 1;



$today = date('Y-m-d H:i:s', strtotime('-2 days'));

$qrystr = "SELECT dh_primary_id, dh_bu, dh_country, dh_inco_term, dh_business_link_id, dh_status, dh_partner_name, dh_despatch_point, dh_imex_duedate, " .
						  "dh_header_child, dh_import_export, dh_btr_ref, dh_imex_creation_date FROM decloration_header where dh_status in ('COMP') AND dh_header_child <> 'C'" .
							" and dh_import_export like 'IMP%' and dh_imex_creation_date > '" . $today . "'  order by dh_imex_creation_date DESC";
$result = mysql_query($qrystr) or die(mysql_error());



PrintHeaders($rowCount,$objPHPExcel,'Shipments complete in last 48 hours');
$rowCount = $rowCount + 2;
PrintDetail($rowCount,$objPHPExcel,$result);
$num_rows = mysql_num_rows($result);
$rowCount = $rowCount + $num_rows + 1;



$objPHPExcel->setActiveSheetIndex(0);




$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
ob_end_clean();
// We'll be outputting an excel file
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="' . $filename . '"');
$objWriter->save('php://output');




function PrintHeaders($startrow,$objPHPExcel,$header)
{

$phpColor = new PHPExcel_Style_Color();
$phpColor->setRGB('10b526');  


$styleArray = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 25,
        'name'  => 'Calibri'
    ));
	
$styleArrayHeader = array(
    'font'  => array(
        'bold'  => false,
        'color' => array('rgb' => 'FFFFFF'),
        'size'  => 15,
        'name'  => 'Calibri'
    ));
		

	$mergecell = 'A' . $startrow;
	$mergecellto = 'J' . $startrow;
	
	echo $mergecell;
	
	$objPHPExcel->getActiveSheet()
	->mergeCells($mergecell . ':' . $mergecellto);
	$objPHPExcel->getActiveSheet()
		->getCell($mergecell)
		->setValue($header);
		
	$objPHPExcel->getActiveSheet()->getRowDimension($startrow)->setRowHeight(40);		
	$objPHPExcel->getActiveSheet()->getStyle($mergecell)->applyFromArray($styleArray);
	$objPHPExcel->getActiveSheet()->getStyle($mergecell . ':' . $mergecellto)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('e89127');

		
	$startrow++;
	
	$mergecell = 'A' . $startrow;
	$mergecellto = 'J' . $startrow;
    $objPHPExcel->getActiveSheet()->getRowDimension($startrow)->setRowHeight(30);	
	
	$objPHPExcel->getActiveSheet()->getStyle($mergecell . ':' . $mergecellto)->applyFromArray($styleArrayHeader);
    $objPHPExcel->getActiveSheet()->getStyle($mergecell . ':' . $mergecellto)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('10b526');
        
	
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$startrow, "Imex Id"); 

    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$startrow, "Created On"); 
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$startrow, "Business Unit"); 
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$startrow, "Shipment No"); 
	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$startrow, "Customer"); 
	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$startrow, "Warehouse"); 
	$objPHPExcel->getActiveSheet()->SetCellValue('G'.$startrow, "Country"); 
	$objPHPExcel->getActiveSheet()->SetCellValue('H'.$startrow, "Sales/Delv No"); 
	$objPHPExcel->getActiveSheet()->SetCellValue('I'.$startrow, "Net Wgt"); 
	$objPHPExcel->getActiveSheet()->SetCellValue('J'.$startrow, "Status"); 
	
	$startrow++;


}

Function PrintDetail($startrow,$objPHPExcel,$result)
{
	while($row = mysql_fetch_array($result)){ 			
						
  
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$startrow, $row[0]); 
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$startrow, ukdate($row['dh_imex_creation_date'])); 
	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$startrow, $row['dh_bu']); 
	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$startrow, GetBusinessCodes($row[dh_primary_id],$row[dh_header_child],'Y')); 
	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$startrow, $row['dh_partner_name']); 
	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$startrow, $row['dh_despatch_point']); 
	$objPHPExcel->getActiveSheet()->SetCellValue('G'.$startrow, GetISOCountry($row['dh_country']) ); 
	$objPHPExcel->getActiveSheet()->SetCellValue('H'.$startrow, GetOrderNumbers($row[dh_primary_id],$row[dh_header_child],$row[dh_bu],'Y')); 
	$objPHPExcel->getActiveSheet()->SetCellValue('I'.$startrow, GetWeights($row[dh_primary_id],di_net_weight,$row[dh_header_child],$row[dh_import_export]) ); 
	$objPHPExcel->getActiveSheet()->SetCellValue('J'.$startrow, GetStatus($row[5],$row[dh_primary_id],'Y' )); 
	

    $startrow++; 
}


}

?>