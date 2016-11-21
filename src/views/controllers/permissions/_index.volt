{% extends "layouts/main.volt" %}


{% block content %}


	<div class="base-page lighter">

		<div class="formulario-section">
			
		    <aside>
		        <h1 class="blog">Administrador de permisos</h1>
		    </aside>

		    <a  href="javascript:void(0)"  
		        id='guardar'
		        class="btn btn-success pull-right btn-save">Guardar</a>

			
			<form action="<?php echo $this->url->get('permisos'); ?>" method='GET' id='frm'></form>

				<div class="row">

					<div class="col-md-3 col-md-offset-1">

						<div class="form-group">
							<label for="rol">Rol</label>
							<select name="rol" id="rol" class='form-control slc_rol'>
								<option value="">Seleccione</option>
								<?php
			        				foreach ($roles as $rol) {
			        					echo "<option value='".$rol->id."'>".$rol->name."</option>";
			        				}
			        			?>
							</select>
						</div>

					</div>


				</div>

				<br><br>
					
				<div class="row">
					<div class="col-md-2 col-md-offset-1">

						<dl class="dl-horizontal">

							<?php
								
								foreach ($permisos as $controller => $metodo) {
									echo "<dt>
											<a 	class='tabp'
												data-panel='tab{$controller}'
												href='#'>{$controller}
											</a>
										</dt>";
								}

							?>
						</dl>
					</div>

					<div class="col-md-8">
						<?php

							foreach ($permisos as $controller => $metodos) {
								# code...	

							
								echo "	<div class='collapse' id='tab{$controller}'>
											<div class='well'>

												<div class='checkbox'>
													<label>
														<input type='checkbox' class='slc_all' data-class='".strtolower($controller)."' value='0' ><strong>Seleccionar/Deseleccionar todas</strong>
													</label>
												</div>


											";

								foreach ($metodos as $metodo){
									echo "	<div class='checkbox'>
												<label>
													<input type='checkbox' class='ck_permisos ".strtolower($controller)."' value='".strtolower($controller)."/".strtolower($metodo)."'> {$metodo}
												</label>
											</div>";
								}


								echo "</div></div>";

							}
						?>
					</div>
				</div>
					
			
		</div>
	</div>



{% endblock %}