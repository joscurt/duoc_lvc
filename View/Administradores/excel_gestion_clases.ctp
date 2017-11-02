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
	
	
	
	$objPHPExcel->setActiveSheetIndex()->setCellValue('B4',"#");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('C4',"Fecha");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('D4',"Nombre Asignatura");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('E4',"SiglaSeccion");
	$objPHPExcel->setActiveSheetIndex()->setCellvalue('F4',"Jornada");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('G4',"Modalidad");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('H4',"Id Docente");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('I4',"Rut Docente");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('J4',"Apellido Paterno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('K4',"Apellido Materno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('L4',"Nombres");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('M4',"Sala");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('N4',"Horario");
	$objPHPExcel->setactiveSheetIndex()->setCellValue('O4',"Tipo");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('P4',"Detalle");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('Q4',"Estado");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('R4',"SubEstado");

	$objPHPExcel->setActiveSheetIndex()->getStyle("B4:R4")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("4")->setRowHeight(40);
	
	$count=0;
    $fila = 5;

    #debug($salas_list);exit();

    foreach ($clases as $detalle):

    	$count++;
    	$objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$fila,$count);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$fila,!empty($detalle['ProgramacionClase']['FECHA_CLASE'])? date('d-m-Y',strtotime($detalle['ProgramacionClase']['FECHA_CLASE'])):null);

		$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$fila,utf8_encode($detalle['Asignatura']['NOMBRE']));

		$objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$fila,$detalle['ProgramacionClase']['SIGLA_SECCION']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$fila,$detalle['ProgramacionClase']['COD_JORNADA']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$fila,utf8_encode($detalle['AsignaturaHorario']['TEO_PRA']));
		/*$objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$fila,$detalle['Docente']['RUT'].'-'.$detalle['Docente']['DV']);*/
		$objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$fila,$detalle['ProgramacionClase']['COD_DOCENTE']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$fila,$detalle['Docente']['RUT'].'-'.$detalle['Docente']['DV']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$fila,utf8_encode($detalle['Docente']['APELLIDO_PAT']));
		$objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$fila,utf8_encode($detalle['Docente']['APELLIDO_MAT']));
		$objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$fila,utf8_encode($detalle['Docente']['NOMBRE']));
		$objPHPExcel->setActiveSheetIndex()->setCellValue('M'.$fila,utf8_encode($detalle['ProgramacionClase']['SALA']));
		$objPHPExcel->setActiveSheetIndex()->setCellValue('N'.$fila,date('H:i',strtotime($detalle['ProgramacionClase']['HORA_INICIO'])).' '.date('H:i',strtotime($detalle['ProgramacionClase']['HORA_FIN'])));
		$objPHPExcel->setActiveSheetIndex()->setCellValue('O'.$fila,$detalle['ProgramacionClase']['TIPO_EVENTO']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('P'.$fila,$detalle['Detalle']['DETALLE']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('Q'.$fila,$detalle['Estado']['NOMBRE']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('R'.$fila,$detalle['SubEstado']['NOMBRE']);

       	$objPHPExcel->setActiveSheetIndex()->getRowDimension($fila)->setRowHeight(30);
        $fila++;
    endforeach;
    $objPHPExcel->setActiveSheetIndex()->getStyle("B5:R".($fila-1))->applyFromArray($cell_normal);
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
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('P')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('Q')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('R')->setWidth(20);

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Gestión_Clases '.'.'.date('dmY').'.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter->save('php://output');
	exit;
 ?>