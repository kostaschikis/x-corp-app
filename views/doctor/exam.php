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

  // Get POST Data
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $ssn = $_POST['ssn'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $fatherName = $_POST['fatherName'];
    $motherName = $_POST['motherName'];
    $zipCode = $_POST['zipCode'];
    $gender = $_POST['gender'];
    $birthDay = $_POST['birthDay'];
    $homeAddress = $_POST['homeAddress'];
    $homePhone = $_POST['homePhone'];
    $workPhone = $_POST['workPhone'];
    $mobilePhone = $_POST['mobilePhone'];
  }

  // Get Current Date & Hour Timestamp
  $currentTime = getCurrentDate();


?>


<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>X CORP - Exam</title>
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
     
      <h2>Exam Details</h2>
    </div>
    
    <form class="needs-validation" action="<?php echo $root?>php/app/StoreActinoRequest.php" method="POST" novalidate>
      <div class="row">
        <div class="col-md-6 order-md-2 mb-4">
          <h4 class="mb-3">Patient's Info</h4> 
          <div class="mb-3">
            <label for="address2">SSN</label>
            <input type="text" class="form-control" name="ssn" value="<?php echo $ssn?>" readonly> 
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">First name</label>
              <input type="text" class="form-control" name="firstName" value="<?php echo $firstName?>" id="firstname" readonly>
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Last name</label>
              <input type="text" class="form-control" name="lastName" value="<?php echo $lastName?>" id="lastname" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">Father's name</label>
              <input type="text" class="form-control" name="fatherName" id="fathersname" value="<?php echo $fatherName?>" readonly>
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Mother's name</label>
              <input type="text" class="form-control" name="motherName" id="mothersname" value="<?php echo $motherName?>" readonly>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="username">Insurance ID</label>
              <input type="text" class="form-control" name="zipCode" value="<?php echo $zipCode?>" id="zip" readonly>
            </div>
            <div class="col-md-4 mb-3">
              <label for="firstName">Gender</label>
              <input type="text" class="form-control" name="gender" id="gender" value="<?php echo $gender?>" readonly>
            </div>
            <div class="col-md-4 mb-3">
              <label for="lastName">Date of birth</label>
              <input type="text" class="form-control" name="birthDay" id="birthday" value="<?php echo $birthDay?>" readonly>
            </div>
          </div>

          <div class="mb-3">
            <label for="address2">Home Address</label>
            <input type="text" class="form-control" name="homeAddress" value="<?php echo $homeAddress?>" id="adrs" readonly>
          </div>

          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="Home Phone">Home phone</label>
              <input type="text" class="form-control" name="homePhone" value="<?php echo $homePhone?>" id="homephone" readonly>
            </div>
            <div class="col-md-4 mb-3">
              <label for="Work Phone">Work phone</label>
              <input type="text" class="form-control" name="workPhone" value="<?php echo $workPhone?>" id="workphone" readonly>
            </div>
            <div class="col-md-4 mb-3">
              <label for="mobile number">Mobile phone</label>
              <input type="text" class="form-control" name="mobilePhone" value="<?php echo $mobilePhone?>" id="mobilephone" readonly>
            </div>
          </div>    
      </div> 
      
      <!-- Actinology Request Information -->
      <div class="col-md-6 order-md-1">
        <h4 class="mb-3">Exam Details</h4>     
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="NSM">National Security Number</label>
              <div class="input-group">
                <input type="text" class="form-control" name="nsn" id="NSn" required>
                <div class="invalid-feedback" style="width: 100%;">
                  National Security Number is required.
                </div>
              </div>
            </div>
            <!-- Priority -->
            <div class="col-md-6 mb-3">
              <label for="Priority">Exam Priority</label>
              <select class="custom-select d-block w-100" name="priority" id="prior" required>
                <option>High Priority</option>
                <option>Low Priority</option>
              </select>
            </div>
          </div>

          <!-- Exam ID & Date -->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="examid">Exam ID</label>          
              <div class="input-group">
                <div class="input-group-prepend">
                  <button type="button" class="input-group-text" onclick="randomId()">#</button>
                </div>
                <input type="text" class="form-control" name="examId" id="exId" placeholder="Press to generate an Exam ID" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Exam ID is required.
                </div>
              </div>
              <div class="invalid-feedback">
                Exam ID is required.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="Date">Date</label>
              <input type="text" class="form-control" name="sendDate" id="date" value="<?php echo $currentTime?>" readonly>
              <div class="invalid-feedback">
                Exam date is required.
              </div>
            </div>
          </div>

          <!-- Examintaion Info -->
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="exam">Examination</label>
              <select class="form-control" name="examType" id="exam">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
              </select>
              <div class="invalid-feedback">
                Examintaion type is required.
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Suggested Exam Date</label>
              <input type="date" class="form-control" name="sugExamDate" id="lastName" required>
              <div class="invalid-feedback">
                Suggested exam date is required.
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="comment">Exam description</label>
            <textarea class="form-control" rows="5" name="examDescription" id="comment"></textarea>
          </div>
      
          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" type="submit">Save and Send</button>

        </form>
      </div>
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

      document.getElementById("exId").value = "ex" +result;
    }
    </script>


  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
</body>
</html>
