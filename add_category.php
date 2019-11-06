<?php
session_start();
include("database.php");
//work if save button clicked
if(isset($_POST['save'])=='Save')
{
    //catch data from form
    $category=$_POST['category'];
    //test if all field empty
    if($category == "")
    {
        $f=3;
        $message3="Atleast a field required";
    }
    else 
    {
        //insert into table
        $insert = 'INSERT INTO category(cat_title)
        VALUES("'.$category.'")';
        //if inserted show success message
        if(mysql_query($insert))
        {
            $f=1;
            $message1="Congratulation! A new information has been added successfully.";
        }
        //if failed show success message
        else
        {   
            $f1=2;
            $message2="There seems to have been an issue!Please try again.";
        }
    }
}
//show the page only if logged in
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
        <h1>Add Category</h1>
                <form action="" method="post">
          
        <div class="span12">
            <label>Product Category</label>
            <div class="input-group">
            <input class="span6" type="text" name="category">
            </div>
            </div>                
            <div class="span12">
              <button type="submit" class="btn" name="save">Save</button>
            </div>
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
else
echo "<script>javascript:window.location = 'index.php'</script>";
?>