<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="./img/logo.png">

  <title>X Corp - Register</title>
  <style>
      body {
        /* The image used */
        background-image: url("./img/5.jpg");

        /* Full height */
        height: 100%; 

        /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    form{
      margin: 0 auto;
    }

    .footer {
      position: fixed;
      left: 0;
      bottom: 0;
      width: 100%;
      background-color: transparent;
      color: black;
      text-align: center;
  }
  </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <a href="index.php" class="navbar-brand">
    <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
    X CORP</a>
  </nav>

  <div class="py-5 text-center">
    <img src="img/logo.png" alt="Smiley face" height="130" width="130"><br><br>
    <h2>Create an Account</h2>
    <p class="lead">Here you can create a new account</p>
    <small>The creation of an account concerns exclusively health professions and employees of medical facilities.</small>
  </div>

  <form class="w-25 p-3" action="php/Auth/register.php" method="POST">
    <div class="form-row">
      <!-- First Name -->
      <div class="form-group col-md-6">
        <label for="inputEmail4">First name</label>
        <input type="text" class="form-control" name="firstName" id="inputEmail4">
      </div>
      <!-- Last Name -->
      <div class="form-group col-md-6">
        <label for="inputPassword4">Last name</label>
        <input type="text" class="form-control" name="lastName" id="inputPassword4">
      </div>
    </div>
    <!-- Email -->
    <div class="form-group">
      <label for="inputAddress">Email</label>
      <input type="email" class="form-control" name="email" id="inputAddress">
    </div>
    <!-- Password -->
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Password</label>
        <input type="password" class="form-control" name="password" id="inputEmail4">
      </div>
      <!-- Confirm Password -->
      <div class="form-group col-md-6">
        <label for="inputPassword4">Password Confirmation</label>
        <input type="password" class="form-control" name="passwordConfirm" id="inputPassword4">
      </div>
    </div>
    <!-- Specialty -->
    <div class="form-group">
      <label for="inputAddress2">Specialty</label>
      <select id="inputState" name="specialty" class="form-control">
        <option disabled selected></option>
        <option>Doctor</option>
        <option>Radiology Center Staff</option>
        <option>Radiologist</option>
      </select>
    </div>    
    <!-- Submit -->
    <button type="submit" class="btn btn-primary w-100">Sign up</button><br><br>
    <!-- Sign in  -->
    <div class="form-group d-flex justify-content-center">
      <p>Already have an account? <a href="index.php">Sign In</a>.</p>
    </div>
  </form>
  <div class="footer">
    <p><small>Copyright © 2020 X CORP</small></p>
  </div>
</body>
</html>
