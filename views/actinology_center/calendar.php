<?php 
  session_start(); 
  $root = '../../';
  $altroot = '../..';

  // Includes
  include $root.'php/functions.php';

  // Protect The Route
  if (!is_user_logged_in()) {
    header("Location:" . $root);  
    exit();
  }
?>
<!doctype html>
<html>
    <head>
      <title> Getting started with dhtmlxScheduler</title>

      <!-- Favicon -->
      <link rel="icon" type="image/png" href="../../img/logo.png">

      <meta charset="utf-8">
        <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" href="../../css/center.css">
      <script src="https://cdn.dhtmlx.com/scheduler/edge/dhtmlxscheduler.js"></script>
      <link href="https://cdn.dhtmlx.com/scheduler/edge/dhtmlxscheduler_material.css" 
              rel="stylesheet" type="text/css" charset="utf-8">
        <style>
          html, body{
            margin:0px;
            padding:0px;
            height:100%;
            overflow:hidden;
          }
          .dhx_cal_event.completed div{
            background-color: #28A745 !important;
          }

          .dhx_cal_event.waiting div{
            background-color: #C82333 !important;
          }

        </style> 
    </head> 
    <body> 
    <nav class="navbar navbar-dark bg-dark">
      <a href="home.php" class="navbar-brand">Radiology Center</a> 
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $root ?>php/Auth/logout.php">Logout</a>
        </li>
      </ul>
    </nav>
    <div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:100%;'> 
        <div class="dhx_cal_navline"> 
            <div class="dhx_cal_prev_button">&nbsp;</div> 
            <div class="dhx_cal_next_button">&nbsp;</div> 
            <div class="dhx_cal_today_button"></div> 
            <div class="dhx_cal_date"></div> 
            <div class="dhx_cal_tab" name="day_tab"></div> 
            <div class="dhx_cal_tab" name="week_tab"></div> 
            <div class="dhx_cal_tab" name="month_tab"></div> 
    </div> 
    <div class="dhx_cal_header"></div> 
    <div class="dhx_cal_data"></div> 
    </div> 
    <script>
        // Sheduler Configuration
        scheduler.config.dblclick_create = false;
        scheduler.config.drag_event_body = false;
        scheduler.config.drag_create = false;
        scheduler.config.drag_resize = false;
        scheduler.config.readonly = true;
        scheduler.xy.min_event_height = 90;

        scheduler.templates.event_class = function (start, end, event) {
          if (event.type == 'waiting') return "waiting";
          return "completed"; 
        }; 

        scheduler.init('scheduler_here', new Date(), "week");
        scheduler.load("../../php/app/FetchAppointments.php");


        var dp = new dataProcessor("../../php/app/FetchAppointments.php");
        dp.init(scheduler);
        dp.setTransactionMode("JSON"); // use to transfer data with JSON
    </script> 
    </body> 
</html>  
