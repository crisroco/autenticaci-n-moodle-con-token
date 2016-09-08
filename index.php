<!DOCTYPE html>
<html>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  <link rel=StyleSheet href="style.css" type="text/css" media=screen>
  <head></head>
  <title></title>

<body>
 <?php
    if (isset($_GET['status'])) {
     ?>
    <div class="alert alert-danger">
      <strong>Aviso!</strong> Credenciales incorrectas. Comunicarce con el administrador de la plataforma.
    </div>
    <?php   }?>

<div class="row row-centered">
  <div class="container col-md-3 col-centered bloque-center">
    <!--head form-->
    <section>
      <h1>Zegel</h1>
    </section>
    <!--end head form-->
    <!--body form-->

    <section class="col-md-12">
      <form class="form-horizontal" action="http://testaulavirtual.atypax.com/login/index.php" method ="post">
        <div class="form-group barra">
          <label for="inputEmail3" class="col-sm-4 control-label">DNI</label>
          <div class="col-sm-8">
            <input class="form-control"  type="text" placeholder="Username" name="username" required>
            <input class="form-control"  type="hidden" placeholder="zegel" name="password" value="zegel" required>
          </div>
        </div>

        <div class="form-group barra">
          <label for="inputPassword3" class="col-sm-4 control-label">Token</label>
          <div class="col-sm-8">
            <input class="form-control" id="inputPassword3" type="text" placeholder="Token" name="token" value="dhrpblhAKGikdcIMwYXJ" required>
          </div>
        </div>
        <div class="form-group barra">
          <div class="col-md-12">
            <button type="submit" class="btn  center-block">Ir a Moodle</button>
          </div>
        </div>
      </form>
    </section>
    <!--end body form-->
  </div>
</div>
  <div class="row row-centered ">
    <div class="col-md-2 col-centered bloque-center">
      <h1><img src="http://images.computrabajo.com.pe/logos/empresas/2016/01/14/atypax-742EF418ECFDCDA3thumbnail.jpeg"></h1>
    </div>
  </div>
  
  <div>
	<h3>Usuarios de prueba</h3>
	<lu>
		<li>Usuario: 72677735</li>
		<li>Usuario:  72677737</li>
	</lu>
  </div>

</body>
</html>
