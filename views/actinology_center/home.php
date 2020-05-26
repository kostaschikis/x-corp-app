<?php 
  session_start(); 
  $root = '../../';
  $altroot = '../..';

  // Includes
  include $root.'php/functions.php';
  include $root.'php/app/HomeViewRequests.php';

  // Protect The Route
  if (!is_user_logged_in()) {
    header("Location:" . $root);  
    exit();
  }
  // Get All Actinology Requests
  $actRequests = getAllActinologyRequests();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/center.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../../img/logo.png">
    
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

    <?php 
      if (isset($_GET['appStored']) && $_GET['appStored'] == 'success') {  
        echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Appointment Set Successfully</strong>.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>';
      } else if (isset($_GET['deleteReq']) && $_GET['deleteReq'] == 'success') {
        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Appointment Deleted Successfully</strong>.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>';
      }
    ?>    

    <main role="main" class="container">
      <div class="py-5 text-center">
        <h2>Logged-in as <?php echo $_SESSION['name'] ?></h2>
        <p class="lead">Track exams and create new appointments</p>
        <a class="btn btn-primary" href="./calendar.php" role="button">Calendar View</a>
      </div>


      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Patient</th>
            <th scope="col">Received</th>
            <th scope="col">Priority</th>
            <th scope="col">Status</th>
            <th scope="col">Exam</th>
            <!-- <th scope="col">Exam Progress</th> -->
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
        <?php 
          foreach ($actRequests as $key=>$value) {
            $id = $value["id"];
            $date = $value["date_sent"];
            $approval = $value["approval"];
            $priority = $value["priority"];
            $completed = $value["completed"];
            $patient = $value['patient_info'];
            
            $badgeValue = ($priority == 'high') ? 'danger' : 'success'; 
            $completion = ($completed == 0) ? 'Waiting' : 'Completed';
            $textValue = ($completed == 0) ? 'danger' : 'success';

            // Formating
            $approval = ($approval == 0) ? 'Pending' : 'Set';
            ucfirst($priority);
            $date = formatDate($date);

            $key++;

            echo "
                  <tr>
                    <th scope='row'>$key</th>
                    <td>$id</td>
                    <td>$patient</td>
                    <td>$date</td>
                    <td><span class='badge badge-pill badge-$badgeValue'>$priority</span></td>
                    <td>$approval</td>
                    <td>$completion</td>";
                    if ($approval == 'Pending') {
                      echo "<td>
                              <button id='deleteExam'> 
                                <a href='create_appointment.php?examId=$id' class='text-primary'>Create appointment</a>
                              </button>  
                            </td>";
                    } else if ($completed == 1) {
                      echo "<td>
                              <form action='$altroot/php/app/DeleteExam.php' method='post'>
                                <button id='deleteExam'>
                                  <a class='text-danger'>Delete appointment</a>
                                </button>
                                <input type='hidden' name='reqId' value='$id'>
                              </form>
                            </td>";
                    } else {
                      echo "<td>-</td>";
                    }
            echo  "</tr>";
          }
        ?> 
        </tbody>
      </table>
    </main>
 
    <!-- Sheduler -->
    <div id="scheduler_here" class="dhx_cal_container">
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../../js/calendar.js"></script>
  </body>
</html>
