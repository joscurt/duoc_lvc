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
	$objPHPExcel->setActiveSheetIndex()->mergeCells('B2:D2');
	$objPHPExcel->setActiveSheetIndex()->setCellValue('B2', "Docente: ".$docente['Docente']['NOMBRE'].' '.$docente['Docente']['APELLIDO_PAT'].' '.$docente['Docente']['APELLIDO_MAT']);
	$objPHPExcel->setActiveSheetIndex()->getStyle("B2:H2")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->mergeCells('E2:H2');
	$fecha_desde = date('d-m-Y',strtotime($semana['Semana']['FECHA_INICIO']));
	$fecha_fin = date('d-m-Y',strtotime($semana['Semana']['FECHA_FIN']));
	$objPHPExcel->setActiveSheetIndex()->setCellValue('E2', "SEMANA ".$semana['Semana']['NUMERO_SEMANA'].' '.$fecha_desde .' A '.$fecha_fin);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("2")->setRowHeight(50);

	$objPHPExcel->setActiveSheetIndex()->setCellValue('B4',"Semana");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('C4',"Lunes");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('D4',"Martes");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('E4',"Mi&eacute;rcoles");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('F4',"Jueves");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('G4',"Viernes");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('H4',"S&aacute;bado");
	$objPHPExcel->setActiveSheetIndex()->getStyle("B4:H4")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("4")->setRowHeight(40);
	
    $count=0;
    $fila = 5;
    foreach ($horarios_modulos as $detalle): 
        $count++;
        $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$fila, $detalle['HorarioModulo']['HORA_INICIO'].'-'.$detalle['HorarioModulo']['HORA_FIN']);
        $numero_letra = 2;
        $hora_inicio = $detalle['HorarioModulo']['HORA_INICIO'];
        for ($i=1; $i < 7; $i++):
    		if (isset($programacion_clases[$hora_inicio][$i])):
    			$valor_tmp = $programacion_clases[$hora_inicio][$i]['ProgramacionClase']['SIGLA_SECCION'].'  ';
    			$valor_tmp .= $programacion_clases[$hora_inicio][$i]['Asignatura']['NOMBRE'];
    			if ($filtro == 'duoc') {
    				$valor_tmp .= '  '.$programacion_clases[$hora_inicio][$i]['Sede']['NOMBRE'];
    			}
    			$objPHPExcel->setActiveSheetIndex()->setCellValue($letras_abecedario[$numero_letra].$fila, $valor_tmp);
    		endif;
    		$numero_letra++;
		endfor;
       	$objPHPExcel->setActiveSheetIndex()->getRowDimension($fila)->setRowHeight(45);
		$objPHPExcel->setActiveSheetIndex()->getStyle("B5:H".$fila)->applyFromArray($cell_normal);
        $fila++;
    endforeach;
    for ($i=($fila); $i < (100+$fila); $i++) { 
    	$objPHPExcel->setActiveSheetIndex()->getRowDimension($i)->setRowHeight(40);
    }
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('B')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('C')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('E')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('F')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('G')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('H')->setWidth(20);

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="horario_carga_docente_'.date('dmY').'.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter->save('php://output');
	exit;
 ?>