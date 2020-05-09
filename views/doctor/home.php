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
  // print_r($actRequests);
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

    <?php 
        if ( isset($_GET['actStored']) && $_GET['actStored'] == 'success') {
          echo '
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Exam Sent Successfully</strong>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        } 
    ?>

    <main role="main" class="container">
      <div class="py-5 text-center">
        <h2>Logged-in as <?php echo $_SESSION['name'] ?></h2>
        <p class="lead">Edw mporeite na dhmiourgisete ena rantevou gia thn eksetasi enos astheni</p>
        <a class="btn btn-primary" href="./select-action.php" role="button">New Exam</a>
      </div>



      <table class="table">
        <thead>
          <tr>            
            <th scope="col">Exam ID</th>
            <th scope="col">Appointment Status</th>
            <th scope="col">Exam Status</th>
            <th scope="col">Priority</th>
            <th scope="col">Date Sent</th>            
          </tr>
        </thead>
        <tbody>
        <?php 
          foreach ($actRequests as $req) {
            $id = $req["id"];
            $date = $req["date_sent"];
            $approval = $req["approval"];
            $priority = $req["priority"];

            // Formating
            $approval = ($approval == 0) ? 'Pending' : 'Set';
            $badgeValue = ($priority == 'high') ? 'danger' : 'success'; 
            $completion = ($req['completed'] == 0) ? 'Waiting' : 'Completed';
            $badgeValue1 = ($approval == 'Pending') ? 'danger' : 'success'; 
            $badgeValue2 = ($completion == 'Waiting') ? 'danger' : 'success'; 
            $date = formatDate($date);           

            echo "
                  <tr>                   
                    <td>$id</td>
                    <td><span class='badge badge-pill badge-$badgeValue1'>$approval</span></td>
                    <td><span class='badge badge-pill badge-$badgeValue2'>$completion</span></td>
                    <td><span class='badge badge-pill badge-$badgeValue'>$priority</span></td>
                    <td>$date</td>
                    ";
                    
            echo  "</tr>";
          }
        ?> 
        </tbody>
      </table>
    </main>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <!-- CDN Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
