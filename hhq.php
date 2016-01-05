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
			if ($_GET['people'] !== "xx") {
				$sql="UPDATE Household SET 
					page_number=$_GET[pn],
					people=$_GET[people],
					age_group1=$_GET[ag1],
					age_group1=$_GET[ag1],
					age_group2=$_GET[ag2],
					age_group3=$_GET[ag3],
					age_group4=$_GET[ag4],
					age_group5=$_GET[ag5],
					age_group6=$_GET[ag6],
					p6pm=$_GET[p6pm],
					rooms=$_GET[rms],
					own=$_GET[own],
					appliance1=$_GET[ap1],
					appliance1=$_GET[ap1],
					appliance2=$_GET[ap2],
					appliance3=$_GET[ap3],
					appliance4=$_GET[ap4],
					appliance5=$_GET[ap5],
					appliance6=$_GET[ap6],
					appliance7=$_GET[ap7],
					appliance8=$_GET[ap8],
					appliance_b1=$_GET[ab1],
					appliance_b1=$_GET[ab1],
					appliance_b2=$_GET[ab2],
					appliance_b3=$_GET[ab3],
					appliance_b4=$_GET[ab4],
					appliance_b5=$_GET[ab5],
					appliance_b6=$_GET[ab6],
					appliance_b7=$_GET[ab7],
					appliance_b8=$_GET[ab8],
					provider ='$_GET[pvd]',
					income=$_GET[inc]  WHERE idHousehold=999";
				mysqli_query($db, $sql);
			}
		}
		// 
					// pvd='$_GET[pvd]',
				// p6pm,
		$sql = "SELECT page_number,
				people,
				age_group1, age_group2, age_group3, age_group4, age_group5, age_group6,
				p6pm,
				rooms,
				appliance1, appliance1, appliance2, appliance3, appliance4, appliance5, appliance6, appliance7, appliance8,
				appliance_b1, appliance_b1, appliance_b2, appliance_b3, appliance_b4, appliance_b5, appliance_b6, appliance_b7, appliance_b8,
				income,
				provider,
				own,
				rooms  FROM Household WHERE idHousehold = 999";
		$result = mysqli_query($db, $sql);
		
		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
				$page_number = $row["page_number"];
				$people 	= $row["people"];
				$age_group1 = $row["age_group1"];
				$age_group2 = $row["age_group2"];
				$age_group3 = $row["age_group3"];
				$age_group4 = $row["age_group4"];
				$age_group5 = $row["age_group5"];
				$age_group6 = $row["age_group6"];
				$rooms 		= $row["rooms"];
				$appliance_b1 = $row["appliance_b1"];
				$appliance_b2 = $row["appliance_b2"];
				$appliance_b3 = $row["appliance_b3"];
				$appliance_b4 = $row["appliance_b4"];
				$appliance_b5 = $row["appliance_b5"];
				$appliance_b6 = $row["appliance_b6"];
				$appliance_b7 = $row["appliance_b7"];
				$appliance_b8 = $row["appliance_b8"];
				$appliance1 = $row["appliance1"];
				$appliance2 = $row["appliance2"];
				$appliance3 = $row["appliance3"];
				$appliance4 = $row["appliance4"];
				$appliance5 = $row["appliance5"];
				$appliance6 = $row["appliance6"];
				$appliance7 = $row["appliance7"];
				$appliance8 = $row["appliance8"];
				$income 	= $row["income"];
				$provider 		= $row["provider"];
				$own 		= $row["own"];
				$p6pm 		= $row["p6pm"];
		    }
		} else {
		    echo "0 results";
		}
		?>
<?php
		function toggleButton($label,$ID,$url) {
			$value = $_GET["$ID"];
			$active = "";
			$bg 	= '#eee';
			if ($value == 1) {
				$active = 'active';
				$bg = '#339933';
			} 
			return "
				<div class='col-xs-6 top-buffer'>
				<button class='meterbutton $active' 
					style=\"background: url('img/$url') $bg; background-size: 100%\" 
					id='$ID' value='$value' onClick='toggle(this)'>
				<span class='btnLabel-sm'>$label</span></br> 
				</button> </div>
				";
		}
		function radioButton($radioID,$ID,$label,$caption) {
			$value = $_GET["$ID"];
			$active = "";
			$size	= "";
			$bg 	= '#eee';
			if ($value == $radioID) {
				$active = 'active';
				$bg = '#339933';
			} 
			if (strlen($label) > 3) {
				$size = '-sm';
			}
			return "
				<div class='col-xs-6 top-buffer'>
				<button class='meterbutton $active'
					id='$ID' value='$value' onClick='radioToggle(this)'> 
					<span class='btnCaption'>$caption</span> </br>
					<span class='btnLabel$size'>$label</span>
					</button> </div>
					";
		}
