<div id="ver_curso" class="tab-pane" role="tabpanel">
					<br><br>
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th class="td-app">Nº</th>
									<th class="td-app">Rut Alumno</th>
									<th class="td-app">Apellido Paterno</th>
									<th class="td-app">Apellido Materno</th>
									<th class="td-app">Nombres</th>
									<th align="center"class="td-app">Clases Presente</th>
									<th align="center"class="td-app">Clases Ausente</th>
									<th align="center"class="td-app">ClasesRegistradas</th>
									<th align="center"class="td-app">Clases Programadas</th>
									<th align="center"class="td-app">Asistencia Actual</th>
									<th align="center"class="td-app">Asistencia</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($alumnos as $key => $value): ?>
									<tr>
										<td><?php echo $key +1;?></td>
										<td><?php echo strtoupper($value['rut']); ?></td>
										<td><?php echo strtoupper($value['paterno']); ?></td>
										<td><?php echo strtoupper($value['materno']); ?></td>
										<td>
											<?php if ($key == 0): ?>
												<a style="cursor: pointer; "class="alumno_active"><?php echo strtoupper($value['nombre']); ?></a>
											<?php else: ?>	
												<?php echo strtoupper($value['nombre']); ?>
											<?php endif ?>
										</td>
										<td align="center" ><?php echo $value['clases_registradas']; ?></td>
										<td align="center"><?php echo $value['clases_presentes']; ?></td>
										<td align="center"><?php echo '10'; ?></td>
										<td align="center"><span class="badge" style="background:#34495e !important;"><?php echo '40'; ?></span></td>
										<td align="center" style="color:red;"><?php echo $key == 0 || $key == 3 || $key == 7 ? '75' : '95'; ?>%</td>
										<td align="center" style="color:red;">100%</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>