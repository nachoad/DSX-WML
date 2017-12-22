<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "$WML_SERVICE_CREDENTIALS_URL/v3/identity/token");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_USERPWD, "$WML_SERVICE_CREDENTIALS_USERNAME:$WML_SERVICE_CREDENTIALS_PASSWORD");

$result = curl_exec($ch);
if (curl_errno($ch)) {
  echo 'Error: ' . curl_error($ch);
}
curl_close ($ch);

//print "<p>El JSON entero es: \n\n $result</p>";

$json = json_decode($result, true);
$vtoken = $json['token'];

?>



<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Data Science Experience + Watson Machine Learning">
  <meta name="author" content="Ignacio Alonso Delgado">

  <title>Predicción del precio de Casas en Madrid</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">

</head>

<body>

  <header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color:#1f3749">
      <a class="navbar-brand" href="http://ialonso.es/wml/">DSX+WML</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="http://datascience.ibm.com">Data Science Experience<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.ibm.com/cloud/machine-learning">Watson Machine Learning</a>
          </li>
        </ul>
        <form class="form-inline mt-2 mt-md-0">
          <a href="http://twitter.com/nachoad" class="btn btn-outline-info my-2 my-sm-0">@nachoad</a>
        </form>
      </div>
    </nav>
  </header>

  <!-- Begin page content -->
  <main role="main" class="container">
    <div class="mt-3">
      <h1>Predicción del precio de las casas en Madrid</h1>
    </div>
    <p class="lead">La presente página web contiene un ejemplo de integración de Data Science Experience (DSX) y Watson Machine Learning (WML).</p>
    <p class="lead">Se ha hecho un estudio con DSX sobre precio de las casas en Madrid. A partir de dicho estudio, se han hecho modelos predictivos que se han desplegado en WML. A su vez, WML expone un servicio Web al que esta página ataca vía <code>API REST</code>.
      <div>
        <img src="img/metropolis.jpg" class="img-fluid rounded">
      </div>
    </br>

    <h2>Parámetros de entrada</h2>
    <p>En el siguiente formulario se piden varios parámetros de entrada al modelo predictivo. Cuando haya introducido todos los parámetros, por favor, haga clic en el botón "Calcular predicción de precio".


      <div class="card">
        <div class="card-header">
          Características de la vivienda
        </div>
        <div class="card-body">

          <form action="result.php" method="POST"> <!--empieza form -->


            <div class="row">
              <div class="col-lg-6">
                <label for="m2">Indique los m2 de la casa</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="m2" id="m2" placeholder="100" aria-describedby="m2" required>
                  <span class="input-group-addon" id="m2" >m2</span>
                </div>
              </div>
              <div class="col-lg-6">
                <label for="distrito">Indique el distrito</label>
                <select class="form-control" name="distrito" id="distrito" required>
                  <option value="671">Arganzuela</option>
                  <option value="668">Barajas</option>
                  <option value="176">Chamartín</option>
                  <option value="177">Chamberí</option>
                  <option value="685">Ciudad Lineal</option>
                  <option value="676">San Blas</option>
                  <option value="669">Moncloa</option>
                </select>
              </div>
            </div>

          </br>
          <label for="habitaciones">Indique el número de habitaciones: </label>
          <div class="form-check form-check-inline" >
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="habitaciones" id="inlineRadio1" value="1" required > 1
            </label>
          </div>
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="habitaciones" id="inlineRadio2" value="2" required >2
            </label>
          </div>
          <div class="form-check form-check-inline">
            <label class="form-check-label">
              <input class="form-check-input" type="radio" name="habitaciones" id="inlineRadio3" value="3" required >3
            </label>
          </div>
          <div class="form-check form-check-inline">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="habitaciones" id="inlineRadio4" value="4" required>4
              </label>
          </div>
          <div class="form-check form-check-inline">
              <label class="form-check-label">
                <input class="form-check-input" type="radio" name="habitaciones" id="inlineRadio5" value="5" required>5
              </label>
          </div>


          <div class="row">
            <div class="col-lg-6">
              <label for="dmetro">Distancia al Metro (Km)</label>
              <div class="input-group">
                <input type="text" class="form-control" name="dmetro" id="dmetro" placeholder="0.2345" aria-describedby="mkm" required>
                <span class="input-group-addon" id="mkm">Km</span>
              </div>
            </div>
            <div class="col-lg-6">
              <label for="dscentro">Distancia al centro (Km)</label>
              <div class="input-group">
                <input type="text" class="form-control" name="dcentro" id="dcentro" placeholder="1.6952" aria-describedby="ckm" required>
                <span class="input-group-addon" id="ckm">Km</span>
              </div>
            </div>
          </div>

        </br>

        <button type="submit" class="btn btn-primary">Calcular predicción de precio</button>

        <input type="hidden" name="token" value="<?php echo $vtoken ?>">

      </form> <!-- acaba form -->


    </div> <!--acaba <div class="card-body"> -->
    </div> <!--acaba <div class="card"> -->


    </br>
  </main>

  <footer class="footer">
    <div class="container">
      <span class="text-muted">Ignacio Alonso Delgado</span>
    </div>
  </footer>



  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

</body>
</html>
