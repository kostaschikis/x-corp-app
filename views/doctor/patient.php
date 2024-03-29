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
    <a href="home.php" class="navbar-brand">Doctor Panel</a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php echo $root ?>php/Auth/logout.php">Logout</a>
      </li>
    </ul>
  </nav>

  <div class="container" style="width: 40%;">
    <div class="py-5 text-center">
      <h2>New Exam</h2>
      <p class="lead">Patient's Information</p>
    </div>
    <!-- Make New Application -->
    <form class="needs-validation" action="exam.php" method="POST">
      <div class="mb-3">
        <label for="address2">SSN</label>
        <input type="text" class="form-control" name="ssn" id="adrs" required>
        <div class="invalid-feedback">
          Patient's Address is required.
        </div>
      </div>
      <!-- Patient's Info -->
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="firstName">First name</label>
          <input type="text" class="form-control" name="firstName" id="firstname" required>
          <div class="invalid-feedback">
            Patient's First name is required.
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <label for="lastName">Last name</label>
          <input type="text" class="form-control" name="lastName" id="lastname" required>
          <div class="invalid-feedback">
            Patient's Last name is required.
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="firstName">Father's name</label>
          <input type="text" class="form-control" name="fatherName" id="fathersname" required>
          <div class="invalid-feedback">
            Patient's Father's name is required.
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <label for="lastName">Mother's name</label>
          <input type="text" class="form-control" name="motherName" id="mothersname" required>
          <div class="invalid-feedback">
            Patient's Mother's name is required.
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-md-4 mb-3">
          <label for="insuranceId">Insurance ID</label>
          <input type="text" class="form-control" name="insId" id="insId" required>
          <div class="invalid-feedback">
            Patient's Insurance ID is required
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <label for="firstName">Gender</label>
          <select class="custom-select d-block w-100" name="gender" id="gndr" required>
            <option>Male</option>
            <option>Female</option>
            <option>Other</option>
          </select>
        </div>
        <div class="col-md-4 mb-3">
          <label for="lastName">Date of birth</label>
          <input type="date" class="form-control" name="birthDay" id="birth" required>
          <div class="invalid-feedback">
            Patient's Date of birth is required.
          </div>
        </div>
      </div>

      <div class="mb-3">
        <label for="address2">Home Address</label>
        <input type="text" class="form-control" name="homeAddress" id="adrs">
        <div class="invalid-feedback">
          Patient's Address is required.
        </div>
      </div>

      <!-- Patient's Phone Numbers -->
      <div class="row">
        <div class="col-md-4 mb-3">
          <label for="Home Phone">Home phone</label>
          <input type="text" class="form-control" name="homePhone" id="homephone" required>
          <div class="invalid-feedback">
            Patient's Home phone is required.
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <label for="Work Phone">Work phone</label>
          <input type="text" class="form-control" name="workPhone" id="workphone" required>
          <div class="invalid-feedback">
            Patient's Work phoner is required.
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <label for="mobile number">Mobile phone</label>
          <input type="text" class="form-control" name="mobilePhone" id="mobilephone" required>
          <div class="invalid-feedback">
            Patient's Mobile phone is required.
          </div>
        </div>
      </div>

      <hr class="mb-4">
      <button class="btn btn-primary btn-lg btn-block" type="submit">Continue</button>
    </form>
  </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
</body>
</html>
