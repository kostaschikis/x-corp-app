<?php 
  session_start(); 
  $root = '../../';

  // Includes
  include $root.'php/functions.php';
  include $root.'php/app/HomeViewRequests.php';
  
  // Protect The Route
  if (!is_user_logged_in()) {
    header("Location:" . $root);  
    exit();
  }

  $radiologist = $_SESSION['email'];

  $appointments = getRadiologistAppointments($radiologist);
  // print_r($appointments);

?>
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>Radiologist Pannel</title>
</head>
<body class="bg-light">

  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="./">Radiologist Pannel</a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $root?>php/Auth/logout.php">Logout</a>
      </li>
    </ul>
  </nav>
  <main role="main" class="container">
    <div class="py-5 text-center">
      <h2>Logged-in as <?php echo $_SESSION['name'] ?></h2>
      <p class="lead">Edw mporeite na deite tis eksetaseis pou exete na kanete</p>
    </div>
    <!-- Exams | To-Do -->
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">ID</th>
          <th scope="col">Exam date</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $altRoot = '../..';

        foreach ($appointments as $key=>$appointment) {
          $appId = $appointment['id'];
          $date = $appointment['exam_date'];
          $ssn = $appointment['patient_ssn'];
          $reqId = $appointment['request_id'];
          $completion = $appointment['completed'];

          // Formating
          $date = formatDate($date);

          $key++;

          echo "
            <tr>
              <th scope='row'>$key</th>
              <td>$appId</td>
              <td>$date</td>";
              if ($completion == 1) {
                echo "<td><a class='text-danger' href='$altRoot/php/app/DeleteExam.php?appId=$appId&radioEmail=$radiologist'>Delete Appointment</a></td>";
              } else {
                echo "<td><a href='details.php?appId=$appId&ssn=$ssn&reqId=$reqId'>See Details</a></td>";
              }
          echo "</tr>";    
        }
      ?>  
      </tbody>
    </table>
  </main>

  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
</body>
</html>
