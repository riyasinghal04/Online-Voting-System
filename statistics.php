<?php
session_start();
include 'config.php';
    $conn = mysqli_connect($db_host,$db_user,$db_password,$db_name);
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

        <div class="collapse navbar-collapse" id="example-nav-collapse">
          <ul class="nav navbar-nav">
          <li><a href="adminlanding.php"><span class="subFont"><strong>Admin Info</strong></span></a></li>
             <li><a href="candidates.php"><span class="subFont"><strong>Candidates List</strong></span></a></li>
            <li><a href="statistics.php"><span class="subFont"><strong>Statistics</strong></span></a></li>        
          </ul>
          
          <span class="normalFont"><a href="index.html" class="btn btn-success navbar-right navbar-btn"><strong>Sign Out</strong></a></span></button>
        </div>
      </div> 
    </nav>
 <br><br><br>

<?php
 
 //--------------Pie Chart ---------------------
$dataPointsPie = array();
$totalvotes=0;

$sql = "Select * from candidate";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)) { 
  $totalvotes= $totalvotes + $row["count_vote"];
}

$sql = "Select * from candidate";
$result1 = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result1)) { 
  $percent = $row["count_vote"]*100/$totalvotes;
  $label="Candidate : ".$row["cname"]." , Party : ".$row["party"];
  array_push($dataPointsPie, array("label"=> $label, "y"=> $percent));
}

//-------------Bar Graph-----------------//
$sql = "Select * from candidate";
$result2 = mysqli_query($conn,$sql);

$dataPointsBar = array(); 

while($row = mysqli_fetch_assoc($result2)) { 
  $label="Party : ".$row["party"];
  array_push($dataPointsBar, array("y"=> $row["count_vote"] ,"label"=> $label ));
}


//-------------Line Graph-----------------//
$sql = "Select * from voter where flag=1";
$result3 = mysqli_query($conn,$sql);

$cnt=0;
while($row = mysqli_fetch_assoc($result3)) { 
  $cnt++;
}

//just to increase scale
$cnt=$cnt*5;
$cnt=76+$cnt;

$dataPointsLine = array(
	array("y" => 65, "label" => "1995"),
	array("y" => 89, "label" => "2000"),
	array("y" => 101, "label" => "2005"),
	array("y" => 84, "label" => "2010"),
	array("y" => 113, "label" => "2015"),
	array("y" => $cnt, "label" => "2020")
);
	
?>
 
<!DOCTYPE HTML>
<html>
<head>
<script>
//Pie Chart
window.onload = function() {
  
var chartPie = new CanvasJS.Chart("chartContainerPie", {
	animationEnabled: true,
	title: {
		text: "Percentage of Votes Obtained"
	},
	subtitles: [{
		text: "November 2020"
	}],
	data: [{
		type: "pie",
		yValueFormatString: "#,##0.00\"%\"",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($dataPointsPie, JSON_NUMERIC_CHECK); ?>
	}]
});
chartPie.render();


//Bar Graph
 var chartBar = new CanvasJS.Chart("chartContainerBar", {
   animationEnabled: true,
   title:{
     text: "ELECTION GROWTH"
   },
   subtitles: [{
		text: "November 2020"
	}],
   axisY: {
     title: "",
     includeZero: true,
     prefix: "",
     suffix:  ""
   },
   data: [{
     type: "bar",
     yValueFormatString: "#,## votes",
     indexLabel: "{y}",
     indexLabelPlacement: "inside",
     indexLabelFontWeight: "bolder",
     indexLabelFontColor: "white",
     dataPoints: <?php echo json_encode($dataPointsBar, JSON_NUMERIC_CHECK); ?>
   }]
 });
 chartBar.render();


 //line chart
var chartLine = new CanvasJS.Chart("chartContainerLine", {
  animationEnabled: true,
	title: {
		text: "Voters Turnout in Indian Elections"
	},
	axisY: {
		title: "Number of Citizens(in millions)"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPointsLine, JSON_NUMERIC_CHECK); ?>
	}]
});

chartLine.render();
 
}

</script>
</head>
<body>
<div class="container" style="padding:30px 30px 30px 30px ;">
      <div class="row">
        <div class="col-sm-12" style="border:2px solid gray;">
        <center>
          <br>
            <div id="chartContainerPie" style="height: 400px; width: 100%;"></div>
          <br>
        </center>
        </div>
      </div>
      <br><br>
      <div class="row">
        <div class="col-sm-12" style="border:2px solid gray;">
        <center>
          <br>
         <div id="chartContainerBar" style="height: 400px; width: 80%;"></div>
          <br>
        </center>
        </div>
      </div><br><br>
      <div class="row">
        <div class="col-sm-12" style="border:2px solid gray;">
        <center>
          <br>
            <!--no of people who voted - flag=1-->
            <div id="chartContainerLine" style="height: 400px; width: 80%;"></div><br>
            <h2 class="normalFont" style="font-size:15px" ></span>Number of Indian Citizens voting in this year's election as compared to Previous Year's Turnouts<br>(previous year data is not true to knowledge and is assumed accordingly)</h2>
          <br>
        </center>
        </div>
      </div>
</div>


<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>   

    