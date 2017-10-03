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
	$objPHPExcel->setActiveSheetIndex()->mergeCells('B2:J2');
	$objPHPExcel->setActiveSheetIndex()->setCellValue('B2', "BITACORA DE EVENTOS: ".$asignatura_horario['Asignatura']['NOMBRE']);
	$objPHPExcel->setActiveSheetIndex()->getStyle("B2:J2")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("2")->setRowHeight(50);

	$objPHPExcel->setActiveSheetIndex()->setCellValue('B4',"#");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('C4',"Fecha Clase");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('D4',"Fecha Registro");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('E4',"Modalidad Clases");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('F4',"Horario");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('G4',"Docente");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('H4',"Tipo");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('I4',"Bit&aacute;cora Registrada");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('J4',"Bit&aacute;cora Docente");
	$objPHPExcel->setActiveSheetIndex()->getStyle("B4:J4")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("4")->setRowHeight(40);
	
    $count=0;
    $fila = 5;
    /*foreach ($programacion_clases as $detalle): 
        $count++;
        $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$fila, $count);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$fila, date('d-m-Y', strtotime($detalle['ProgramacionClase']['FECHA_CLASE'])));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$fila, date('d-m-Y', strtotime($detalle['ProgramacionClase']['FECHA_REGISTRAR_ASISTENCIA'])));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$fila, $detalle['ProgramacionClase']['MODALIDAD']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$fila, date('H:i', strtotime($detalle['ProgramacionClase']['HORA_INICIO'])).' - '.date('H:i', strtotime($detalle['ProgramacionClase']['HORA_FIN'])));
       	$objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$fila, $detalle['Docente']['NOMBRE'].' '.$detalle['Docente']['APELLIDO_PAT'].' '.$detalle['Docente']['APELLIDO_MAT']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$fila, $detalle['ProgramacionClase']['TIPO_EVENTO']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$fila, $detalle['bitacora']==true ? 'S&iacute;': 'No');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$fila, 'Bit&aacute;cora Docente');
       	$objPHPExcel->setActiveSheetIndex()->getRowDimension($fila)->setRowHeight(30);
		$objPHPExcel->setActiveSheetIndex()->getStyle("B5:J".$fila)->applyFromArray($cell_normal);
        $fila++;
    endforeach;*/
    for ($i=($fila); $i < (100+$fila); $i++) { 
    	$objPHPExcel->setActiveSheetIndex()->getRowDimension($i)->setRowHeight(30);
    }
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('B')->setWidth(10);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('C')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('E')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('F')->setWidth(25);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('G')->setWidth(40);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('H')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('I')->setWidth(10);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('J')->setWidth(20);

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Bit&aacute;cora '.$asignatura_horario['Asignatura']['NOMBRE'].'.'.date('dmY').'.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter->save('php://output');
	exit;
 ?>