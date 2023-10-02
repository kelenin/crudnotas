<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-center">

			
            <h2><strong>Sistema de Reciclados 3R </strong> </h2>
        </div>

        <div class="pull-center">

            <a class="btn btn-success" href="<?php echo base_url('crud/create') ?>"> Ingresar Notas</a>

        </div>

    </div>

</div>

<!--<div class="container">-->
	<div class="row">	

		<div class="col-lg-12 text-center">
		  <div>
		    <h1>Leer Notas</h1> </br>          	
		  </div>
		</div>

		<table class="table-reponsive" id="notas-list"> 
		<thead> 
			<tr> 
				<th>#</th> 
                <th>Nombre del Empleado</th>
                <th>Nombre del Cliente</th>
                <th>Empresa del Cliente</th>
                <th>Telefono del Cliente</th>
                <th>Estado</th>
                <th>Descripción</th>
                <th colspan="4">Opciones</th>
			</tr> 
		</thead> 
        <tbody> 
	        <?php 
            foreach($data as $row){
				print_r($row);
            ?>
            	<tr> 
            		<th scope="row"><?php echo $row->id; ?></th> 
            		<td><?php echo $row->nombre_usu; ?></td> 
            		<td><?php echo $row->name_cliente; ?></td> 
            		<td><?php echo $row->company; ?></td> 
            		<td><?php echo $row->phone; ?></td> 
					<td><?php 

						if($row->deleted_date=="" || $row->reactiva_date!="")
						{
							if($row->codestatus=='PD'){ echo '<span style="color:blue">'. $row->name_status.'</span>';}
							elseif($row->codestatus=='PC'){  echo '<span style="color:Orange">'. $row->name_status.'</span>';} 
							elseif($row->codestatus=='TM'){  echo '<span style="color:Green">'. $row->name_status.'</span>';}

						}
						else
						{
							echo '<span style="color:red">ELIMINADO</span>';

						}
						?></td>
					<td><?php echo $row->description; ?> </td>
					<td><?php
						if($row->deleted_date=="" || $row->reactiva_date!="")
						{
							if($row->codestatus=='PD' || $row->codestatus=='PC' || $row->codestatus=='TM')
							{ ?>
							<td><a  class="btn btn-warning" href="<?= base_url('crud/update/' . $row->id) ?>">Editar</a></td>
							<td><a  class="btn btn-danger" href="delete/<?php echo $row->id; ?>" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" >Eliminar</a>
							<?php
						}
						else {  echo '<span style="color:red">'. $row->name_status.'</span>'; } ?></td>
						<?php
						}
						else
						{ ?>
							<td colspan="2" style="background-color:red"> 
								<a  class="btn btn-danger" onclick="javascript:return confirm('¿Seguro de activar este registro?');" href="?c=notas&a=Eliminar&id=<?php echo $r->id; ?>">Activar</a>
						</td>
						<?php
						}
					?> </td>
            		<!--<td>
            			<a href="update/<?php echo $row->id; ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
            			<a href="delete/<?php echo $row->id; ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
            		</td>-->
            	</tr> 
            <?php } ?>
        </tbody>
		</table>
	<!--</div>-->

	<!--<a class="btn btn-success" href="<?= base_url('crud/create'); ?>" role="button">Regresar</a>-->
	<!--<a class="btn btn-success col-md-2 col-md-offset-10" href="<?= base_url('crud/create'); ?>" role="button">Regresar</a>-->
	
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
      $('#notas-list').DataTable();
  } );
</script>