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

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="../../img/logo.png">

  <title>X CORP - Patient</title>
</head>
<body class="bg-light">

  <nav class="navbar navbar-dark bg-dark">
    <a href="./home.php" class="navbar-brand">Doctor Panel</a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $root?>php/Auth/logout.php">Logout</a>
      </li>
    </ul>
  </nav>
  
  <div class=".container-fluid text-center">
    <div class="container">
      <div class="py-5 text-center">
        <h2>Logged-in as <?php echo $_SESSION['name'] ?></h2>
        <p class="lead">Select if you want to create a new patient card or a new exam for an existing patient.</p>        
      </div>

      <a href="./patient.php" class="btn btn-primary my-2">Create new patient card</a>
      <a href="./search.php" class="btn btn-secondary my-2">Find existing patient</a>
    </div>
  </div>

</body>
</html>
