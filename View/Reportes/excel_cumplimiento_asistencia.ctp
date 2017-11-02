<?php
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("CUMPLIMIENTO ASISTENCIA: ".date('dmYH:i'))
                     ->setLastModifiedBy("LVC")
                     ->setTitle("CUMPLIMIENTO ASISTENCIA: ".date('dmYH:i'))
                     ->setSubject("LISTADO")
                     ->setDescription("CUMPLIMIENTO ASISTENCIA")
                     ->setKeywords("office 2007 openxml php")
                     ->setCategory("CUMPLIMIENTO ASISTENCIA");
                 	##
	$objPHPExcel->setActiveSheetIndex(0);
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
	$objPHPExcel->setActiveSheetIndex()->mergeCells('B2:L2');
	$objPHPExcel->setActiveSheetIndex()->setCellValue('B2', "CUMPLIMIENTO DE REGISTRO DE ASISTENCIA DOCENTE: ". " FECHA: ".date('d-m-Y') . " HORA: ".date('H:i'));
	$objPHPExcel->setActiveSheetIndex()->getStyle("B2:L2")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("2")->setRowHeight(50);

	$objPHPExcel->setActiveSheetIndex()->setCellValue('B4',"#");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('C4',"Nombre Asignatura");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('D4',"Sigla-Secci&oacute;n");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('E4',"Rut Docente");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('F4',"Apellido Paterno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('G4',"Apellido Materno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('H4',"Nombres");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('I4',"Clases Regulares");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('J4',"Clases Suspendidas");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('K4',"Clases Registradas");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('L4',"% Cumplimiento");
	$objPHPExcel->setActiveSheetIndex()->getStyle("B4:L4")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("4")->setRowHeight(40);
	
    $count=0;
    $fila = 5;
    #debug($registros);
    // debug($indicadores_sigla_seccion);
    // exit();

	foreach ($registros as $detalle): 
		
		$indicadores = isset($indicadores_sigla_seccion[$detalle['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']])?$indicadores_sigla_seccion[$detalle['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']]:array();
		$count++;
        $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$fila, $count);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$fila, $detalle['Asignatura']['NOMBRE']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$fila, $detalle['AsignaturaHorario']['SIGLA_SECCION']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$fila, $detalle['Docente']['RUT'].'-'.$detalle['Docente']['DV']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$fila, $detalle['Docente']['APELLIDO_PAT']);
       	$objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$fila, $detalle['Docente']['APELLIDO_MAT']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$fila, $detalle['Docente']['NOMBRE']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$fila, !empty($indicadores)? $indicadores['CLASES_REGULARES']:0);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$fila, !empty($indicadores)? $indicadores['CLASES_SUSPENDIDAS']:0);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$fila, !empty($indicadores)? $indicadores['CLASES_REGISTRADAS']:0);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$fila,!empty($indicadores)? round(($indicadores['CLASES_REGISTRADAS']*100/$indicadores['CLASES_REGULARES']),2).'%':null);
        $objPHPExcel->setActiveSheetIndex()->getRowDimension($fila)->setRowHeight(30);
		$objPHPExcel->setActiveSheetIndex()->getStyle("B5:L".$fila)->applyFromArray($cell_normal);
        $fila++;
    endforeach;  
    for ($i=($fila); $i < (100+$fila); $i++) { 
    	$objPHPExcel->setActiveSheetIndex()->getRowDimension($i)->setRowHeight(30);
    }
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('B')->setWidth(10);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('C')->setWidth(15);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('D')->setWidth(35);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('E')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('F')->setWidth(10);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('G')->setWidth(25);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('H')->setWidth(30);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('I')->setWidth(30);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('J')->setWidth(30);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('K')->setWidth(15);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('L')->setWidth(20);

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="reporte_'.date('dmY_Hi').'.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter->save('php://output');
	exit;
 ?>