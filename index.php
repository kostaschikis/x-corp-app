<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="./img/logo.png">

  <title>X Corp - Home</title>
  <style>
    body { 
      background: url("./img/2.jpg") no-repeat center center fixed; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    } 

    form {
      margin: 0 auto;
    }

  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">
    <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
    X CORP
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
    </ul>
    <a class="btn btn-primary btn-sm" href="register.php" role="button">Register</a>
  </div>
  </nav>
  

  <?php 
    if ( isset($_GET['logout']) && $_GET['logout'] == 'success') {
      echo '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>You have been logout.</strong> You can login again by using your credentials.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    } else if (isset($_GET['regSuccess']) && $_GET['regSuccess'] == 'true') {
      echo '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Your Account Has Been Created Successfully.</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
  ?>

  <div class=".container-fluid">
    <div class="container">
      <div class="py-5 text-center">
        <img src="img/logo.png" alt="Smiley face" height="130" width="130"><br><br>
        <h2>Welcome to X CORP</h2>
        <p class="lead">Here you can login to your account</p>
      </div>
        <?php
          if (isset($_GET['error']) && ($_GET['error'] == 'wrongpass' || $_GET['error'] == 'nouser') ) {
            echo "<p class='text-danger text-center font-weight-bold' id='errorBanner'>Incorect Password or Email</p>";
          }  
        ?>
        <form class="w-50" action="./php/Auth/login.php" method="POST">
          <!-- Select Your Specialty -->
          <label for="exampleFormControlSelect1">Select your Specialty</label>
          <div class="form-group">      
            <select id="inputState" name="specialty" class="form-control" onclick="myFunction()">
              <option disabled selected>Specialty</option>
              <option>Doctor</option>
              <option>Radiology Center Staff</option>
              <option>Radiologist</option>
            </select>
          </div>
          <div class="form-group">
            <h3 id="demo"></h3>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Email</label>
              <input type="email" name="email" class="form-control" id="email" placeholder="Email">
            </div>
            <div class="form-group col-md-6">
              <label for="inputPassword4">Password</label>
              <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>
          </div>
          
          <!-- Submit -->
          <button type="submit" class="btn btn-primary w-100">Login</button><br><br>
          <!-- Forgot My Password -->
          <div>
            <a href="#" class="d-flex justify-content-center">I forgot my password</a>
            <div class="form-group d-flex justify-content-center">
              <p>If you dont have an account, create one <a href="register.php">here</a>.</p>
            </div>
          </div>
          
        </form>
    </div>
  </div>

  <!-- CDN Scripts -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="./js/index.js"></script>
</body>
</html>
