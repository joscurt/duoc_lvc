<?php
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("LISTADO DE CLASES POR RECUPERAR: ".date('dmYH:i'))
                     ->setLastModifiedBy("LVC")
                     ->setTitle("LISTADO DE CLASES POR RECUPERAR: ".date('dmYH:i'))
                     ->setSubject("LISTADO")
                     ->setDescription("Listado de clases por recuperar")
                     ->setKeywords("office 2007 openxml php")
                     ->setCategory("Listado de clases por recuperar");
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
	$objPHPExcel->setActiveSheetIndex()->mergeCells('B2:N2');
	$objPHPExcel->setActiveSheetIndex()->setCellValue('B2', "LISTADO DE CLASES POR RECUPERAR: ". " FECHA: ".date('d-m-Y') . " HORA: ".date('H:i'));
	$objPHPExcel->setActiveSheetIndex()->getStyle("B2:N2")->applyFromArray($style_back_blue);
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
	$objPHPExcel->setActiveSheetIndex()->getStyle("B4:N4")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("4")->setRowHeight(40);
	
    $count=0;
    $fila = 5;
    if (isset($datos_excel['Excel'])) {
    	foreach ($datos_excel['Excel'] as $detalle): 
	        $count++;
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$fila, $count);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$fila, $detalle['FECHA_CLASE']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$fila, $detalle['NOMBRE_ASIGNATURA']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$fila, $detalle['SIGLA_SECCION']);
	        $jornada = '';
			if (!empty($detalle['COD_JORNADA'])):
				$jornada = $detalle['COD_JORNADA'] == 'D' ? 'Diurno':$jornada;
             	$jornada = $detalle['COD_JORNADA'] == 'V' ? 'Vespertino':$jornada;
            endif;
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$fila, $jornada);
	       	$objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$fila, $detalle['RUT']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$fila, $detalle['APELLIDO_PAT']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$fila, $detalle['APELLIDO_MAT']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$fila, $detalle['NOMBRE_DOCENTE']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$fila, $detalle['SALA']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$fila, date('H:m', strtotime($detalle['HORA_INICIO'])).'-'.date('H:m', strtotime($detalle['HORA_FIN'])));
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('M'.$fila, $detalle['TIPO_EVENTO']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('N'.$fila, $detalle['DETALLE']);
	       	$objPHPExcel->setActiveSheetIndex()->getRowDimension($fila)->setRowHeight(30);
			$objPHPExcel->setActiveSheetIndex()->getStyle("B5:N".$fila)->applyFromArray($cell_normal);
	        $fila++;
	    endforeach;
    }else{
    	foreach ($datos_excel as $detalle): 
	        $count++;
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$fila, $count);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$fila, date('d-m-Y', strtotime($detalle['ProgramacionClase']['FECHA_CLASE'])));
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$fila, $detalle['Asignatura']['NOMBRE']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$fila, $detalle['ProgramacionClase']['SIGLA_SECCION']);
			$jornada = '';
			if (!empty($detalle['ProgramacionClase']['COD_JORNADA'])):
				$jornada = $detalle['ProgramacionClase']['COD_JORNADA'] == 'D' ? 'Diurno':$jornada;
             	$jornada = $detalle['ProgramacionClase']['COD_JORNADA'] == 'V' ? 'Vespertino':$jornada;
            endif;
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$fila, $jornada);
	       	$objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$fila, $detalle['Docente']['RUT'].'-'.$detalle['Docente']['DV']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$fila, $detalle['Docente']['APELLIDO_PAT']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$fila, $detalle['Docente']['APELLIDO_MAT']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$fila, $detalle['Docente']['NOMBRE']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$fila, $detalle['ProgramacionClase']['SALA']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$fila, date('H:i', strtotime($detalle['ProgramacionClase']['HORA_INICIO'])).'-'.date('H:i', strtotime($detalle['ProgramacionClase']['HORA_FIN'])));
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('M'.$fila, $detalle['ProgramacionClase']['TIPO_EVENTO']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('N'.$fila, $detalle['Detalle']['DETALLE']);
	       	$objPHPExcel->setActiveSheetIndex()->getRowDimension($fila)->setRowHeight(30);
			$objPHPExcel->setActiveSheetIndex()->getStyle("B5:N".$fila)->applyFromArray($cell_normal);
	        $fila++;
	    endforeach;
    }    
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

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Clases por recuperar'.'.'.date('dmY').'.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter->save('php://output');
	exit;
 ?>