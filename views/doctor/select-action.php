<?php 
  session_start();
  $root = '../../';
  
  // Includes
  include $root.'php/functions.php';

  // Protect The Route
  if (!is_user_logged_in()) {
    header("Location:" . $root);  
    exit();
  }
?>
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>X CORP - Patient</title>
</head>
<body class="bg-light">

  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand">typos idrimetos (kliniki/nosokomio....)</a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $root?>php/Auth/logout.php">Logout</a>
      </li>
    </ul>
  </nav>
  
  <div class="py-5 text-center">
     
    <h2>Exam Details</h2>
  </div>
  <section class="jumbotron text-center">
    <div class="container">      
        <a href="./patient.php" class="btn btn-primary my-2">Create new patient</a>
        <a href="./search.php" class="btn btn-secondary my-2">Find existing patient</a>
      </p>
    </div>
  </section>
</body>
</html>
