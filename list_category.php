<?php
session_start();
//check if user loggedin
if(empty($_SESSION['username123']))
{
  header("Location: index.php");
}
else
{
  include("database.php");
  if(isset($_GET['msg']) && $_GET['msg']!="")
  $msg = $_GET['msg'];
  //if deleted massage passed==1 then show success message
  if(isset($msg) == 1)
  {
    $message1 = "Successfully Deleted";
    $f=1;
  }
  //if deleted massage passed==2 then show error message
  else if(isset($msg) == 2)
  {
    $message2 = "Failed to Delete. Try Again Later.";
    $f1=2;
  }
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
       <?php
      //show success div

        if(isset($f)==1)
        {
          ?>
          <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><?php echo $message1; ?></strong> 
        </div>
<?php
        }
      //show error div

        if(isset($f1)==2)
        {
          ?>
          <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><?php echo $message2; ?></strong> 
        </div>
<?php
        }
      ?>
     <!-- Example row of columns -->
      <div class="row">
        <h1>List Category</h1>
                <form action="" method="post">
          
        <div class="span12">
            <table class="table table-bordered table-striped">
              <tr><th width="140">Sl. Number</th><th>Category</th><th width="40">Action</th><tr>
                <?php
                                    include("database.php");
                                    //display all category
                                    $query = "select * from  category";
                                    $res_port = mysql_query($query);
                                    if ($res_port) {
                                        $c=1;
                                       while ($row_port = mysql_fetch_array($res_port)) {
                                        $cat_title=$row_port['cat_title'];
                                        $cat_id=$row_port['cat_id'];
                                        echo '<tr >';
                                        echo '<td >'. $c . '</td>';
                                        echo '<td class=" ">'. $cat_title. '</td>';
                                        echo '<td class=" ">
                                        <a href="edit_category.php?id='.$cat_id.'"><i class="icon-edit"></i></a>
                                        <a href="delete_category.php?id='.$cat_id.'"><i class="icon-trash"></i></a></td>';
                                        echo '</tr>';
                                        $c++;
                                         }
                                       }
                                       ?>
                              
            </table>       
        
         </form>
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
?>