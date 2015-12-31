<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>METER - Energy-use.org</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Optional theme -->
	<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="css/meter_q.css">
</head>

<body>
<?php
// Define connection settings
//$server = '109.74.196.205';
$server = 'localhost';
$dbName = 'Meter';
$dbUserName = 'phil';
$dbUserPass = 'SSartori12';

// Connect to the database server
$db = mysqli_connect($server,$dbUserName,$dbUserPass,$dbName);

if (mysqli_connect_errno()) {
    print '<p class="alert alert-error">Oh, dear. The connect failed: ' . mysqli_connect_error() . '. Please email philipp.grunewald@ouce.ox.ac.uk about it.</p>';
    exit();
} else {

$sql = "SELECT people, income, age_group3 FROM Household WHERE idHousehold = 999";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		$people = $row["people"];
		$age_group1 = $row["age_group1"];
		$age_group2 = $row["age_group2"];
		$age_group3 = $row["age_group3"];
		$income = $row["income"];
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}

}

?>

			<!--
				if (thisID == 'people') {
			var thisValue = parseInt(thisButton.innerHTML);
			-->
    <script type="text/javascript">
		function radioToggle(thisButton) {
			var thisID = thisButton.getAttribute('id');
			var thisValue = parseInt(thisButton.value);
			var hasClass = thisButton.getAttribute('class');
			var radioButtons = document.getElementsByClassName("meterbutton active");
				for(var i=0; i<radioButtons.length; i++) {
				        radioButtons[i].setAttribute('class', 'meterbutton passive');
				}
			if (hasClass !== 'meterbutton active') {
				thisButton.setAttribute('class', 'meterbutton active');
				var parameter = document.getElementById(thisID);
				parameter.value = thisValue;
			}
		};
		function toggle(button) {
		  var hasClass = button.getAttribute('class');
			if (hasClass !== 'meterbutton active') {
	        button.setAttribute('class', 'meterbutton active');
			}
			else {
	        button.setAttribute('class', 'meterbutton passive');
			}
		};
	    </script>

	<script type="text/javascript"> <!-- increase number by one -->
	    function addOne(thisButton) {
			var counter = parseInt(thisButton.innerHTML);
	        counter += 1;
	        thisButton.innerHTML = counter;
	        thisButton.setAttribute('class', 'meterbutton modified');
	    };
	    </script>
	

	<div class="container"> <!-- Static navbar -->
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">
						<img class="img-responsive" src="img/meter_logo_trans.png" alt="METER" width="120" />
					</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="http://www.energy-use.org">Home</a></li>
						<li><a href="http://www.distributed-energy.de/?pagid=2">About</a></li>
						<li><a href="http://www.distributed-energy.de/?pagid=388">Partners</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">For participants<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="http://www.distributed-energy.de/?pagid=408">How METER works</a></li>
								<li><a href="http://www.distributed-energy.de/?pagid=316">Register</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="http://www.distributed-energy.de/?pagid=469">Contact</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">For academics<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="http://www.distributed-energy.de/?pagid=137">Research</a></li>
								<li><a href="https://oxford.academia.edu/PhilippGr%C3%BCnewald">Publications</a></li>
								<li><a href="http://www.distributed-energy.de/?pagid=200">Awards</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="https://www.linkedin.com/in/philipp-gruenewald-32ba561b">LinkedIn</a></li>
								<li><a href="http://www.distributed-energy.de/?pagid=469">Contact</a></li>
							</ul>
						</li>
					</li>
					<li class="dropdown">
						<a href="resources.htm" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Resources<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="resources.htm#documents">Documents</a></li>
							<li><a href="resources.htm#slides">Slides</a></li>
							<li role="separator" class="divider">External pages</li>
							<li><a href="https://energy-use.mybalsamiq.com/projects/meter/story">App development</a></li>
							<li><a href="https://github.com/PhilGrunewald">GitHub</a></li>
						</ul>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="../navbar-fixed-top/"></a>


					</li>
				</ul>
				<br/>
				<img class="img-responsive pull-right" src="img/eci-logo-colour.png" alt="METER" width="140" />
				<br/>
			</div><!--/.nav-collapse -->
		</div><!--/.container-fluid -->
		</nav>
	</div> <!-- /container -->
<div class="container">		 <!-- CONTENT - row 1 -->
	</br> </br> </br> </br>
	<div class="row">

		<div class="col-xs-8 col-xs-push-2 col-sm-6 col-sm-push-3"  style="background-color: #ffffff; ">
			<!-- Central content - half -->
   <div id="qSlider" class="carousel slide">
    <ol class="carousel-indicators">
     <li data-target="#qSlider" data-slide-to="0" class="active"></li>
     <li data-target="#qSlider" data-slide-to="1" ></li>
     <li data-target="#qSlider" data-slide-to="2" ></li>
     <li data-target="#qSlider" data-slide-to="3" ></li>
    </ol>

		<!--
	<form method="get" action="submit_hhq.php">
					-->
<form method="get">
    <div class="carousel-inner">
					<input type="hidden" id="people" name="people" value="-1">
					<input type="hidden" id="inc" name="inc" value="-1">
					<input type="hidden" name="ag1" value="-1">
					<input type="hidden" name="ag2" value="-1">
					<input type="hidden" name="ag3" value="-1">
					<input type="hidden" name="ag4" value="-1">
					<input type="hidden" name="ag5" value="-1">
					<input type="hidden" name="ag6" value="-1">

		<div class="item active"> <!-- ONE -->
			<h2> How many people live in your home? </h2>
				<div class="col-xs-6 top-buffer">
				<!-- Button 1 -->
					<button class="meterbutton" id="people" value="1" onClick="radioToggle(this)"> 
					<span class="btnLabel">1</span>
					<span class="btnCaption"></br>just me</span></button>
					</div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 2 -->
					<button class="meterbutton" id="people" value="2" onClick="radioToggle(this)"> 
					<span class="btnLabel">2</span>
					<span class="btnCaption"></br>people</span></button>
					</div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 3 -->
					<button class="meterbutton" id="people" value="3" onClick="radioToggle(this)"> 
					<span class="btnLabel">3</span>
					<span class="btnCaption"></br>people</span></button>
					</div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 4 -->
					<button class="meterbutton" id="people" value="4" onClick="radioToggle(this)"> 
					<span class="btnLabel">4</span>
					<span class="btnCaption"></br>people</span></button>
					</div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 5 -->
					<button class="meterbutton" id="people" value="5" onClick="radioToggle(this)"> 
					<span class="btnLabel">5</span>
					<span class="btnCaption"></br>people</span></button>
					</div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 6 -->
				<button class="meterbutton" id="people" value="6" onClick="radioToggle(this)">
					<span class="btnLabel">6</span>
					<span class="btnCaption"></br>or more</span></button>
					</div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 7 -->
         			<a  href="#qSlider" data-slide="prev">
					<button class="meterbutton previous"> < Back </button>
					</a>
					</div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 8 -->
         			<a  href="#qSlider" data-slide="next">
						<button class="meterbutton next"> Next > </button>
					</a>
					</div>
     	 	</div>

		<div class="item"> <!-- TWO -->
			 <h2>How many of them are in each of these age groups?</h2>
				<div class="col-xs-6 top-buffer">
				<!-- Button 1 -->
					<button class="meterbutton" id="ag1" value="0" onClick="addOne(this)"> 
					<span class="btnCaption">Under 8</span> </br>
					<span class="btnLabel-sm">
						<?php echo $_GET['ag1']; ?>
					</span> </button> </div>
	
				<div class="col-xs-6 top-buffer">
				<!-- Button 2 -->
					<button class="meterbutton" id="ag2" value="0" onClick="addOne(this)"> 
					<span class="btnCaption">Age 8 - 18</span> </br>
					<span class="btnLabel-sm">
						<?php echo $_GET['ag2']; ?>
					</span> </button> </div>
	
				<div class="col-xs-6 top-buffer">
				<!-- Button 3 -->
					<button class="meterbutton" id="ag3" value="0" onClick="addOne(this)"> 0 </button>
					<div class="meterbutton caption">Age 19 - 34</div>
					</div>
	
				<div class="col-xs-6 top-buffer">
				<!-- Button 4 -->
				<button class="meterbutton" id="ag4" value="0" onClick="addOne(this)"> <?php echo $age_group3; ?> </button>
					<div class="meterbutton caption">Age 35 - 50</div>
					</div>
	
				<div class="col-xs-6 top-buffer">
				<!-- Button 5 -->
					<button class="meterbutton" id="ag5" value="0" onClick="addOne(this)"> 0 </button>
					<div class="meterbutton caption">Age 51-70</div>
					</div>
	
				<div class="col-xs-6 top-buffer">
				<!-- Button 6 -->
					<button class="meterbutton" id="ag6" value="0" onClick="addOne(this)"> 0 </button>
					<div class="meterbutton caption">Over 70</div>
					</div>
	
				<div class="col-xs-6 top-buffer">
				<!-- Prev -->
         			<a  href="#qSlider" data-slide="prev">
					<button class="meterbutton previous"> < Back </button>
					</a>
					</div>
				<div class="col-xs-6 top-buffer">
				<!-- Next -->
         			<a  href="#qSlider" data-slide="next">
					<button class="meterbutton next"> Next > </button>
					</a>
					</div>
				</div>

		 <div class="item"> <!-- THREE -->
			<h2>What is your annual household income?</h2>
			<small>Before any deductions for tax of national insurance</small>
		</br>
				<div class="col-xs-6 top-buffer">
				<!-- Button 1 -->
					<button class="meterbutton" id="inc" value='1' onClick="radioToggle(this)"> 
					<span class="btnCaption">less than</span> </br>
					<span class="btnLabel-sm">15,000</span> </button> </div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 2 -->
					<button class="meterbutton" id="inc" value='2' onClick="radioToggle(this)"> 
					<span class="btnCaption">up to</span> </br>
					<span class="btnLabel-sm">25,000</span> </button> </div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 3 -->
					<button class="meterbutton" id="inc" value='3' onClick="radioToggle(this)"> 
					<span class="btnCaption">up to</span> </br>
					<span class="btnLabel-sm">35,000</span> </button> </div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 4 -->
					<button class="meterbutton" id="inc" value='4' onClick="radioToggle(this)"> 
					<span class="btnCaption">up to</span> </br>
					<span class="btnLabel-sm">50,000</span> </button> </div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 5 -->
					<button class="meterbutton" id="inc" value='5' onClick="radioToggle(this)"> 
					<span class="btnCaption">up to</span> </br>
					<span class="btnLabel-sm">75,000</span> </button> </div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 6 -->
					<button class="meterbutton" id="inc" value='6' onClick="radioToggle(this)"> 
					<span class="btnCaption">more than</span> </br>
					<span class="btnLabel-sm">75,000</span> </button> </div>

				<div class="col-xs-6 top-buffer">
				<!-- Button 7 -->
         			<a  href="#qSlider" data-slide="prev">
						<button class="meterbutton previous"> <- Back </button>
					</a>
					</div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 8 -->
         			<a  href="#qSlider" data-slide="next">
					<button class="meterbutton next"> Next > </button>
					</a>
					</div>
     	 		</div>

		 <div class="item"> <!-- FOUR -->
			<h2>What is your annual household income?</h2>
			<small>Before any deductions for tax of national insurance</small>
				<div class="col-xs-6 top-buffer">
				<!-- Button 1 -->
					<button class="meterbutton" onClick="radioToggle(this)"> 1 </button>
					</div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 2 -->
					<button class="meterbutton" onClick="radioToggle(this)"> 2 </button>
					</div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 3 -->
					<button class="meterbutton" onClick="radioToggle(this)"> 3 </button>
					</div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 4 -->
					<button class="meterbutton" onClick="radioToggle(this)"> 4 </button>
					</div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 5 -->
					<button class="meterbutton" onClick="radioToggle(this)"> 5 </button>
					</div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 6 -->
					<button class="meterbutton" onClick="radioToggle(this)"> 6 <span class="footnote">or more</span> </button>
					</div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 6 
-->
						    <input type="hidden" name="TESTa" value="Test A">

						    <input type="hidden" name="TESTb" value="Test B">
<!--
        			<input class="meterbutton active" id="add" name="add" type="submit" value="Finish" />
-->
					</div>
     	 		</div>

     	 </div>
    </div><!-- carousel-inner -->
	 				</form>
	
<?php
$sql="UPDATE Household SET Rooms=$_GET[people] WHERE idHousehold=999";

if (!mysqli_query($db,$sql))
  {
  die('I am sorry - something went wrong. Please email philipp.grunewald@ouce.ox.ac.uk.  ' . mysqli_error($db));
  }
else
{
 // header( 'Location: #' ) ;
}
mysqli_close($db);
?>

         <a class="left carousel-control" href="#qSlider" data-slide="prev">
          &lsaquo;</a>
         <a class="right carousel-control" href="#qSlider" data-slide="next">
          &rsaquo;</a>
    </div><!-- image slider  -->

		<div class="col-xs-2 col-xs-pull-8 col-sm-3 col-sm-pull-6"  style="background-color: #00ffff; ">
			<!-- Left border - quarter -->
			</div>
		<div class="col-xs-3"  style="background-color: #00ffff; "> <!-- Right border - quarter -->
			</div>

		</div> <!-- row -->
	</div> <!-- CONTENT - row 1 -->

<!-- Bootstrap JS -->
	<!-- this is needed before the bootstrap.min.js -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- this one's not working ?!!  <script src="js/jquery.min.js"></script>  
	
				interval: 3000,
-->
	<!-- Latest compiled and minified JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<script>
		$('#qSlider').carousel({
				interval: false
		});
	</script> 
</body>
</html>
