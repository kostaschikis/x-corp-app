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

  $doctor = $_SESSION['email'];

  // Get Current Doctor's Actinology Requests
  $actRequests = getDoctorActinologyRequests($doctor);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>X CORP - Home</title>
  </head>
  <body class="bg-light">

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand">Doctor Panel</a>
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
        <a class="btn btn-primary" href="./select-action.php" role="button">New Exam</a>
      </div>

      <ul class="list-group mb-3">
        <?php 
          foreach ($actRequests as $req) {
            $id = $req["id"];
            $priority = $req["priority"];
            $approval = $req["approval"];

            $approval = ($approval == 0) ? 'Pending' : 'Completed';

            echo "
              <li class='list-group-item d-flex justify-content-between lh-condensed'>
                <div>
                  <h6 class='my-0'>Application Id: $id</h6>
                  <span class='badge badge-pill badge-success'>$approval</span>
                </div>
                <span class='text-muted'>$priority Priority</span>
              </li>
            ";
          }
        ?>
      </ul>
    </main>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  </body>
</html>