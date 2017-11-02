<?php
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("Historico Asistencia")
         ->setLastModifiedBy("LVC")
         ->setTitle("Historico Asistencia")
         ->setSubject("Historico Asistencia")
         ->setDescription("Informe descargable del Historico Asistencia")
         ->setKeywords("office 2007 openxml php")
         ->setCategory("Historico Asistencia");
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
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->setActiveSheetIndex()->mergeCells('B2:H2');
	$objPHPExcel->setActiveSheetIndex()->setCellValue('B2', "Histórico Asistencia Alumno: ".utf8_encode($alumno['Alumno']['NOMBRES'].' '.$alumno['Alumno']['APELLIDO_PAT'].' '.$alumno['Alumno']['APELLIDO_MAT']).' | '.date('d-m-Y H:i'));
	$objPHPExcel->setActiveSheetIndex()->getStyle("B2:H2")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("2")->setRowHeight(50);

	$objPHPExcel->setActiveSheetIndex()->setCellValue('B4',"#");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('C4',"Fecha Clase");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('D4',"Modalidad Clase");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('E4',"Horario");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('F4',"Docente");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('G4',"Tipo");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('H4',"Asistencia");
	$objPHPExcel->setActiveSheetIndex()->getStyle("B4:H4")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("4")->setRowHeight(40);
	
    $count=0;
    $fila = 5;

    // debug($programacion_clases);exit();
    foreach ($programacion_clases as $detalle): 
        $count++;
    // debug($detalle['Asistencia']['ASISTENCIA']);

        $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$fila, $count);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$fila, date('d-m-Y', strtotime($detalle['ProgramacionClase']['FECHA_CLASE'])));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$fila, utf8_encode($detalle['ProgramacionClase']['MODALIDAD']));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$fila, date('H:i', strtotime($detalle['ProgramacionClase']['HORA_INICIO'])).' - '.date('H:i', strtotime($detalle['ProgramacionClase']['HORA_FIN'])));
       	$objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$fila, utf8_encode($detalle['Docente']['NOMBRE'].' '.$detalle['Docente']['APELLIDO_PAT'].' '.$detalle['Docente']['APELLIDO_MAT']));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$fila, $detalle['ProgramacionClase']['TIPO_EVENTO']);
        if ($detalle['ProgramacionClase']['WF_ESTADO_ID']>2){
    	 if ($detalle['Asistencia']['ASISTENCIA']==2) {
     	$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$fila,'Justificado');
     	}
       	if($detalle['Asistencia']['ASISTENCIA']==1){
       		$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$fila,'SI');	
       	}
       	if($detalle['Asistencia']['ASISTENCIA']==0){
       		$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$fila,'NO');	
       	}
       		if($detalle['Asistencia']['ASISTENCIA']==''){
       		$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$fila,'No registra');	
       	}
       }else{
       		$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$fila, 'No Impartida');
       	}
       
       	$objPHPExcel->setActiveSheetIndex()->getRowDimension($fila)->setRowHeight(30);
		$objPHPExcel->setActiveSheetIndex()->getStyle("B5:H".$fila)->applyFromArray($cell_normal);
        $fila++;
    endforeach;
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('B')->setWidth(10);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('C')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('E')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('F')->setWidth(25);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('G')->setWidth(40);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('H')->setWidth(20);

	/*Escribir el excel*/
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="historico_asistencia.xlsx"');
	header('Cache-Control: max-age=0');
	
	$objWriter->save('php://output');
	exit;
?>