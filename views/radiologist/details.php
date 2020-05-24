<?php
  session_start(); 
  $root = '../../';

  // Includes
  include $root.'php/functions.php';
  include $root.'php/app/FetchAppointmentInfo.php';
  include $root.'php/app/PatientInfo.php';

  // Protect The Route
  if (!is_user_logged_in()) {
    header("Location:" . $root);  
    exit();
  }

  $appId = $_GET['appId'];
  $reqId = $_GET['reqId'];
  $patientSSN = $_GET['ssn'];

  $patientInfo = getPatientInfo($patientSSN);
  $appInfo = getAppointmentInfo($appId, $reqId);

  /* print_r($appInfo);
    echo '<br>';
    print_r($patientInfo);
  */  
  
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

  <title>Radiologist Pannel</title>
</head>
<body class="bg-light">

  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="home.php">Radiologist Pannel</a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $root?>php/Auth/logout.php">Logout</a>
      </li>
    </ul>
  </nav>
  <main role="main" class="container">
    <div class="py-5 text-center">
      <h2>Exam details</h2>
      <p class="lead">Edw mporeite na deite tis leptomeries mias eksetasis kayhos kai na tin oloklirosete</p>
    </div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Patient Details</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Exam Details</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Exam Completion</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent"><br>
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <label for="firstName">National Security Number: <?php echo $patientInfo['ssn'] ?></label><br>
        <label for="firstName">First Name: <?php echo $patientInfo['name'] ?></label><br>
        <label for="firstName">Last Name: <?php echo $patientInfo['lastname'] ?></label><br>
        <label for="firstName">Father's Name: <?php echo $patientInfo['father_name'] ?></label><br>
        <label for="firstName">Mother's Name <?php echo $patientInfo['mother_name'] ?></label><br>
        <label for="firstName">Insurance ID: <?php echo $patientInfo['insurance_id'] ?></label><br>
        <label for="firstName">Gender: <?php echo $patientInfo['gender'] ?></label><br>
        <label for="firstName">Birthday: <?php echo $patientInfo['birth_date'] ?></label><br>
        <label for="firstName">Address: <?php echo $patientInfo['home_address'] ?></label><br>
        <label for="firstName">Home Phone: <?php echo $patientInfo['home_number'] ?></label><br>
        <label for="firstName">Work Phone: <?php echo $patientInfo['work_number'] ?></label><br>
        <label for="firstName">Mobile Phone: <?php echo $patientInfo['mobile_number'] ?></label><br>
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <label for="firstName">Exam ID: <?php echo $appInfo['examId'] ?></label><br>
        <label for="firstName">Examination Type: <?php echo $appInfo['examType'] ?></label><br>
        <!-- Comments & Description Section - Make A Paragraph or Textarea -->
        <label for="firstName">Comments:</label>
        <p class="border">
          <?php echo $appInfo['comments']?>
        </p><br>
        <label for="firstName">Description:</label>
        <p class="border">
          <?php echo $appInfo['description']?>
        </p>
        <br>
      </div>
      <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <form action="<?php echo $root?>php/app/DeleteExam.php" method="post">
          <?php
            echo "<button class='btn btn-success' role='button'>Complete Exam</button>"
          ?>
          <input type="hidden" name="appId" value="<?php echo $appId?>">
        </form>
      </div>
    </div>
  </main>

  <!-- Bootstrap core JavaScript

  ================================================== -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
</body>
</html>
