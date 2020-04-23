<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <title>X Corp - Home</title>
  <style>
    form {
      margin: 0 auto;
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-dark bg-dark">
    <a href="index.html" class="navbar-brand">X CORP</a>
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

  <div class="py-5 text-center">
    <img src="img/logo.png" alt="Smiley face" height="130" width="130"><br><br>
    <h2>Welcome to X CORP</h2>
    <p class="lead">Here you can login to your account</p>
  </div>

  <form class="w-25 p-3" action="./php/Auth/login.php" method="POST">
    <!-- Select Your Specialty -->
    <div class="form-group">
      <label for="inputAddress2">Select your specialty</label>
      <select id="inputState" name="specialty" class="form-control" onclick="myFunction()">
        <option disabled selected>Choose your specialty</option>
        <option>Doctor</option>
        <option>Radiology Center Staff</option>
        <option>Radiologist</option>
      </select>
    </div>
    <div class="form-group">
      <h3 id="demo"></h3>
    </div>
    <!-- Email -->
    <div class="form-group">
      <input type="email" name="email" class="form-control" id="inputAddress" placeholder="Email">
    </div>
    <!-- Password -->
    <div class="form-group">
      <input type="password" name="password" class="form-control" id="inputAddress" placeholder="Password">
    </div>
    <!-- Submit -->
    <button type="submit" class="btn btn-primary w-100">Login</button><br><br>
    <!-- Forgot My Password -->
    <a href="#" class="d-flex justify-content-center">I forgot my password</a>
    <div class="form-group d-flex justify-content-center">
      <p>If you dont have an account, create one <a href="register.php">here</a>.</p>
    </div>
  </form>

  <script>
    function myFunction() {
      var x = document.getElementById("inputState").value;
      if (x == "Doctor" || x == "Radiology Center Staff" || x == "Radiologist")
        document.getElementById("demo").innerHTML = "Login as " +x;
    }
  </script>

  <!-- CDN Scripts -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
