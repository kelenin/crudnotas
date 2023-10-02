<div class="container">

  <div class="row">


    <nav class="navbar navbar-expand-md navbar-black bg-light fixed-top">
          <a class="navbar-brand text-reset fw-bold" href="#">SISTEMA CRUD</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="navbar-collapse collapse">
          
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php echo base_url(); ?>index.php/login/logout" class="btn btn-danger">Logout</a></li>
            </ul>
        </div>

      </nav>


      <?php
				$user = $this->session->userdata('user');
				extract($user);
			?>
			<p><h2>Bienvenido (a): <?php echo $name; ?> </h2></p>
