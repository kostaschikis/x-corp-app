<?php 
  session_start(); 
  $root = '../../';

  // Includes
  include $root.'php/functions.php';
  include $root.'php/app/HomeViewRequests.php';
  include $root.'php/app/FetchRadiologists.php';

  // Protect The Route
  if (!is_user_logged_in()) {
    header("Location:" . $root);  
    exit();
  }
  
  $radiologists = array();

  // Get Actinology Request Details
  $examId = $_GET['examId'];
  $actinoRequest = getActinologyRequestsById($examId);

  // Format Suggested Date
  $suggestedDate = new DateTime($actinoRequest['suggested_date']);
  $suggestedDate = $suggestedDate->format('d/m/Y');

  // Fetch Available Radiologist
  $radiologists = getAvailableRadiologists();

  print_r($actinoRequest);

?>
<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>X CORP - Appointment</title>
</head>
<body class="bg-light">

  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand">typos idrimetos (kliniki/nosokomio....)</a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Logout</a>
      </li>
    </ul>
  </nav>

  <div class="container">
    <div class="py-5 text-center">
      <h2>New appointment</h2>
      <p class="lead">Here you can create an appointment</p>
    </div>
    <!-- Patient's Info -->
    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">
        <div class="card" style="width: 18rem;">
          <div class="card-body">
            <h5 class="card-title"><?php echo $actinoRequest['patient_info'] ?></h5>
            <p class="card-text"><?php echo $examId ?></p>
            <p class="card-text"> Suggested Date: <?php echo $suggestedDate ?></p>
          </div>
        </div>
      </div>
      <!-- Make an Application -->
      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">New Application</h4>
        <form class="needs-validation" novalidate>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="appId">Appointment ID</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <button type="button" class="input-group-text" onclick="randomId()">#</button>
                </div>
                <input type="text" class="form-control" name="appointmentId" id="appId" placeholder="Press to generate an Appointment ID" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Application ID is required.
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="Date">Exam Date</label>
              <input type="date" class="form-control" name="examDate" id="examdate">
              <div class="invalid-feedback">
                Exam date is required.
              </div>
            </div>
          </div>

          <!-- Available Actinologists -->
          <div class="form-group">
            <label for="doctor">Available Actinologists</label>
            <select class="form-control" name="availableDoctor" id="doctor">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>

          <div class="form-group">
            <label for="comment">Comments</label>
            <textarea class="form-control" rows="5" name="comments" id="comment"></textarea>
          </div>

          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" type="submit">Send</button>
        </form><br>
      </div>

      <script>
        function randomId() {
          var length = 10;
          var result = '';
          var characters = '0123456789';
          var charactersLength = characters.length;
    
          for (var i = 0; i < length; i++) {
           result += characters.charAt(Math.floor(Math.random() * charactersLength));
          }
    
          document.getElementById("appId").value = "ap" +result;
        }
        </script>

      <!-- Bootstrap core JavaScript
      ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    </body>
    </html>