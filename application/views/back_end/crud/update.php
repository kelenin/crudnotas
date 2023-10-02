
<?php
            			
	$user = $this->session->userdata('user');
	//print_r($user);
	extract($user);

	$idnotas = $editInfo->id;
	$descripnotas = $editInfo->description;
	$idestats =$editInfo->status;
	$id_departament =$editInfo->id_departament;
	$observation =$editInfo->observation;

	

	if(($id_department==$id_departament) && ($code_rol=='JF' || $code_rol=='RE'))
    {
              
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>CRUD - RECICLADOS</title>	
	<link href="assets/bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EDITAR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</script>
</head>

<body>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small>EDITAR CRUD</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                <div class="box box-primary">
                    <!-- form start -->
                    
                    <form role="form" action="<?php echo site_url('editNotas'); ?>" method="post" id="editNotas">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Descriptión&nbsp;<span class="error">*</span></label>
								<input type="text" class="form-control required" id="fname" placeholder="Enter Full Name" name="fname" value="<?php echo $descripnotas; ?>" maxlength="128">
								<input type="hidden" value="<?php echo $idnotas; ?>" name="notasId" id="notasId" />    
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="statusupd">estatus</label>
										<select name="statusupd" id="statusupd" class="form-control"  required >
										<option value="">Seleccione</option>
										<?php

												$sql_query = "SELECT id,name FROM `status` WHERE code in ('PC','TM') order by name";
												
												$result =$this-> db ->query($sql_query);

												foreach ($result->result() as $r):
													//print_r($id);
													$Id = $r->id;
													$Name = $r->name;

													if($idestats==$Id){
														$selected=" selected";
													}
													else{
														$selected="";
													}

													echo "<option value=".$Id." $selected>".$Name."</option>";

													endforeach;

										
										?>
									</select>

									</div>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="observ">Observatión</label>
                                        <input type="text" class="form-control" id="observ" placeholder="Observación" name="observ" value="<?php echo $observation; ?>" maxlength="20">
                                    </div>
                                </div>
                            </div>
							
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />&nbsp;&nbsp;
							<a href="<?php echo site_url('/home'); ?>">
								<input type="reset" class="btn btn-danger" id="regresar" value="Regresar">
							</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success_dos = $this->session->flashdata('success_dos');
                    if($success_dos)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success_dos'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>    
    </section>
</div>
</body>
</html>

<script src="<?php echo base_url(); ?>assets/js/editNotas.js" type="text/javascript"></script>

              
<?php

	}
	else{
		echo "Usted no tiene permisos para actualizar la nota, ya que no pertenece al departamento o al rol que esta 
		asociado a la nota.<br><br><br>";
		?>
		<div class="box-footer">
			<a href="<?php echo site_url('/'); ?>">
				<input type="submit" class="btn btn-danger" value="Regresar">
			</a>
		</div>
	<?php
	}
	
 ?>