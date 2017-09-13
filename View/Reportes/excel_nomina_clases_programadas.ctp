<?php
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("LISTADO DE CLASES programadas: ".date('dmYH:i'))
                     ->setLastModifiedBy("LVC")
                     ->setTitle("LISTADO DE CLASES programadas: ".date('dmYH:i'))
                     ->setSubject("LISTADO")
                     ->setDescription("Listado de clases programadas")
                     ->setKeywords("office 2007 openxml php")
                     ->setCategory("Listado de clases programadas");
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
	$objPHPExcel->setActiveSheetIndex()->mergeCells('B2:P2');
	$objPHPExcel->setActiveSheetIndex()->setCellValue('B2', "NÓMINA DIARIA DE CLASES PROGRAMADAS: ". " FECHA: ".date('d-m-Y') . " HORA: ".date('H:i'));
	$objPHPExcel->setActiveSheetIndex()->getStyle("B2:P2")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("2")->setRowHeight(50);

	$objPHPExcel->setActiveSheetIndex()->setCellValue('B4',"#");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('C4',"Fecha");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('D4',"Nombre Asignatura");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('E4',"Sigla-Sección");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('F4',"Jornada");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('G4',"Rut Docente");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('H4',"Apellido Paterno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('I4',"Apellido Materno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('J4',"Nombres");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('K4',"Sala");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('L4',"Horario");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('M4',"Tipo");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('N4',"Detalle");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('O4',"Estado");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('P4',"SubEstado");
	$objPHPExcel->setActiveSheetIndex()->getStyle("B4:P4")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("4")->setRowHeight(40);
	
    $count=0;
    $fila = 5;
    	foreach ($registros as $detalle): 
	        $count++;
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$fila, $count);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$fila, date('d-m-Y', strtotime($detalle['ProgramacionClase']['FECHA_CLASE'])));
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$fila, $detalle['Asignatura']['NOMBRE']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$fila, $detalle['ProgramacionClase']['SIGLA_SECCION']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$fila, isset($detalle['ProgramacionClase']['COD_JORNADA']) && $detalle['ProgramacionClase']['COD_JORNADA']=='D' ? 'Diurno' : 'Vespertino');
	       	$objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$fila, $detalle['Docente']['RUT'].'-'.$detalle['Docente']['DV']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$fila, utf8_encode($detalle['Docente']['APELLIDO_PAT']));
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$fila, utf8_encode($detalle['Docente']['APELLIDO_MAT']));
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$fila, utf8_encode($detalle['Docente']['NOMBRE']));
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$fila, !empty($detalle['Sala']['TIPO_SALA'])?$detalle['Sala']['TIPO_SALA']:$detalle['SalaReemplazo']['TIPO_SALA']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$fila, date('H:i', strtotime($detalle['ProgramacionClase']['HORA_INICIO'])).'-'.date('H:i', strtotime($detalle['ProgramacionClase']['HORA_FIN'])));
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('M'.$fila, $detalle['ProgramacionClase']['TIPO_EVENTO']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('N'.$fila, $detalle['Detalle']['DETALLE']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('O'.$fila, $detalle['Estado']['NOMBRE']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('P'.$fila, $detalle['SubEstado']['NOMBRE']);
	       	$objPHPExcel->setActiveSheetIndex()->getRowDimension($fila)->setRowHeight(30);
			$objPHPExcel->setActiveSheetIndex()->getStyle("B5:P".$fila)->applyFromArray($cell_normal);
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
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('M')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('N')->setWidth(35);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('O')->setWidth(35);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('P')->setWidth(35);

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="reporte_'.date('dmY_Hi').'.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter->save('php://output');
	exit;
 ?>