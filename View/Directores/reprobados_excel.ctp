<?php
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("LISTADO CLASES POR AUTORIZAR: ".date('dmYH:i'))
                     ->setLastModifiedBy("LVC")
                     ->setTitle("LISTADO CLASES POR AUTORIZAR: ".date('dmYH:i'))
                     ->setSubject("LISTADO")
                     ->setDescription("Listado de clases por autorizar")
                     ->setKeywords("office 2007 openxml php")
                     ->setCategory("Listado de clases por autorizar");
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
	$objPHPExcel->setActiveSheetIndex()->mergeCells('C2:L2');
	$objPHPExcel->setActiveSheetIndex()->setCellValue('C2', "LISTADO DE CLASES POR AUTORIZAR EN RI: ". " FECHA: ".date('d-m-Y') . " HORA: ".date('H:i'));
	$objPHPExcel->setActiveSheetIndex()->getStyle("C2:L2")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("2")->setRowHeight(50);

	$objPHPExcel->setActiveSheetIndex()->setCellValue('C4',"#");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('D4',"Nombre Asignatura");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('E4',"Sigla-Sección");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('F4',"Jornada");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('G4',"Rut Docente");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('H4',"Apellido Paterno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('I4',"Apellido Materno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('J4',"Nombres");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('K4',"Nro Clases Registradas");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('L4',"Asistencia Promedio");
	$objPHPExcel->setActiveSheetIndex()->getStyle("C4:L4")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("4")->setRowHeight(40);
	
    $count=0;
    $fila = 5;
    // debug($datos_tabla);exit();
    foreach ($datos_tabla as $detalle): 
        $count++;
        $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$fila, $count);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$fila, utf8_encode($detalle['Asignatura']['NOMBRE']));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$fila, $detalle['AsignaturaHorario']['SIGLA_SECCION']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$fila, $detalle['AsignaturaHorario']['COD_JORNADA']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$fila, $detalle['Docente']['RUT'].'-'.$detalle['Docente']['DV']);
       	$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$fila, utf8_encode($detalle['Docente']['APELLIDO_PAT']));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$fila, utf8_encode($detalle['Docente']['APELLIDO_MAT']));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$fila, utf8_encode($detalle['Docente']['NOMBRE']));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$fila, (int)$detalle['AsignaturaHorario']['CLASES_REGISTRADAS']);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$fila, (float)$detalle['AsignaturaHorario']['ASIST_PROMEDIO']);
       	$objPHPExcel->setActiveSheetIndex()->getRowDimension($fila)->setRowHeight(30);
		$objPHPExcel->setActiveSheetIndex()->getStyle("C5:L".$fila)->applyFromArray($cell_normal);
        $fila++;
    endforeach;
    for ($i=($fila); $i < (100+$fila); $i++) { 
    	$objPHPExcel->setActiveSheetIndex()->getRowDimension($i)->setRowHeight(30);
    }
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('C')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('D')->setWidth(35);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('E')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('F')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('G')->setWidth(30);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('H')->setWidth(30);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('I')->setWidth(30);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('J')->setWidth(30);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('K')->setWidth(15);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('L')->setWidth(25);

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="ReprobadosPorInasistencia'.'.'.date('dmYHi').'.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter->save('php://output');
	exit;
 ?>