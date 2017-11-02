<?php
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("TASA ASISTENCIA Y RI: ".date('dmYH:i'))
                     ->setLastModifiedBy("LVC")
                     ->setTitle("TASA ASISTENCIA Y RI: ".date('dmYH:i'))
                     ->setSubject("LISTADO")
                     ->setDescription("TASA ASISTENCIA Y RI")
                     ->setKeywords("office 2007 openxml php")
                     ->setCategory("TASA ASISTENCIA Y RI");
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
	$objPHPExcel->setActiveSheetIndex()->setCellValue('B2', "TASA DE ASISTENCIA DEL ALUMNO: ". " FECHA: ".date('d-m-Y') . " HORA: ".date('H:i'));
	$objPHPExcel->setActiveSheetIndex()->getStyle("B2:L2")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("2")->setRowHeight(50);

	$objPHPExcel->setActiveSheetIndex()->setCellValue('B4',"#");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('C4',"Nombre Asignatura");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('D4',"Sigla-Sección");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('E4',"Rut Alumno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('F4',"Apellido Paterno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('G4',"Apellido Materno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('H4',"Nombres");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('I4',"Clases Presente");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('J4',"Clases Ausente");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('K4',"Clases Justificadas");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('L4',"Asistencia Actual");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('M4',"RI");
	$objPHPExcel->setActiveSheetIndex()->getStyle("B4:M4")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("4")->setRowHeight(40);
	
    $count=0;
    $fila = 5;
    	foreach ($registros as $detalle): 
    		$porcentaje = 0;
			if (isset($indicadores_alumnos[$detalle['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$detalle['Alumno']['COD_ALUMNO']])) {
				$porcentaje = $indicadores_alumnos[$detalle['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$detalle['Alumno']['COD_ALUMNO']]['CLASES_PRESENTE']*100/$detalle['AsignaturaHorario']['CLASES_REGISTRADAS'];	
			}
			if ($detalle['RI']['RI_DIRECTOR']==0) {
				# code...
			
	        $count++;
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$fila, $count);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$fila, utf8_encode($detalle['Asignatura']['NOMBRE']));
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$fila, $detalle['AlumnoAsignatura']['SIGLA_SECCION']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$fila, $detalle['Alumno']['RUT'].'-'.$detalle['Alumno']['DV_RUT']);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$fila, utf8_encode($detalle['Alumno']['APELLIDO_PAT']));
	       	$objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$fila, utf8_encode($detalle['Alumno']['APELLIDO_MAT']));
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('H'.$fila, utf8_encode($detalle['Alumno']['NOMBRES']));
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('I'.$fila, isset($indicadores_alumnos[$detalle['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$detalle['Alumno']['COD_ALUMNO']])? $indicadores_alumnos[$detalle['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$detalle['Alumno']['COD_ALUMNO']]['CLASES_PRESENTE']:0);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('J'.$fila, isset($indicadores_alumnos[$detalle['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$detalle['Alumno']['COD_ALUMNO']])? $indicadores_alumnos[$detalle['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$detalle['Alumno']['COD_ALUMNO']]['CLASES_AUSENTE']:0);
	       $objPHPExcel->setActiveSheetIndex()->setCellValue('K'.$fila, isset($indicadores_alumnos[$detalle['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$detalle['Alumno']['COD_ALUMNO']])? $indicadores_alumnos[$detalle['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$detalle['Alumno']['COD_ALUMNO']]['CLASES_JUSTIFICADOS']:0);
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('L'.$fila, number_format($porcentaje,2,',','.').'%');
	        #debug($porcentaje);
	        $check = 'NO';
			if ($detalle['RI']['RI_DIRECTOR']==1) {
				$check = 'SI';
			}
	        $objPHPExcel->setActiveSheetIndex()->setCellValue('M'.$fila,$check);
	        $objPHPExcel->setActiveSheetIndex()->getRowDimension($fila)->setRowHeight(30);
			$objPHPExcel->setActiveSheetIndex()->getStyle("B5:M".$fila)->applyFromArray($cell_normal);
	        $fila++;
	        }
	    endforeach;  
	  #Exit();
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