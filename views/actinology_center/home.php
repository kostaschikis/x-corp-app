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
        if ( isset($_GET['appStored']) && $_GET['appStored'] == 'success') {  
          echo '
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Appointment Set Successfully</strong>.
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
      </div>


      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">ID</th>
            <th scope="col">Received</th>
            <th scope="col">Priority</th>
            <th scope="col">Status</th>
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

            $badgeValue = ($priority == 'high') ? 'danger' : 'success'; 

            // Formatiing
            $approval = ($approval == 0) ? 'Pending' : 'Set';
            ucfirst($priority);
            $date = formatDate($date);

            $key++;

            echo "
                  <tr>
                    <th scope='row'>$key</th>
                    <td>$id</td>
                    <td>$date</td>
                    <td><span class='badge badge-pill badge-$badgeValue'>$priority</span></td>
                    <td>$approval</td>";
                    if ($approval == 'Pending') {
                      echo "<td><a href='create_appointment.php?examId=$id'>Create appointment</a></td>";
                    }
            echo  "</tr>";
          }
        ?> 
        </tbody>
      </table>
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
