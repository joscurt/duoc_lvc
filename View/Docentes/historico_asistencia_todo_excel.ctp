<?php
	$objPHPExcel = new PHPExcel();
	$objPHPExcel->getProperties()->setCreator("Historico Asistencia Todo")
         ->setLastModifiedBy("LVC")
         ->setTitle("Historico Asistencia Todo")
         ->setSubject("Historico Asistencia Todo")
         ->setDescription("Informe descargable del Historico Asistencia Todo")
         ->setKeywords("office 2007 openxml php")
         ->setCategory("Historico Asistencia Todo");
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
	$style_back_orange = array(
		'font' =>array(
			'color' =>array('rgb' => 'ffffff'),
			'bold' => true,
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'F38337')
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
			'rgb' => 'F38337'
		)
	);
	$style_back_gray = array(
		'font' =>array(
			'color' =>array('rgb' => 'ffffff'),
			'bold' => true,
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'B7B7B7')
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
			'rgb' => 'B7B7B7'
		)
	);
	$style_back_yellow = array(
		'font' =>array(
			'color' =>array('rgb' => 'ffffff'),
			'bold' => true,
		),
		'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'EEBB09')
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
			'rgb' => 'EEBB09'
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
	$objPHPExcel->setActiveSheetIndex()->mergeCells('B2:J2');
	$objPHPExcel->setActiveSheetIndex()->setCellValue('B2', "Histórico Asistencia Todo : ".$asignatura_horario['AsignaturaHorario']['SIGLA_SECCION'].' | '.date('d-m-Y H:i'));
	$objPHPExcel->setActiveSheetIndex()->getStyle("B2:J2")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("2")->setRowHeight(50);
	#ORANGE
	$objPHPExcel->setActiveSheetIndex()->setCellValue('B4', '');
	$objPHPExcel->setActiveSheetIndex()->getStyle("B4")->applyFromArray($style_back_orange);
	$objPHPExcel->setActiveSheetIndex()->setCellValue('C4', 'CLASE SUSPENDIDA');
	$objPHPExcel->setActiveSheetIndex()->getColumnDimension('C')->setWidth(30);
	$objPHPExcel->setActiveSheetIndex()->getStyle("C4")->applyFromArray($cell_normal);
	#YELLOW
	$objPHPExcel->setActiveSheetIndex()->setCellValue('B5', '');
	$objPHPExcel->setActiveSheetIndex()->getStyle("B5")->applyFromArray($style_back_yellow);
	$objPHPExcel->setActiveSheetIndex()->setCellValue('C5', 'CLASE NO REGISTRADA');
	$objPHPExcel->setActiveSheetIndex()->getColumnDimension('C')->setWidth(30);
	$objPHPExcel->setActiveSheetIndex()->getStyle("C5")->applyFromArray($cell_normal);
	#GRAY
	$objPHPExcel->setActiveSheetIndex()->setCellValue('B6', '');
	$objPHPExcel->setActiveSheetIndex()->getStyle("B6")->applyFromArray($style_back_gray);
	$objPHPExcel->setActiveSheetIndex()->setCellValue('C6', 'CLASE NO IMPARTIDA');
	$objPHPExcel->setActiveSheetIndex()->getColumnDimension('C')->setWidth(30);
	$objPHPExcel->setActiveSheetIndex()->getStyle("C6")->applyFromArray($cell_normal);

	$objPHPExcel->setActiveSheetIndex()->setCellValue('D8',"Número Clase");
	$objPHPExcel->setActiveSheetIndex()->mergeCells('D8:G8');
	$objPHPExcel->setActiveSheetIndex()->setCellValue('D9',"Modalidad Clase");
	$objPHPExcel->setActiveSheetIndex()->mergeCells('D9:G9');
	$objPHPExcel->setActiveSheetIndex()->setCellValue('D10',"Tipo");
	$objPHPExcel->setActiveSheetIndex()->mergeCells('D10:G10');
	$objPHPExcel->setActiveSheetIndex()->setCellValue('D11',"Fecha Clase");
	$objPHPExcel->setActiveSheetIndex()->mergeCells('D11:G11');
	$objPHPExcel->setActiveSheetIndex()->setCellValue('D12',"Fecha Registro de Asistencia");
	$objPHPExcel->setActiveSheetIndex()->mergeCells('D12:G12');
	$objPHPExcel->setActiveSheetIndex()->getStyle("D8:G12")->applyFromArray($style_back_blue);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("4")->setRowHeight(40);

	$objPHPExcel->setActiveSheetIndex()->setCellValue('B13',"#");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('C13',"Rut Alumno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('D13',"Apellido Paterno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('E13',"Apellido Materno");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('F13',"Nombre");
	$objPHPExcel->setActiveSheetIndex()->setCellValue('G13',"Asistencia");
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('E')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('F')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getColumnDimension('G')->setWidth(20);
    $objPHPExcel->setActiveSheetIndex()->getStyle("B13:G13")->applyFromArray($style_back_blue);
    $objPHPExcel->setActiveSheetIndex()->getRowDimension("4")->setRowHeight(30);
    $objPHPExcel->setActiveSheetIndex()->getRowDimension("5")->setRowHeight(30);
    $objPHPExcel->setActiveSheetIndex()->getRowDimension("6")->setRowHeight(30);

    $objPHPExcel->setActiveSheetIndex()->getRowDimension("8")->setRowHeight(30);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("9")->setRowHeight(30);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("10")->setRowHeight(30);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("11")->setRowHeight(30);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("12")->setRowHeight(30);
	$objPHPExcel->setActiveSheetIndex()->getRowDimension("13")->setRowHeight(30);

	$row = 14;
	foreach ($alumnos as $key => $value){
		$objPHPExcel->setActiveSheetIndex()->setCellValue('B'.$row,$key+1);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('C'.$row,$value['Alumno']['RUT']);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('D'.$row,strtoupper(utf8_encode($value['Alumno']['APELLIDO_PAT'])));
		$objPHPExcel->setActiveSheetIndex()->setCellValue('E'.$row,strtoupper(utf8_encode($value['Alumno']['APELLIDO_MAT'])));
		$objPHPExcel->setActiveSheetIndex()->setCellValue('F'.$row,strtoupper(utf8_encode($value['Alumno']['NOMBRES'])));
		$clases_presente = isset($indicadores[$value['Alumno']['ID']])?$indicadores[$value['Alumno']['ID']]['CLASES_PRESENTE']:0;
		$clases_totales = isset($indicadores[$value['Alumno']['ID']])?$indicadores[$value['Alumno']['ID']]['CLASES_IMPARTIDAS']:0;
		$porcentaje = round($clases_presente*100/$clases_totales);
		$objPHPExcel->setActiveSheetIndex()->setCellValue('G'.$row,$porcentaje.'%');
		$objPHPExcel->setActiveSheetIndex()->getRowDimension($row)->setRowHeight(30);
		$row++;
	}
	$objPHPExcel->setActiveSheetIndex()->getStyle("B14:G".($row-1))->applyFromArray($cell_normal);
	$numero_letra = 7;
	foreach ($programacion_clases as $key => $value){
		$objPHPExcel->setActiveSheetIndex()->setCellValue($letras_abecedario[$numero_letra].'8',($key+1));
		$objPHPExcel->setActiveSheetIndex()->setCellValue($letras_abecedario[$numero_letra].'9',substr($value['ProgramacionClase']['MODALIDAD'],0,2));
		$objPHPExcel->setActiveSheetIndex()->setCellValue($letras_abecedario[$numero_letra].'10','R');
		$objPHPExcel->setActiveSheetIndex()->setCellValue($letras_abecedario[$numero_letra].'11',date('d-m-y',strtotime($value['ProgramacionClase']['FECHA_CLASE'])));
		$objPHPExcel->setActiveSheetIndex()->setCellValue($letras_abecedario[$numero_letra].'12',!empty($value['ProgramacionClase']['FECHA_REGISTRO'])?date('d-m-y',strtotime($value['ProgramacionClase']['FECHA_REGISTRO'])):null);
		if ($value['ProgramacionClase']['DETALLE_ID']==4 || $value['ProgramacionClase']['WF_ESTADO_ID']==5) {
			$objPHPExcel->setActiveSheetIndex()->getStyle($letras_abecedario[$numero_letra].'13')->applyFromArray($style_back_orange);
			$objPHPExcel->setActiveSheetIndex()->setCellValue($letras_abecedario[$numero_letra].'13','Clase Suspendida');
		}elseif(strtotime(date('Y-m-d H:i')) > strtotime(date('Y-m-d H:i',strtotime($value['ProgramacionClase']['FECHA_CLASE'])))){
			if (is_null($value['ProgramacionClase']['WF_ESTADO_ID'])) {
				#GRIS
				$objPHPExcel->setActiveSheetIndex()->getStyle($letras_abecedario[$numero_letra].'13')->applyFromArray($style_back_gray);
				$objPHPExcel->setActiveSheetIndex()->setCellValue($letras_abecedario[$numero_letra].'13','Clase no Impartida');
			}else if($value['ProgramacionClase']['WF_ESTADO_ID'] > 1 && $value['ProgramacionClase']['WF_ESTADO_ID'] != 4){
				#AMARILLO
				$objPHPExcel->setActiveSheetIndex()->getStyle($letras_abecedario[$numero_letra].'13')->applyFromArray($style_back_yellow);
				$objPHPExcel->setActiveSheetIndex()->setCellValue($letras_abecedario[$numero_letra].'13','Clase no Registrada');
			}else{
				$objPHPExcel->setActiveSheetIndex()->getStyle($letras_abecedario[$numero_letra].'13')->applyFromArray($style_back_blue);
				$objPHPExcel->setActiveSheetIndex()->setCellValue($letras_abecedario[$numero_letra].'13','');
			}
		}else{
			$objPHPExcel->setActiveSheetIndex()->getStyle($letras_abecedario[$numero_letra].'13')->applyFromArray($style_back_blue);
			$objPHPExcel->setActiveSheetIndex()->setCellValue($letras_abecedario[$numero_letra].'13','');
		}
		$nro_fila_alumnos = 14;
		foreach ($alumnos as $alumno) {
			$asistencia = isset($alumno['Asistencia'][$value['ProgramacionClase']['COD_PROGRAMACION']])? $alumno['Asistencia'][$value['ProgramacionClase']['COD_PROGRAMACION']]:null;
			if (is_null($asistencia)) {
				$asistencia = '';
			}elseif($asistencia ==1){
				$asistencia = 'SI';
			}elseif($asistencia ==0){
				$asistencia = 'NO';
			}
			$objPHPExcel->setActiveSheetIndex()->setCellValue($letras_abecedario[$numero_letra].$nro_fila_alumnos,$asistencia);
			$objPHPExcel->setActiveSheetIndex()->getStyle($letras_abecedario[$numero_letra].$nro_fila_alumnos)->applyFromArray($cell_normal);
			$nro_fila_alumnos++;
		}
		if ($value['ProgramacionClase']['DETALLE_ID']==4 || $value['ProgramacionClase']['WF_ESTADO_ID']==5) {
			$objPHPExcel->setActiveSheetIndex()->getStyle($letras_abecedario[$numero_letra].'13:'.$letras_abecedario[$numero_letra].($nro_fila_alumnos-1))->applyFromArray($style_back_orange);
			$objPHPExcel->setActiveSheetIndex()->mergeCells($letras_abecedario[$numero_letra].'13:'.$letras_abecedario[$numero_letra].($nro_fila_alumnos-1));
		}elseif(strtotime(date('Y-m-d H:i')) > strtotime(date('Y-m-d H:i',strtotime($value['ProgramacionClase']['FECHA_CLASE'])))){
			if (is_null($value['ProgramacionClase']['WF_ESTADO_ID'])) {
				#GRIS
				$objPHPExcel->setActiveSheetIndex()->getStyle($letras_abecedario[$numero_letra].'13:'.$letras_abecedario[$numero_letra].($nro_fila_alumnos-1))->applyFromArray($style_back_gray);
				$objPHPExcel->setActiveSheetIndex()->mergeCells($letras_abecedario[$numero_letra].'13:'.$letras_abecedario[$numero_letra].($nro_fila_alumnos-1));
			}else if($value['ProgramacionClase']['WF_ESTADO_ID'] > 1 && $value['ProgramacionClase']['WF_ESTADO_ID'] != 4){
				#AMARILLO
				$objPHPExcel->setActiveSheetIndex()->getStyle($letras_abecedario[$numero_letra].'13:'.$letras_abecedario[$numero_letra].($nro_fila_alumnos-1))->applyFromArray($style_back_yellow);
				$objPHPExcel->setActiveSheetIndex()->mergeCells($letras_abecedario[$numero_letra].'13:'.$letras_abecedario[$numero_letra].($nro_fila_alumnos-1));
			}else{
				$objPHPExcel->setActiveSheetIndex()->getStyle($letras_abecedario[$numero_letra].'13')->applyFromArray($style_back_blue);
				$objPHPExcel->setActiveSheetIndex()->setCellValue($letras_abecedario[$numero_letra].'13','');
			}
		}else{
			$objPHPExcel->setActiveSheetIndex()->getStyle($letras_abecedario[$numero_letra].'13')->applyFromArray($style_back_blue);
			$objPHPExcel->setActiveSheetIndex()->setCellValue($letras_abecedario[$numero_letra].'13','');
		}
		$numero_letra++;
	}
	$objPHPExcel->setActiveSheetIndex()->getStyle("H8:".$letras_abecedario[($numero_letra-1)].'12')->applyFromArray($cell_normal);
    
	/*Escribir el excel*/
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment;filename="historico_asistencia_todo.xlsx"');
	header('Cache-Control: max-age=0');
	
	$objWriter->save('php://output');
	exit;
?>