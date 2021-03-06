<?php
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("REPROBADOS INASISTENCIA: ".$asignatura_horario['Asignatura']['NOMBRE'])
                     ->setLastModifiedBy("LVC")
                     ->setTitle("REPROBADOS INASISTENCIA: ".$asignatura_horario['Asignatura']['NOMBRE'])
                     ->setSubject("BITACORA")
                     ->setDescription("REPROBADOS INASISTENCIA")
                     ->setKeywords("office 2007 openxml php")
                     ->setCategory("REPROBADOS INASISTENCIA");
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
	$objPHPExcel->setActiveSheetIndex()->setCellValue('B2', "REPROBADOS INASISTENCIA: ".$asignatura_horario['Asignatura']['NOMBRE']);
	$objPHPExcel->setActiveSheetIndex()->getStyle("B2:J2")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("2")->setRowHeight(50);

	$objPHPExcel->setActiveSheetIndex()->setCellValue('B4',"RI");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('C4',"Apellido Paterno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('D4',"Apellido Paterno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('E4',"Apellido Materno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('F4',"Nombres");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('G4',"Clases Regulares Presente");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('H4',"Clases Regulares Ausente");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('I4',"Asistencia");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('J4',"Comentarios al Director de Carrera (Opcional)");
	$objPHPExcel->setActiveSheetIndex()->getStyle("B4:J4")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("4")->setRowHeight(40);
	
    $count=0;
    $fila = 5;
    foreach ($alumnos as $value): 
    	$porcentaje = 0;
		if (isset($indicadores_alumnos[$value['Alumno']['COD_ALUMNO']])) {
			$porcentaje = $indicadores_alumnos[$value['Alumno']['COD_ALUMNO']]['CLASES_PRESENTE']*100/$asignatura_horario['AsignaturaHorario']['CLASES_REGISTRADAS'];	
		}
		$checkbox = ($porcentaje < $porcentaje_minimo_ri)?'SI':'NO'; 
		$observaciones = '';
		if (!empty($value['RI']['ID'])) {
			$checkbox = ((int)$value['RI']['R_I'] === 1)?'SI':'NO'; 
			$observaciones = $value['RI']['OBSERVACIONES'];
		}
		$objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$fila, $checkbox);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$fila, strtoupper($value['Alumno']['RUT']));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$fila, strtoupper($value['Alumno']['APELLIDO_PAT']));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$fila, strtoupper($value['Alumno']['APELLIDO_MAT']));
        $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$fila, strtoupper($value['Alumno']['NOMBRES']));
       	$objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$fila, isset($indicadores_alumnos[$value['Alumno']['COD_ALUMNO']])? $indicadores_alumnos[$value['Alumno']['COD_ALUMNO']]['CLASES_PRESENTE']:0);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$fila, isset($indicadores_alumnos[$value['Alumno']['COD_ALUMNO']])? $indicadores_alumnos[$value['Alumno']['COD_ALUMNO']]['CLASES_AUSENTE']:0);
        $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$fila, round($porcentaje,2).'%');
        $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$fila, $observaciones);
       	$objPHPExcel->setActiveSheetIndex()->getRowDimension($fila)->setRowHeight(30);
		$objPHPExcel->setActiveSheetIndex()->getStyle("B5:J".$fila)->applyFromArray($cell_normal);
        $fila++;
    endforeach;
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
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('I')->setWidth(40);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('J')->setWidth(40);

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="Bit&aacute;cora '.$asignatura_horario['Asignatura']['NOMBRE'].'.'.date('dmY').'.xlsx"');
	header('Cache-Control: max-age=0');
	$objWriter->save('php://output');
	exit;
 ?>