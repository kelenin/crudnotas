
<?php
            			
	$user = $this->session->userdata('user');
	//print_r($user);
	extract($user);


	if($code_depart=='AC')
    { ?>

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
        <small> Registrar Crud</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
						<div class="row"> <div class="col-md-6"><h3 class="box-title"></h3></div>  
						
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addNewnotas" action="<?php echo site_url('crud/addNewnotas') ?>" method="post">
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="departamento">Departamemento&nbsp;<span class="error">*</span></label>
										<select name="departamento" id="departamento" class="form-control" value="<?php echo set_value('description'); ?>">
											<option value="">Selecciona</option>
											<?php
												$sql_query = "SELECT id,name FROM `department`  order by name";
					
												$result =$this-> db ->query($sql_query);

												foreach ($result->result() as $r):

													$Id = $r->id;
													$Name = $r->name;

													echo "<option value=".$Id.">".$Name."</option>";
												endforeach;

											?>
									</select>	

									</div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <input type="text" class="form-control" id="description" placeholder="Description" value="<?php echo set_value('description'); ?>" name="description" maxlength="300">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name_cliente">Nombre del Cliente</label>
                                        <input type="text" class="form-control" id="name_cliente" placeholder="Enter Phone Number" value="<?php echo set_value('name_cliente'); ?>" name="name_cliente" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company">Empresa</label>
										<input type="text" class="form-control" id="company" placeholder="Nombre de la Compañia" value="<?php echo set_value('company'); ?>" name="company" maxlength="100">
                                    </div>
                                </div>
                            </div>
							
							<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Telefono</label>
                                        <input type="phone" class="form-control" id="phone" placeholder="Teléfono" value="<?php echo set_value('phone'); ?>" name="phone" maxlength="100">
                                    </div>
                                </div>
                                
                            </div>
							
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />&nbsp;&nbsp;
                            <input type="reset" class="btn btn-link" value="Reset" />
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
                    $success_uno = $this->session->flashdata('success_uno');
                    if($success_uno)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success_uno'); ?>
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
<script src="<?php echo base_url(); ?>assets/js/addNotas.js" type="text/javascript"></script>
	
</body>
</html>
              
<?php

	}
	else{
		echo "Usted no tiene permiso para realizar la carga de las notas.<br><br><br>";
		?>
		<div class="box-footer">
			<a href="<?php echo site_url('/'); ?>">
				<input type="submit" class="btn btn-danger" value="Regresar">
			</a>
		</div>
	<?php
	}
	
 ?>