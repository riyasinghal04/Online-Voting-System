<?php
 session_start();

 if(isset($_POST['logout']))
        {
        session_unset();
        session_destroy();
        header("location: index.html");
        } 
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>VOTE SAVED</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
    .container{  
        text-align: center;    
        width: 300px;  
        height: 200px;  
        padding-top: 100px;  
    }  
    #btn{  
      font-size: 25px;  }  
      </style>
  </head>
  <body>
  <div class="container">
    <div class= "row">
    <?php $var = $_COOKIE['voterName']; ?>
    <?php echo "<h2 class='text-info specialHead text-center'><strong> Thank you ".$var." !</strong></h2>"; ?>
    <?php setcookie("voterName","",time()-60*60*24,'/'); ?>
    <?php echo "<h3 class='text-info specialHead text-center'><strong> YOU'VE  SUCCESSFULLY   VOTED.</strong></h3>"; ?>
    <?php echo "<h3 class='text-info specialHead text-center'><img src='images/success.png' width='70' height='70'></h3>"; ?>
    </div>
    <div class="row">
    <br><br>
    <form action="user_profile.php" method="POST">
    <input type="submit" id="#btn" name="logout" value="LOGOUT" class="btn btn-success">
    </form>
    </div>
  </div>
  
</body>
</html>
				