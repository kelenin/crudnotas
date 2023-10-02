
<?php 
include_once '../includes/header.php'; 
include_once '../includes/nav.php'; 

?>


	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		<h1>
			<small> <?php
				$user = $this->session->userdata('user');
				extract($user);
			?>
			<p><h2>Bienvenido (a): <?php echo $name; ?> </h2></p></small>
		</h1>
		</section>
		<section class="content">
			<div class="row">
				<div class="col-xs-12 text-right">
					<div class="form-group">
						<a class="btn btn-primary" href="<?php echo base_url(); ?>addNew"><i class="fa fa-plus"></i> Add New</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Lista de Notas</h3>
						<div class="box-tools">
							<form action="<?php echo base_url() ?>userListing" method="POST" id="searchList">
								<div class="input-group">
								<input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
								<div class="input-group-btn">
									<button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
								</div>
								</div>
							</form>
						</div>
					</div><!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
					<table class="table table-hover">
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
						if(!empty($data))
						{ $i=1;
							foreach($data as $record)
							{
						?>
						<tr> 
                            <td><?php if($record->$observ!=""){ ?><i class="fa-solid fa-file-contract"></i>&nbsp; <?php echo $record->$id; } else{ echo $record->$id; } ?></td>
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
                                        <td><a href="update.php?id=<?php echo $record->$id; ?>" class="btn btn-primary">Edit</a></td>
                                        <td><a href="delete.php?id=<?php echo $record->$id; ?>" onclick="return confirm('Estás seguro que deseas eliminar el registro?');" 
                                             class="btn btn-danger">Delete</a><?php }
                                        else {  echo '<span style="color:red">'.$record->name_status.'</span>'; } ?></td>
                                    <?php
                                    }
                                    else
                                    { ?>
                                        <td colspan="2" style="background-color:red"><a href="reactivar.php?id=<?php echo $record->$id; ?>" class="btn btn-danger"
                                        onclick="return confirm('Estás seguro que deseas activar nuevamente la nota?');">Activar</a></td>
                                    <?php
                                    }  ?>					
                            <!--<td class="text-center">
								<a class="btn btn-sm btn-primary" href="<?= base_url().'login-history/'.$record->userId; ?>" title="Login history"><i class="fa fa-history"></i></a>&nbsp;  
								<a class="btn btn-sm btn-info" href="<?php echo base_url().'modifyUser/'.$record->userId; ?>" title="Edit"><i class="fa fa-pencil"></i></a>&nbsp;
								<a class="btn btn-sm btn-danger deleteUser" href="#" data-userid="<?php echo $record->userId; ?>" title="Delete"><i class="fa fa-trash"></i></a>
							</td>-->
						</tr>
						<?php
							$i++; }
						}
						?>
					</table>
					
					</div><!-- /.box-body -->
					<div class="box-footer clearfix">
						<?php echo $this->pagination->create_links(); ?>
					</div>
				</div><!-- /.box -->
				</div>
			</div>
		</section>
	</div>

</div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "userListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>

