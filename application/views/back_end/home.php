<?php 

include_once 'includes/header.php';

include_once 'includes/nav.php';



?>

	<div class="content-wrapper">
		<section class="content">
			<div class="row">
				<div class="col-xs-12 text-center">
					<div class="form-group">
						<a class="btn btn-primary" href="<?php echo site_url('/addNotas'); ?>"><i class="fa fa-plus"></i>Agregar Notas</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Lista de Notas</h3>
						<!--<div class="box-tools">
							<form action="<?php echo base_url() ?>userListing" method="POST" id="searchList">
								<div class="input-group">
								<input type="text" name="searchText" value="<?php /*echo $searchText;*/ ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
								<div class="input-group-btn">
									<button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
								</div>
								</div>
							</form>
						</div>-->
					</div><!-- /.box-header -->
					<div class="box-body table-responsive">
					<table class="table table-hover" id="example1">
						<tr>
							<th scope="col">Código</th>
                            <th scope="col">Nombre del Empleado</th>
                            <th scope="col">Nombre del Cliente</th>
                            <th scope="col">Empresa del Cliente</th>
                            <th scope="col">Telefono del Cliente</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Descripción</th>
                            <th scope="col" colspan="2">Opciones</th>

						</tr>
						<?php
						//print_r($crud);
						if(!empty($crud))
						{ 
							$i=1;
							foreach($crud as $record)
							{
						?>
						<tr> 
						<td><?php if($record->observ!=""){ ?><i class="fa-solid fa-file-contract"></i>&nbsp; <?php echo $record->id; } else{ echo $record->id; } ?></td>
							<td><?php echo $record->nombre_usu; ?></td>
							<td><?php echo $record->name_cliente; ?></td>
							<td><?php echo $record->company; ?></td>
							<td><?php echo $record->phone; ?></td>
                            <td><?php 

                                if($record->deleted_date=="" || $record->reactiva_date!="")
                                {
                                    if($record->codestatus=='PD'){ echo '<span style="color:blue">'. $record->name_status.'</span>';}
                                    elseif($record->codestatus=='PC'){  echo '<span style="color:Orange">'. $record->name_status.'</span>';} 
                                    elseif($record->codestatus=='TM'){  echo '<span style="color:Green">'. $record->name_status.'</span>';}

                                }
                                else
                                {
                                    echo '<span style="color:red">ELIMINADO</span>';

                                }
                                ?>
                                </td>
                            <td><?php echo $record->description; ?></td>		
                            <?php
                                    if($record->deleted_date=="" || $record->reactiva_date!="")
                                    {
                                        if($record->codestatus=='PD' || $record->codestatus=='PC' || $record->codestatus=='TM')
                                        { ?>
                                        <td><a href="<?= site_url('/modifyNotas/'.$record->id); ?>" class="btn btn-primary">Edit</a></td>
                                        <td><a href="<?= site_url('/deleteNotas/'.$record->id); ?>" onclick="return confirm('Estás seguro que deseas eliminar el registro?');" 
                                             class="btn btn-danger deleteNotas">Delete</a><?php }
                                        else {  echo '<span style="color:red">'.$record->name_status.'</span>'; } ?></td>
                                    <?php
                                    }
                                    else
                                    { ?>
                                        <td colspan="2" style="background-color:red"><a href="<?= site_url('/activarNotas/'.$record->id); ?>" class="btn btn-danger"
                                        onclick="return confirm('Estás seguro que deseas activar nuevamente la nota?');">Activar</a></td>
                                    <?php
                                    }  ?>					

						</tr>
						<?php
							$i++; }
						}
						?>
					</table>
					
					</div><!-- /.box-body -->
					
				</div><!-- /.box -->
				</div>
			</div>
		</section>
	</div>

</div>
</div>


<?php 

//include_once 'includes/footer.php';




?>

