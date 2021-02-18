<?php
session_start();
include 'config.php';
    $conn = mysqli_connect($db_host,$db_user,$db_password,$db_name);
    if (!$conn) {
    die("Connection failed.");
    }

    if(isset($_POST['submitVote']))
    {
        echo "<script>alert('thanks!');</script>";
        $voter_id= $_SESSION["voter_id"];

        $radioVal_cid = $_POST['VoteRadio'];
        
        $sql1= "UPDATE voter SET flag=1 WHERE voter_id='$voter_id' ";

        $sql2= "UPDATE candidate SET count_vote=count_vote+1 WHERE cid='$radioVal_cid' ";
        if (mysqli_query($conn, $sql1) && mysqli_query($conn,$sql2)) {
            
            header("location: saveVote.php");
        }
        else
        {
            echo "Error: " . $sql2 . ":-" . mysqli_error($conn);
        }
    }

    $sql= "SELECT * FROM candidate ";
    $result= mysqli_query($conn, $sql);
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Control Panel</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>

    <style>
        table,th,td{
            text-align:center;
            padding: 10px;
        }

      .headerFont{
        font-family: 'Ubuntu', sans-serif;
        font-size: 24px;
      }

      .subFont{
        font-family: 'Raleway', sans-serif;
        font-size: 14px;
        
      }
      .specialHead{
        font-family: 'Oswald', sans-serif;
      }

      .normalFont{
        font-family: 'Roboto Condensed', sans-serif;
      }
      .icon-input-btn{
        display: inline-block;
        position: relative;
      }
      .icon-input-btn input[type="submit"]{
          padding-left: 2em;
      }
      .icon-input-btn .glyphicon{
          display: inline-block;
          position: absolute;
          left: 0.3em;
          top: 24%;
          color:white;
      }
    </style>

  </head>
  <body>
  <div class="container">
  	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse
    " role="navigation">
      <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="navbar-header">
          <a href="#" class="navbar-brand headerFont text-lg"><strong>eVoting</strong></a>
        </div>
      </div> 
    </nav>  

    <center>
    <div class="container" style="padding:100px 10px 20px 10px ;">
      <div class="row">
        <div class="col-sm-12" style="border:2px solid gray;">
        <center>
          <div class="page-header">
            <h2 class="specialHead" ></span>CAST YOUR VOTE WISELY, <?php echo $_SESSION["name"];?>!</h2><br>
            
            <form method="POST" action="vote.php">
            <table style = "width:75%;border-collapse: collapse;" border="1px">
                <tr>
                <center>
                <th>Political Party</th>
                <th>Candidate Name</th>
                <th>PHOTO</th>
                <center>
                </tr>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                    <td>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="VoteRadio" id="<?php echo $row["party"] ?>"  value="<?php echo $row["cid"]?>">
                        <label class="form-check-label" for='<?php $row["party"] ?>' ><?php echo $row["party"]?></label>
                        </div>
                    </td>
                     <td><?php echo $row["cname"]; ?></td>
                    <td><img src="<?php echo ('images/'.$row["cphoto"]); ?>" alt="img not found!" width="60px" height="60px" >
                    </tr>
                <?php } ?>
            </table>
            <br>
            <div class="form-group-row">
        <input type="submit" class="btn btn-primary" name="submitVote" value="SUBMIT VOTE">
        </div>
        </form>

          </div>
        </center>
      </div>
    </div>
  </div>
  </center>

    
    