?>
<script type="text/javascript">
	function backPage() {
		var page = document.getElementById('pn');
		var previousPage = document.getElementById('pp');
		var pageNumber = parseInt(page.value);
		previousPage.value = pageNumber;
		pageNumber -= 1;
		page.value = pageNumber;
		}

	function nextPage() {
		var page = document.getElementById('pn');
		var previousPage = document.getElementById('pp');
		var pageNumber = parseInt(page.value);
		previousPage.value = pageNumber;
		pageNumber += 1;
		page.value = pageNumber;
		}

	function radioToggle(thisButton) {
		//  the ID of the meterButton pressed identifies which "GET" value to set  
		// var thisValue = parseInt(thisButton.value);
		var thisValue = thisButton.value;
		var thisID = thisButton.getAttribute('id');
		var parameter = document.getElementById(thisID);
		parameter.value = thisValue;
		nextPage();
		}

	function toggle(thisButton) {
		//  the ID of the meterButton pressed identifies which "GET" value to set  
		var thisValue = parseInt(thisButton.value);
		var thisID = thisButton.getAttribute('id');
		var parameter = document.getElementById(thisID);
		if (thisValue == 1) {
				parameter.value = 0 ;
			} else {
				parameter.value = 1 ;
			}
		}

	function minusOne(thisID) {
		//  the ID of the meterButton pressed identifies which "GET" value to set  
		var parameter = document.getElementById(thisID);
		var thisValue = parameter.value;
		thisValue -= 1;
		parameter.value = thisValue;
		}
	function addOne(thisButton) {
		//  the ID of the meterButton pressed identifies which "GET" value to set  
		var thisValue = parseInt(thisButton.value);
		var thisID = thisButton.getAttribute('id');
		var parameter = document.getElementById(thisID);
		thisValue += 1;
		parameter.value = thisValue ;
		}
    </script>

<?php include("nav_bar.php"); ?>


<div class="container">		 <!-- CONTENT - row 1 -->
	</br> </br> </br> </br>
	<div class="row">

		<div class="col-xs-8 col-xs-push-2 col-sm-6 col-sm-push-3"  style="background-color: #ffffff; ">
			<!-- Central content - half -->

   <div id="qSlider" class="carousel slide">
    <ol class="carousel-indicators">
     <li data-target="#qSlider" data-slide-to="0" ></li>
     <li data-target="#qSlider" data-slide-to="1" ></li>
     <li data-target="#qSlider" data-slide-to="2" ></li>
     <li data-target="#qSlider" data-slide-to="3" ></li>
     <li data-target="#qSlider" data-slide-to="4" ></li>
     <li data-target="#qSlider" data-slide-to="5" ></li>
     <li data-target="#qSlider" data-slide-to="6" ></li>
    </ol>

