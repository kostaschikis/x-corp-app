<?php 
  session_start(); 
  $root = '../../';

  // Protect The Route
  if (!is_user_logged_in()) {
    header("Location:" . $root);  
    exit();
  }
  
  function is_user_logged_in() {
    return isset($_SESSION['name']) || isset($_COOKIE['user']);
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

    <title>X CORP - Radiology Center</title>
  </head>
  <body class="bg-light">

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand">Radiology Center</a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $root ?>php/Auth/logout.php">Logout</a>
        </li>
      </ul>
    </nav>

    <main role="main" class="container">
      <div class="py-5 text-center">
        <h2>Logged-in as <?php echo $_SESSION['name'] ?></h2>
        <p class="lead">Edw mporeite na dhmiourgisete ena rantevou gia thn eksetasi enos astheni</p>
      </div>


      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Received</th>
            <th scope="col">Priority</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>d14a028c2a3a2bc9476102bb288234c415a2b01f828ea62ac5b3e42f</td>
            <td>25/3/2020 10:34</td>
            <td><span class="badge badge-pill badge-danger">High</span></td>
            <td>Seted</td>
            <td><a href="create_appointment.html">Create appointment</a></td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>d14a028c2a3a2bc9476102bb288234c415a2b01f828ea62ac5b3e42f</td>
            <td>25/3/2020 10:34</td>
            <td><span class="badge badge-pill badge-success">Low</span></td>
            <td>Pending</td>
            <td><a href="create_appointment.html">Create appointment</a></td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>d14a028c2a3a2bc9476102bb288234c415a2b01f828ea62ac5b3e42f</td>
            <td>25/3/2020 10:34</td>
            <td><span class="badge badge-pill badge-danger">High</span></td>
            <td>Seted</td>
            <td><a href="create_appointment.html">Create appointment</a></td>
          </tr>
        </tbody>
      </table>
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script src="offcanvas.js"></script>
  </body>
</html>