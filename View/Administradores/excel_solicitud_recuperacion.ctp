<?php
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("Planilla Eventos")
                     ->setLastModifiedBy("LVC")
                     ->setTitle("Planilla Eventos")
                     ->setSubject("Planilla")
                     ->setDescription("Planilla DE EVENTOS")
                     ->setKeywords("office 2007 openxml php")
                     ->setCategory("Planilla DE EVENTOS");
                 	##
	$objPHPExcel->setActiveSheetIndex(0);
	$letras_abecedario = array(
		'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
		'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ',
		'BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ',
		'CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ'
	);
	$style_back_blue = array(
		'font' =>array(
			'color' =>array('rgb' => 'ffffff'),
			'bold' => true,
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => '092c50')
		),
	   	'alignment' => array(
			'wrap'       => true,
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
		),
		'borders' => array(
		    'allborders' => array(
		      'style' => PHPExcel_Style_Border::BORDER_THIN
		    )
		),
		'startcolor' => array(
			'rgb' => 'D0D0D0'
		)
	);
	$cell_normal = array(
		'font' =>array(
			'color' =>array(
				'rgb' => '000000'
			),
			'bold' => true,
		),
	    'alignment' => array(
			'wrap'       => true,
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
		),
		'borders' => array(
		    'allborders' => array(
		      'style' => PHPExcel_Style_Border::BORDER_THIN
		    )
		),
		'startcolor' => array(
			'rgb' => 'D0D0D0'
		)
	);
	
	/*$objPHPExcel->setActiveSheetIndex()->setCellValue('B2', "Sigla Secci&oacute;n: ");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('C2', !empty($docente)?"Docente: ".$docente['Docente']['NOMBRE'].' '.$docente['Docente']['APELLIDO_PAT'].' '.$docente['Docente']['APELLIDO_MAT']:null);
	$objPHPExcel->setActiveSheetIndex()->setCellValue('D2', "Fecha Desde: ".$fecha_desde);
	$objPHPExcel->setActiveSheetIndex()->setCellValue('E2', "Fecha Hasta: ".$fecha_hasta);
	*/

	$objPHPExcel->setActiveSheetIndex()->getRowDimension("2")->setRowHeight(50);
	$objPHPExcel->setActiveSheetIndex()->getStyle("B2:E2")->applyFromArray($style_back_blue);
	
	$objPHPExcel->setActiveSheetIndex()->setCellValue('B4',"#");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('C4',"Fecha");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('D4',"Nombre Asignatura");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('E4',"Sigla-Secci&oacute;n");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('F4',"Jornada");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('G4',"Rut docente");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('H4',"Apellido Paterno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('I4',"Apellido Materno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('J4',"Nombres");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('K4',"Sala");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('L4',"Horario");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('M4',"Tipo");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('N4',"Detalle");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('O4',"Estado");
	$objPHPExcel->setActiveSheetIndex()->getStyle("B4:O4")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("4")->setRowHeight(40);
	
	$count=0;
    $fila = 5;
    foreach ($programacion_clases as $detalle): 
    	$count++;
    	$objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$fila,$count);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$fila,!empty($detalle['ProgramacionClase']['FECHA_CLASE'])? date('d-m-Y',strtotime($detalle['ProgramacionClase']['FECHA_CLASE'])):null);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$fila,$detalle['Asignatura']['NOMBRE']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$fila,$detalle['ProgramacionClase']['SIGLA_SECCION']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$fila,$detalle['ProgramacionClase']['COD_JORNADA']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$fila,$detalle['Docente']['RUT'].'-'.$detalle['Docente']['DV']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$fila,$detalle['Docente']['APELLIDO_PAT']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$fila,$detalle['Docente']['APELLIDO_MAT']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$fila,$detalle['Docente']['NOMBRE']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$fila,$detalle['ProgramacionClase']['SALA']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$fila,date('H:i',strtotime($detalle['ProgramacionClase']['HORA_INICIO'])).' '.date('H:i',strtotime($detalle['ProgramacionClase']['HORA_FIN'])));
		$objPHPExcel->setActiveSheetIndex()->setCellValue('M'.$fila,$detalle['ProgramacionClase']['TIPO_EVENTO']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('N'.$fila,$detalle['Detalle']['DETALLE']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('O'.$fila,$detalle['EstadoProgramacion']['NOMBRE']);
       	$objPHPExcel->setActiveSheetIndex()->getRowDimension($fila)->setRowHeight(30);
		$objPHPExcel->setActiveSheetIndex()->getStyle("B5:O".$fila)->applyFromArray($cell_normal);
        $fila++;
    endforeach;
    for ($i=($fila); $i < (100+$fila); $i++) { 
    	$objPHPExcel->setActiveSheetIndex()->getRowDimension($i)->setRowHeight(30);
    }
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('B')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('C')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('E')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('F')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('G')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('H')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('I')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('J')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('K')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('L')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('M')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('N')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('O')->setWidth(20);

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="solicitud_recuperacion_date'.date('dmY').'.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter->save('php://output');
	exit;
 ?>