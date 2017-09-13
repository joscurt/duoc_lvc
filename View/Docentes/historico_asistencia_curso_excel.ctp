<?php
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("Historico Asistencia Curso")
         ->setLastModifiedBy("LVC")
         ->setTitle("Historico Asistencia Curso")
         ->setSubject("Historico Asistencia Curso")
         ->setDescription("Informe descargable del Historico Asistencia Curso")
         ->setKeywords("office 2007 openxml php")
         ->setCategory("Historico Asistencia Curso");
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
	$objPHPExcel->setActiveSheetIndex()->setCellValue('B2', "Histórico Asistencia Curso : ".$asignatura_horario['AsignaturaHorario']['SIGLA_SECCION'].' | '.date('d-m-Y H:i'));
	$objPHPExcel->setActiveSheetIndex()->getStyle("B2:J2")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("2")->setRowHeight(50);

	$objPHPExcel->setActiveSheetIndex()->setCellValue('B4',"#");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('C4',"Rut Alumno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('D4',"Apellido Paterno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('E4',"Apellido Materno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('F4',"Nombres");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('G4',"Clases Presente");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('H4',"Clases Ausente");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('I4',"Asistencia Actual");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('J4',"Asistencia");
	$objPHPExcel->setActiveSheetIndex()->getStyle("B4:J4")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("4")->setRowHeight(40);
	
    $count=0;
    $fila = 5;
    foreach ($alumnos as $detalle): 
        $count++;
        $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$fila, $count);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$fila, $detalle['Alumno']['RUT']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$fila, $detalle['Alumno']['APELLIDO_PAT']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$fila, $detalle['Alumno']['APELLIDO_MAT']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$fila, $detalle['Alumno']['NOMBRES']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$fila, isset($indicadores[$detalle['Alumno']['ID']])?$indicadores[$detalle['Alumno']['ID']]['CLASES_PRESENTE']:null);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$fila, isset($indicadores[$detalle['Alumno']['ID']])?$indicadores[$detalle['Alumno']['ID']]['CLASES_AUSENTE']:null);
        $clases_presente = $indicadores[$detalle['Alumno']['ID']]['CLASES_PRESENTE'];
		$total_hoy = $indicadores[$detalle['Alumno']['ID']]['CLASES_IMPARTIDAS'];
		$asistencia_actual = $clases_presente*100/$total_hoy;
		$asistencia_actual = round($asistencia_actual,1);
		$asistencia_total = round(($clases_presente*100/$total_clases),1); 
        $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$fila, $asistencia_actual);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$fila, $asistencia_total);
        
        $objPHPExcel->setActiveSheetIndex()->getRowDimension($fila)->setRowHeight(30);
		$objPHPExcel->setActiveSheetIndex()->getStyle("B5:J".$fila)->applyFromArray($cell_normal);
        $fila++;
    endforeach;
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('B')->setWidth(10);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('C')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('E')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('F')->setWidth(25);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('G')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('H')->setWidth(20);

	/*Escribir el excel*/
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="historico_asistencia_curso.xlsx"');
	header('Cache-Control: max-age=0');
	
	$objWriter->save('php://output');
	exit;
?>