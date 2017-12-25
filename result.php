<?php

$token = $_POST['token'];
$dcentro = $_POST['dcentro'];
$dmetro = $_POST['dmetro'];
$habitaciones = $_POST['habitaciones'];
$distrito = $_POST['distrito'];
$m2 = $_POST['m2'];


$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "$WML_SCORING_ENDPOINT");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"fields\": [\"district_id\", \"rooms\", \"mts2\", \"distance_to_metro\", \"distance_to_centre\"],\"values\": [[$distrito,$habitaciones,$m2,$dmetro,$dcentro]]}");
curl_setopt($ch, CURLOPT_POST, 1);

//$distrito,$habitaciones,$m2,$dmetro,$dcentro
//671,4,120,1.234,0.123

$headers = array();
$headers[] = "Content-Type: application/json";
$headers[] = "Accept: application/json";
$headers[] = "Authorization: Bearer $token";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);

$json = json_decode($result, true);
$prediction =floatval($json['values'][0][6]);
$precio = number_format($prediction,2,',','.');

?>



<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
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
      <a class="navbar-brand" href="http://ialonso.es/projects/dsxwml/">DSX+WML</a>
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
      <h3>Según el modelo, el precio de la casa será de:</h3>
      <div class="text-center" >
        <h1 class="display-1"><span style="font-weight:bold"><?php echo $precio ?></span><small class="text-muted"><sup>€</sup></small></h1>
      </div>
    </div>

    <a href="http://ialonso.es/prejects/dsxwml" class="btn btn-outline-success my-2 my-sm-0">Volver</a>

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
