<div id="back"></div>

<div class="login-box">
  
  <div class="login-logo">

    <img src="vistas/img/plantilla/logo.png" class="img-responsive">

  </div>

  <div class="login-box-body">

    <!-- <p class="login-box-msg">Ingresar al sistema</p> -->
    <h2 class="text-center">Ingresar al sistema</h2>
    <p class="text-muted text-center">Control de acceso al sistema</p>

    <form method="post">

      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      
      </div>

      <div class="row">
       
        <div class="col-xs-4">

          <button type="submit" class="btn btn-success btn-block btn-flat">Ingresar</button>
        
        </div>

      </div> 

      <?php

        $login = new ControladorUsuarios();
        $login -> ctrIngresoUsuario();
        
      ?>

    </form>

  </div>
  <p class="text-success text-right">Desarrollado por Creaando Studio</p>
  <p class="text-right" style="color:dimgray">V.2.02.1 - 20126</p>


</div>