<form method="get">
    <div class="carousel-inner">
		<!-- pass php variables to GET form elements -->
		<!-- stored previous page when advancing or moving back pages -->
		<input type="hidden" id="pp" name="pp" value="<?php echo $_GET['pp']; ?>">
		<input type="hidden" id="pn" name="pn" value="<?php echo $page_number; ?>">
		<input type="hidden" id="people" name="people" value="<?php echo $people; ?>">
		<input type="hidden" id="inc" name="inc" value="<?php echo $income; ?>">
		<input type="hidden" id="ag1" name="ag1" value="<?php echo $age_group1; ?>">
		<input type="hidden" id="ag2" name="ag2" value="<?php echo $age_group2; ?>">
		<input type="hidden" id="ag3" name="ag3" value="<?php echo $age_group3; ?>">
		<input type="hidden" id="ag4" name="ag4" value="<?php echo $age_group4; ?>">
		<input type="hidden" id="ag5" name="ag5" value="<?php echo $age_group5; ?>">
		<input type="hidden" id="ag6" name="ag6" value="<?php echo $age_group6; ?>">
		<input type="hidden" id="rms" name="rms" value="<?php echo $rooms; ?>">
		<input type="hidden" id="ab1" name="ab1" value="<?php echo $appliance_b1; ?>">
		<input type="hidden" id="ab2" name="ab2" value="<?php echo $appliance_b2; ?>">
		<input type="hidden" id="ab3" name="ab3" value="<?php echo $appliance_b3; ?>">
		<input type="hidden" id="ab4" name="ab4" value="<?php echo $appliance_b4; ?>">
		<input type="hidden" id="ab5" name="ab5" value="<?php echo $appliance_b5; ?>">
		<input type="hidden" id="ab6" name="ab6" value="<?php echo $appliance_b6; ?>">
		<input type="hidden" id="ab7" name="ab7" value="<?php echo $appliance_b7; ?>">
		<input type="hidden" id="ab8" name="ab8" value="<?php echo $appliance_b8; ?>">
		<input type="hidden" id="ap1" name="ap1" value="<?php echo $appliance1; ?>">
		<input type="hidden" id="ap2" name="ap2" value="<?php echo $appliance2; ?>">
		<input type="hidden" id="ap3" name="ap3" value="<?php echo $appliance3; ?>">
		<input type="hidden" id="ap4" name="ap4" value="<?php echo $appliance4; ?>">
		<input type="hidden" id="ap5" name="ap5" value="<?php echo $appliance5; ?>">
		<input type="hidden" id="ap6" name="ap6" value="<?php echo $appliance6; ?>">
		<input type="hidden" id="ap7" name="ap7" value="<?php echo $appliance7; ?>">
		<input type="hidden" id="ap8" name="ap8" value="<?php echo $appliance8; ?>">
		<input type="hidden" id="p6pm" name="p6pm" value="<?php echo $p6pm; ?>">
		<input type="hidden" id="pvd" name="pvd" value="<?php echo $provider; ?>">
		<input type="hidden" id="own" name="own" value="<?php echo $own; ?>">


	<div class="item <?php if ($_GET['pp'] == 0) {echo "active";}?>"> <!-- number of people -->
		<h2> How many people live in your home? </h2>
			<?php echo radioButton('1','people','1','just me'); ?>
			<?php echo radioButton('2','people','2','people'); ?>
			<?php echo radioButton('3','people','3','people'); ?>
			<?php echo radioButton('4','people','4','people'); ?>
			<?php echo radioButton('5','people','5','people'); ?>
			<?php echo radioButton('6','people','6','or morxxe'); ?>
		</div> <!--  item -->

	<div class="item <?php if ($_GET['pp'] == 1) {echo "active";}?>"> <!-- Age groups -->
		<h2><?php if ($people > 1) { echo "Which age groups do these $people people fall into? <small><br>Click once per person</small>";} else { echo "What are group are you?";} ?> </h2>
			<div class="row">
				<div class="col-xs-6 top-buffer"> <!-- Button 1 -->
					<button class="meterbutton <?php if ($age_group1 > 0) {echo "modified";} ?>" id="ag1" value="<?php echo $_GET['ag1']; ?>" onClick="addOne(this)"> 
					<span class="btnCaption">Under 8</span> </br>
					<span class="btnLabel"> <?php echo $_GET['ag1']; ?></span></br>
					<span class="btnCaption">people</span>
					<?php if ($_GET['ag1'] > 0) { echo '<button class="meterbutton minus" onClick="minusOne(\'ag1\')">-1</button>';} ?>
					</button> 
					</div>
				<div class="col-xs-6 top-buffer"> <!-- Button 2 -->
					<button class="meterbutton <?php if ($age_group2 > 0) {echo "modified";} ?>" id="ag2" value="<?php echo $_GET['ag2']; ?>" onClick="addOne(this)"> 
					<span class="btnCaption">Age 8 - 18</span> </br>
					<span class="btnLabel"> <?php echo $_GET['ag2']; ?></span></br>
					<span class="btnCaption">people</span> 
					<?php if ($_GET['ag2'] > 0) { echo '<button class="meterbutton minus" onClick="minusOne(\'ag2\')">-1</button>';} ?>
					</button> 
					</div>
			</div> <!--  row -->

			<div class="row">
				<div class="col-xs-6 top-buffer"> <!-- Button 3 -->
					<button class="meterbutton <?php if ($age_group3 > 0) {echo "modified";} ?>" id="ag3" value="<?php echo $_GET['ag3']; ?>" onClick="addOne(this)"> 
					<span class="btnCaption">Age 19 - 34</span></br>
					<span class="btnLabel"> <?php echo $_GET['ag3']; ?></span></br>
					<span class="btnCaption">people</span> 
					<?php if ($_GET['ag3'] > 0) { echo '<button class="meterbutton minus" onClick="minusOne(\'ag3\')">-1</button>';} ?>
					</button> 
					</div>
	
				<div class="col-xs-6 top-buffer"> <!-- Button 4 -->
					<button class="meterbutton <?php if ($age_group4 > 0) {echo "modified";} ?>" id="ag4" value="<?php echo $_GET['ag4']; ?>" onClick="addOne(this)"> 
					<span class="btnCaption">Age 35 - 50</span></br>
					<span class="btnLabel"> <?php echo $_GET['ag4']; ?></span></br>
					<span class="btnCaption">people</span> 
					<?php if ($_GET['ag4'] > 0) { echo '<button class="meterbutton minus" onClick="minusOne(\'ag4\')">-1</button> ';} ?>
					</button> 
					</div>
			</div> <!--  row -->
	
			<div class="row">
				<div class="col-xs-6 top-buffer"> <!-- Button 5 -->
					<button class="meterbutton <?php if ($age_group5 > 0) {echo "modified";} ?>" id="ag5" value="<?php echo $_GET['ag5']; ?>" onClick="addOne(this)"> 
					<span class="btnCaption">Age 51-70</span></br>
					<span class="btnLabel"> <?php echo $_GET['ag5']; ?></span></br>
					<span class="btnCaption">people</span> 
					<?php if ($_GET['ag5'] > 0) { echo '<button class="meterbutton minus" onClick="minusOne(\'ag5\')">-1</button>';} ?>
					</button> 
					</div>
	
				<div class="col-xs-6 top-buffer">
				<!-- Button 6 -->
					<button class="meterbutton <?php if ($age_group6 > 0) {echo "modified";} ?>" id="ag6" value="<?php echo $_GET['ag6']; ?>" onClick="addOne(this)">
					<span class="btnCaption top">Over 70</span></br>
					<span class="btnLabel"><?php echo $_GET['ag6']; ?></span></br>
					<span class="btnCaption">people</span> 
					<?php if ($_GET['ag6'] > 0) { echo '<button class="meterbutton minus" onClick="minusOne(\'ag6\')">-1</button> </br>';} ?>
					</button> 
					</div>
			</div> <!--  row -->

			<div class="row">
				<div class="col-xs-6 top-buffer"> <!-- Prev -->
					<button class="meterbutton previous" onClick="backPage()">  Back </button>
					</div>

				<div class="col-xs-6 top-buffer"> <!-- Next -->
					<button class="meterbutton next" onClick="nextPage()"> Next > </button>
					</div>
			</div> <!--  row  -->
		</div> <!--  item -->

	<div class="item <?php if ($_GET['pp'] == 2) {echo "active";}?>"> <!-- occupancy at 6pm -->
		<h2>On a typical weekday, how many people are at home around 6pm?<small></br>This can include visitors.</small> </h2>
			<div class="col-xs-6 top-buffer">
				<button class="meterbutton <?php if ($p6pm == 0) {echo "active";} ?> " id="p6pm" value="0" onClick="radioToggle(this)"> 
				<span class="btnLabel">0</span>
				<span class="btnCaption"></br>No one</span></button>
				</div>
			<div class="col-xs-6 top-buffer">
				<button class="meterbutton <?php if ($p6pm == 1) {echo "active";} ?> " id="p6pm" value="1" onClick="radioToggle(this)"> 
				<span class="btnLabel">1</span>
				<span class="btnCaption"></br>person</span></button>
				</div>
			<div class="col-xs-6 top-buffer">
				<button class="meterbutton <?php if ($p6pm == 2) {echo "active";} ?> " id="p6pm" value="2" onClick="radioToggle(this)"> 
				<span class="btnLabel">2</span>
				<span class="btnCaption"></br>people</span></button>
				</div>
			<div class="col-xs-6 top-buffer">
				<button class="meterbutton <?php if ($p6pm == 3) {echo "active";} ?> " id="p6pm" value="3" onClick="radioToggle(this)"> 
				<span class="btnLabel">3</span>
				<span class="btnCaption"></br>people</span></button>
				</div>
			<div class="col-xs-6 top-buffer">
				<button class="meterbutton <?php if ($p6pm == 4) {echo "active";} ?> " id="p6pm" value="4" onClick="radioToggle(this)"> 
				<span class="btnLabel">4</span>
				<span class="btnCaption"></br>people</span></button>
				</div>
			<div class="col-xs-6 top-buffer">
				<button class="meterbutton <?php if ($p6pm == 5) {echo "active";} ?> " id="p6pm" value="5" onClick="radioToggle(this)"> 
				<span class="btnLabel">5</span>
				<span class="btnCaption"></br>or more</span></button>
				</div>
		</div> <!--  item -->

	<div class="item <?php if ($_GET['pp'] == 3) {echo "active";}?>"> <!-- Rooms -->
		<h2>How many rooms are in your home?<small></br>Not counting kitchens and bathroom(s)</small> </h2>
			<div class="col-xs-6 top-buffer">
			<!-- Button 1 -->
				<button class="meterbutton <?php if ($rooms == 1) {echo "active";} ?>" id="rms" value="1" onClick="radioToggle(this)"> 
				<span class="btnLabel">1</span>
				<span class="btnCaption"></br>room</span></button>
				</div>
			<div class="col-xs-6 top-buffer">
			<!-- Button 2 -->
				<button class="meterbutton <?php if ($rooms == 2) {echo "active";} ?>" id="rms" value="2" onClick="radioToggle(this)"> 
				<span class="btnLabel">2</span>
				<span class="btnCaption"></br>rooms</span></button>
				</div>
			<div class="col-xs-6 top-buffer">
			<!-- Button 3 -->
				<button class="meterbutton <?php if ($rooms == 3) {echo "active";} ?>" id="rms" value="3" onClick="radioToggle(this)"> 
				<span class="btnLabel">3</span>
				<span class="btnCaption"></br>rooms</span></button>
				</div>
			<div class="col-xs-6 top-buffer">
			<!-- Button 4 -->
				<button class="meterbutton <?php if ($rooms == 4) {echo "active";} ?>" id="rms" value="4" onClick="radioToggle(this)"> 
				<span class="btnLabel">4</span>
				<span class="btnCaption"></br>rooms</span></button>
				</div>
			<div class="col-xs-6 top-buffer">
			<!-- Button 5 -->
				<button class="meterbutton <?php if ($rooms == 5) {echo "active";} ?>" id="rms" value="5" onClick="radioToggle(this)"> 
				<span class="btnLabel">5</span>
				<span class="btnCaption"></br>rooms</span></button>
				</div>
			<div class="col-xs-6 top-buffer">
			<!-- Button 6 -->
				<button class="meterbutton <?php if ($rooms == 6) {echo "active";} ?>" id="rms" value="6" onClick="radioToggle(this)"> 
				<span class="btnLabel">6</span>
				<span class="btnCaption"></br>or more</span></button>
				</div>
     	 	</div>

	<div class="item <?php if ($_GET['pp'] == 4) {echo "active";}?>"> <!-- ownership -->
		<h2>Do you own or rent your property?</h2>
			<div class="col-xs-7 top-buffer">
				<button class="meterbutton <?php if ($own == 1) {echo "active";} ?> " id="own" value="1" onClick="radioToggle(this)"> 
				<span class="btnLabel-sm">Own</span>
				<span class="btnCaption"></br>With or without mortgage</span></button>
				</div>
			<div class="col-xs-7 top-buffer">
				<button class="meterbutton <?php if ($own == 2) {echo "active";} ?> " id="own" value="2" onClick="radioToggle(this)"> 
				<span class="btnLabel-sm">Rent</span>
				<span class="btnCaption"></br>Private landlord</span></button>
				</div>
			<div class="col-xs-7 top-buffer">
				<button class="meterbutton <?php if ($own == 3) {echo "active";} ?> " id="own" value="3" onClick="radioToggle(this)"> 
				<span class="btnLabel-sm">Rent</span>
				<span class="btnCaption"></br>Social landlord</span></button>
				</div>
		</div> <!--  item -->

	<div class="item <?php if ($_GET['pp'] == 5) {echo "active";}?>"> <!-- El. provider -->
		<h2>Who provides your electricity? <?php echo $provider; echo "and " . $pvd . " jo"; ?> xx</h2>
			<div class="col-xs-6 col-md-4 top-buffer">
				<button class="meterbutton <?php if ($provider == "bg") {echo "active";} ?> " id="pvd" value="bg" id="pvd" onClick="radioToggle(this)"> 
				<img src="img/bg.png" class="img-responsive" alt="British Gas">
				</button>
				</div>
			<div class="col-xs-6 col-md-4 top-buffer">
				<button class="meterbutton <?php if ($provider == "eco") {echo "active";} ?> " id="pvd" value="eco" id="pvd" onClick="radioToggle(this)"> 
				<img src="img/eco.png" class="img-responsive" alt="Ecotricity">
				</button>
				</div>
			<div class="col-xs-6 col-md-4 top-buffer">
				<button class="meterbutton <?php if ($provider == "edf") {echo "active";} ?> " id="pvd" value="edf" id="pvd" onClick="radioToggle(this)"> 
				<img src="img/edf.png" class="img-responsive" alt="EDF">
				</button>
				</div>
			<div class="col-xs-6 col-md-4 top-buffer">
				<button class="meterbutton <?php if ($provider == "eon") {echo "active";} ?> " id="pvd" value="eon" id="pvd" onClick="radioToggle(this)"> 
				<img src="img/eon.png" class="img-responsive" alt="e-On">
				</button>
				</div>
			<div class="col-xs-6 col-md-4 top-buffer">
				<button class="meterbutton <?php if ($provider == 'coop') {echo "active";} ?> " id="pvd" value="coop" id="pvd" onClick="radioToggle(this)"> 
				<img src="img/coop.png" class="img-responsive" alt="The co-operative">
				</button>
				</div>
			<div class="col-xs-6 col-md-4 top-buffer">
				<button class="meterbutton <?php if ($provider == "good") {echo "active";} ?> " id="pvd" value="good" id="pvd" onClick="radioToggle(this)"> 
				<img src="img/good.png" class="img-responsive" alt="Good Energy">
				</button>
				</div>
			<div class="col-xs-6 col-md-4 top-buffer">
				<button class="meterbutton <?php if ($provider == "npower") {echo "active";} ?> " id="pvd" value="npower" id="pvd" onClick="radioToggle(this)"> 
				<img src="img/npower.png" class="img-responsive" alt="nPower">
				</button>
				</div>
			<div class="col-xs-6 col-md-4 top-buffer">
				<button class="meterbutton <?php if ($provider == "sp") {echo "active";} ?> " id="pvd" value="sp" id="pvd" onClick="radioToggle(this)"> 
				<img src="img/sp.png" class="img-responsive" alt="Scottish Power">
				</button>
				</div>
			<div class="col-xs-6 col-md-4 top-buffer">
				<button class="meterbutton <?php if ($provider == "sse") {echo "active";} ?> " id="pvd" value="sse" id="pvd" onClick="radioToggle(this)"> 
				<img src="img/sse.png" class="img-responsive" alt="SSE">
				</button>
				</div>
			<div class="col-xs-6 col-md-4 top-buffer">
				<button class="meterbutton <?php if ($provider == "oth") {echo "active";} ?> " id="pvd" value="oth" id="pvd" onClick="radioToggle(this)"> 
				<span class="btnLabel-sm">Other</span>
				</button>
				</div>
		</div> <!--  item -->

	<div class="item <?php if ($_GET['pp'] == 4) {echo "active";}?>"> <!-- Appliance count -->
		<h2>Do you have any of these items?
			<small>If so, click to say how many. Only count things you actually used in the last year.</small></h2>
			<div class="row">
				<div class="col-xs-6 top-buffer">
					<button class="meterbutton <?php if ($appliance1 > 0) {echo "modified";} ?>" style="background: #eee url('img/pv.png'); background-size: 100%" id="ap1" value="<?php echo $_GET['ap1']; ?>" onClick="addOne(this)"> 
					<span class="btnCaption">PV panels</span> </br>
					<span class="btnLabel"> <?php echo $_GET['ap1']; ?></span></br>
					<span class="btnCaption">number of panels</span>
					<?php if ($_GET['ap1'] > 0) { echo '<button class="meterbutton minus" onClick="minusOne(\'ap1\')">-1</button>';} ?>
					</button> 
					</div>
				<div class="col-xs-6 top-buffer">
					<button class="meterbutton <?php if ($appliance2 > 0) {echo "modified";} ?>" style="background: #eee url('img/dehumidifier.png'); background-size: 100%" id="ap2" value="<?php echo $_GET['ap2']; ?>" onClick="addOne(this)"> 
					<span class="btnCaption">Dehumidifier</span> </br>
					<span class="btnLabel"> <?php echo $_GET['ap2']; ?></span></br>
					<span class="btnCaption">number of</span>
					<?php if ($_GET['ap2'] > 0) { echo '<button class="meterbutton minus" onClick="minusOne(\'ap2\')">-1</button>';} ?>
					</button> 
					</div>
			</div> <!--  row -->
			<div class="row">
				<div class="col-xs-6 top-buffer"> 
					<button class="meterbutton <?php if ($appliance3 > 0) {echo "modified";} ?>" style="background: #eee url('img/ac_unit.png'); background-size: 100%" id="ap3" value="<?php echo $_GET['ap3']; ?>" onClick="addOne(this)"> 
					<span class="btnCaption">Air conditioner</span> </br>
					<span class="btnLabel"> <?php echo $_GET['ap3']; ?></span></br>
					<span class="btnCaption">number of units</span>
					<?php if ($_GET['ap3'] > 0) { echo '<button class="meterbutton minus" onClick="minusOne(\'ap3\')">-1</button>';} ?>
					</button> 
					</div>
				<div class="col-xs-6 top-buffer"> 
					<button class="meterbutton <?php if ($appliance4 > 0) {echo "modified";} ?>" style="background: #eee url('img/dryer.png'); background-size: 100%" id="ap4" value="<?php echo $_GET['ap4']; ?>" onClick="addOne(this)"> 
					<span class="btnCaption">Tumble dryer</span> </br>
					<span class="btnLabel"> <?php echo $_GET['ap4']; ?></span></br>
					<span class="btnCaption">number of</span>
					<?php if ($_GET['ap4'] > 0) { echo '<button class="meterbutton minus" onClick="minusOne(\'ap4\')">-1</button>';} ?>
					</button> 
					</div>
			</div> <!--  row -->
			<div class="row">
				<div class="col-xs-6 top-buffer"> <!-- Button 1 -->
					<button class="meterbutton <?php if ($appliance5 > 0) {echo "modified";} ?>" style="background: #eee url('img/power_shower.png'); background-size: 100%" id="ap5" value="<?php echo $_GET['ap5']; ?>" onClick="addOne(this)"> 
					<span class="btnCaption">Power shower</span> </br>
					<span class="btnLabel"> <?php echo $_GET['ap5']; ?></span></br>
					<span class="btnCaption">number</span>
					<?php if ($_GET['ap5'] > 0) { echo '<button class="meterbutton minus" onClick="minusOne(\'ap5\')">-1</button>';} ?>
					</button> 
					</div>
				<div class="col-xs-6 top-buffer"> <!-- Button 1 -->
					<button class="meterbutton <?php if ($appliance6 > 0) {echo "modified";} ?>" style="background: #eee url('img/fish_tank.png'); background-size: 100%" id="ap6" value="<?php echo $_GET['ap6']; ?>" onClick="addOne(this)"> 
					<span class="btnCaption">Fish tanks</span> </br>
					<span class="btnLabel"> <?php echo $_GET['ap6']; ?></span></br>
					<span class="btnCaption">number of</span>
					<?php if ($_GET['ap6'] > 0) { echo '<button class="meterbutton minus" onClick="minusOne(\'ap6\')">-1</button>';} ?>
					</button> 
					</div>
			</div> <!--  row -->
			<div class="row">
				<div class="col-xs-6 top-buffer"> <!-- Button 1 -->
					<button class="meterbutton <?php if ($appliance7 > 0) {echo "modified";} ?>" style="background: #eee url('img/fan_heater.png'); background-size: 100%" id="ap7" value="<?php echo $_GET['ap7']; ?>" onClick="addOne(this)"> 
					<span class="btnCaption">Fan heaters</span> </br>
					<span class="btnLabel"> <?php echo $_GET['ap7']; ?></span></br>
					<span class="btnCaption">number of</span>
					<?php if ($_GET['ap7'] > 0) { echo '<button class="meterbutton minus" onClick="minusOne(\'ap7\')">-1</button>';} ?>
					</button> 
					</div>
				<div class="col-xs-6 top-buffer"> <!-- Button 1 -->
					<button class="meterbutton <?php if ($appliance8 > 0) {echo "modified";} ?>" style="background: #eee url('img/el_fire.png'); background-size: 100%" id="ap8" value="<?php echo $_GET['ap8']; ?>" onClick="addOne(this)"> 
					<span class="btnCaption">Electric fire</span> </br>
					<span class="btnLabel"> <?php echo $_GET['ap8']; ?></span></br>
					<span class="btnCaption">number of</span>
					<?php if ($_GET['ap8'] > 0) { echo '<button class="meterbutton minus" onClick="minusOne(\'ap8\')">-1</button>';} ?>
					</button> 
					</div>
			</div> <!--  row -->


			<div class="row">
				<div class="col-xs-6 top-buffer"> <!-- Prev -->
					<button class="meterbutton previous" onClick="backPage()">  Back </button>
					</div>

				<div class="col-xs-6 top-buffer"> <!-- Next -->
					<button class="meterbutton next" onClick="nextPage()"> Next > </button>
					</div>
			</div> <!--  row  -->
		</div> <!--  item -->


	<div class="item <?php if ($_GET['pp'] == 6) {echo "active";}?>"> <!-- Appliance toggle -->
		<div class="item"> <!-- appliances -->
		<h2>Which of these items do you have?</h2>
			<small>Click any that items you have in the house.</small> </br>
				<?php echo toggleButton("Tumble dryer", "ab1", "dryer.png"); ?>
				<?php echo toggleButton("Air conditioning", "ab2", "ac_unit.png"); ?>
				<?php echo toggleButton("Under floor heating", "ab3", "ufh.png"); ?>
				<?php echo toggleButton("Gas boiler", "ab4", "boiler.png"); ?>
				<?php echo toggleButton("Heat pump", "ab5", "heat_pump.png"); ?>
				<?php echo toggleButton("Electric hob", "ba6", "hob.png"); ?>
				<?php echo toggleButton("Fish tank", "ab7", "fish_tank.png"); ?>
				<!-- 
				<?php echo toggleButton("<++>", "<++>", "<++>.png"); ?>
 				-->
				<div class="col-xs-6 top-buffer">
				<!-- Prev -->
					<button class="meterbutton previous" onClick="backPage()"> < Back </button>
					</div>
				<div class="col-xs-6 top-buffer">
				<!-- Next -->
					<button class="meterbutton next" onClick="nextPage()"> Next > </button>
				</div>
			</div> <!--  class item-->



	<div class="item <?php if ($_GET['pp'] == 3) {echo "active";}?>"> <!-- Income -->
		<h2>What is your annual household income?</h2>
			<small>Before any deductions for tax of national insurance</small> </br>
			<div class="col-xs-6 top-buffer">
				<!-- Button 1 -->
				<button class="meterbutton <?php if ($income == 1) {echo "active";} ?>" id="inc" value='1' onClick="radioToggle(this)"> 
					<span class="btnCaption">less than</span> </br>
					<span class="btnLabel-sm">15,000</span> </button> </div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 2 -->
					<button class="meterbutton <?php if ($income == 2) {echo "active";} ?>" id="inc" value='2' onClick="radioToggle(this)"> 
					<span class="btnCaption">up to</span> </br>
					<span class="btnLabel-sm">25,000</span> </button> </div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 3 -->
					<button class="meterbutton <?php if ($income == 3) {echo "active";} ?>" id="inc" value='3' onClick="radioToggle(this)"> 
					<span class="btnCaption">up to</span> </br>
					<span class="btnLabel-sm">35,000</span> </button> </div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 4 -->
					<button class="meterbutton <?php if ($income == 4) {echo "active";} ?>" id="inc" value='4' onClick="radioToggle(this)"> 
					<span class="btnCaption">up to</span> </br>
					<span class="btnLabel-sm">50,000</span> </button> </div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 5 -->
					<button class="meterbutton <?php if ($income == 5) {echo "active";} ?>" id="inc" value='5' onClick="radioToggle(this)"> 
					<span class="btnCaption">up to</span> </br>
					<span class="btnLabel-sm">75,000</span> </button> </div>
				<div class="col-xs-6 top-buffer">
				<!-- Button 6 -->
					<button class="meterbutton <?php if ($income == 6) {echo "active";} ?>" id="inc" value='6' onClick="radioToggle(this)"> 
					<span class="btnCaption">more than</span> </br>
					<span class="btnLabel-sm">75,000</span> </button> </div>

				<div class="col-xs-6 top-buffer">
				<!-- Prev -->
					<button class="meterbutton previous" onClick="backPage()"> < Back </button>
					</div>
				<div class="col-xs-6 top-buffer">
				<!-- Next -->
					<button class="meterbutton next" onClick="nextPage()"> Next > </button>
				</div>
			</div> <!--  class item  -->

    </div><!-- carousel-inner -->
</form>

    </div><!-- image slider  -->
	</div> <!--  middle column -->
	<div class="col-xs-2 col-xs-pull-8 col-sm-3 col-sm-pull-6"  style="background-color: #00ffff; "> <!-- Left border - quarter -->
		</div>
	<div class="col-xs-3"  style="background-color: #00ffff; "> <!-- Right border - quarter -->
		</div>
	</div> <!-- row -->
</div> <!-- CONTENT - row 1 -->

<!-- Bootstrap JS -->
	<!-- this is needed before the bootstrap.min.js -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<script>
		$('#qSlider').carousel({
				interval: false
		});
		$('#qSlider').carousel(<?php echo $_GET['pp']; ?>);
		window.setTimeout(slideToNewPage,500);
		
	function slideToNewPage() {
		$('#qSlider').carousel(<?php echo $page_number; ?>);
		var previousPage = document.getElementById('pp');
		previousPage.value = <?php echo $page_number; ?>;
		  }
	</script> 
</body>
</html>
