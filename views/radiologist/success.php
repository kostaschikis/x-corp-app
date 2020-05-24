<?php 
  $root = '../../';
?>
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="../../img/logo.png">

  <title>Radiologist Pannel</title>
</head>
<body class="bg-light">

  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="home.php">Radiologist Pannel</a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $root.'php/Auth/logout.php'?>">Logout</a>
      </li>
    </ul>
  </nav>
  <main role="main" class="container">
    <div class="card text-center" style="width: 50%; margin: 0 auto; margin-top: 20%;">
      <div class="card-body">
        <h5 class="card-title">Success</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="home.php" class="btn btn-primary">Go home</a>
      </div>
    </div>
  </main>

  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
</body>
</html>
