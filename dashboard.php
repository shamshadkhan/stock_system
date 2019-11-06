<?php
session_start();
include("database.php");
if(!empty($_SESSION['username123']))
{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <!--link rel="stylesheet" type="text/css" media="screen" href="css/styles.css" /-->
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap-datetimepicker.min.css" />
     
    <script type="text/javascript" src="js/jquery.min.js"></script>

    <script type="text/javascript">
                             $(function () {
                                $('#datetimepicker1').datetimepicker();
                            });
                              $(function () {
                                $('#datetimepicker2').datetimepicker();
                            });

                        </script>
</head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="dashboard.php">Project</a>
          <?php include('menu.php');?>
        </div>
      </div>
    </div>

    <div class="container">
      
     <!-- Example row of columns -->
      <div class="row">
         <center><h1> Welcome <?php echo $_SESSION['username123'];?></h1><center>
      </div>

      <hr>

     <?php include('footer.php');?>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <script type="text/javascript" src="js/bootstrap.min.js"></script>
   <script type="text/javascript" src="js/moment-2.4.0.js"></script>
   
     <script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script>
     
  </body>
</html>
<?php
}
else
echo "<script>javascript:window.location = 'index.php'</script>";
?>