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
  <link rel="stylesheet" href="<?php echo $root?>css/style.css">

  <title>X CORP - Patient</title>
</head>
<body class="bg-light">

  <nav class="navbar navbar-dark bg-dark">
    <a href="home.php" class="navbar-brand">Doctor Panel</a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $root?>php/Auth/logout.php">Logout</a>
      </li>
    </ul>
  </nav>


  <div class=".container-fluid text-center">
    <div class="container">
      <div class="py-5 text-center">
     
        <h2>Exam Details</h2>
        <p class="lead">Search for an existing patient.</p>           
      </div>

      <form autocomplete="off" action="./exam.php" action="GET">
            <div class="form-group autocomplete w-100">
              <label for="exampleInputEmail1">Search patient</label>
              <input type="text" class="form-control" id="myInput" name="patient" placeholder="Patient's name">
            </div>  
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
  </div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script src="<?php echo $root?>js/fetchPatients.js"></script>
</body>
</html>
