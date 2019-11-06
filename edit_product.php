<?php
session_start();
include("database.php");
$get_prod_id=$_GET['id'];
//works if update button is clicked
if(isset($_POST['save'])=='Update')
{
    //catch data from form
    $category=$_POST['category'];
    $product=$_POST['product'];
    $price=$_POST['price'];
    $description=$_POST['description'];
    //test if all field empty
    if($category == "" && $product == "" && $price == "" && $description == "")
    {
        $f=3;
        $message3="Atleast a field required";
    }
    else 
    {
        //update the values in table for id=$get_prod_id.
        $insert = "UPDATE product SET cat_id='$category',prod_title='$product',price='$price',description='$description' where prod_id='$get_prod_id'";
        //if updated flag to show success div
        if(mysql_query($insert))
        {
            $f=1;
            $message1="Congratulation! A new information has been added successfully.";
        }
        //if failed flag to show error div
        else
        {   
            $f=2;
            $message2="There seems to have been an issue!Please try again.";
        }
    }
}
//show if  loggedin
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
     <script>
     function numericOnly(event) {
      var key = window.event.keyCode || event.keyCode;
      return ((key >= 48 && key <= 57) || (key >= 96 && key <= 105) || (key == 8) || (key == 9));
  }
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
        else if(isset($f)==2)
        {
          ?>
          <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><?php echo $message2; ?></strong> 
        </div>
<?php
        }
        // query the table to get product infomation with id=$get_prod_id to display in form.
        $query1=mysql_query("select * from product where prod_id='$get_prod_id'");
        $result1=mysql_fetch_array($query1);
        $push_prod_title=$result1['prod_title'];
        $push_cat_id=$result1['cat_id'];
        $push_price=$result1['price'];
        $push_description=$result1['description'];
      ?>
     <!-- Example row of columns -->
      <div class="row">
        <h1>Edit Product</h1>
                <form action="" method="post">
           <div class="span6">
            <label>Product Category</label>
            <div class="input-group">
            <select class="form-control span6" name="category" id="source" required>
              <option value="">Select a Category</option>
                                    <?php 
                                    $res_qual=mysql_query("select * from category");
                                        while($row_qual=mysql_fetch_assoc($res_qual))
                                        {
                                    ?>
                                        <option value="<?php echo $row_qual['cat_id'];?>" <?php if($row_qual['cat_id']==$push_cat_id) { echo "selected='selected'";}?>><?php echo $row_qual['cat_title'];?></option>
                                    <?php
                                        }
                                    ?></select>
            </div>
            </div>
        <div class="span12">
            <label>Product Title</label>
            <div class="input-group">
            <input class="span6" type="text" name="product" value="<?php echo $push_prod_title;?>" required>
            </div>
            </div> 
             <div class="span12">
            <label>Product Price</label>
            <div class="input-group">
            <input class="span6" type="text" name="price" onkeydown="return numericOnly(event);" value="<?php echo $push_price;?>" required>
            </div>
            </div> 
             <div class="span12">
            <label>Description</label>
            <div class="input-group">
            <textarea rows="3" class="span6" name="description" required><?php echo $push_description;?></textarea>
            </div>
            </div>               
            <div class="span12">
              <button type="submit" class="btn" name="save">Update</button>
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