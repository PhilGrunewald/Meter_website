<!DOCTYPE HTML>
<!--
 consider including:
- pets
- type of house?
- have you undertaking particular efficiency measures
	- low energy lighting
	- double / triple galsing
	- draft proofing
	- in home display
- how confident are you about the bill
	- I took it from the bill
	- it was a guess
-	- might be out by £100
	- might be out by more
- Any comments / other appliances
 -->
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
				Contact_idContact,
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
				$ContactID	= $row["Contact_idContact"];
		    }
		} else {
		    echo "0 results";
		}
		$sql = "SELECT Name, Surname, email, Address1, Address2, Postcode From Contact WHERE idContact = $ContactID";
		$result = mysqli_query($db, $sql);
		if (mysqli_num_rows($result) > 0) {
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
				$name 		= $row["Name"];
				$surname 	= $row["Surname"];
				$email 		= $row["email"];
				$Address1	= $row["Address1"];
				$Address2	= $row["Address2"];
				$Postcode	= $row["Postcode"];
			}
		}
		if ($_GET[address1] !== "") { 
			$sql="UPDATE Contact SET Address1 = '$_GET[address1]' WHERE idContact = $ContactID";
			mysqli_query($db, $sql);
			}
		if ($_GET[address2] !== "") { 
			$sql="UPDATE Contact SET Address2 = '$_GET[address2]' WHERE idContact = $ContactID";
			mysqli_query($db, $sql);
			}
		if ($_GET[post_code] !== "") { 
			$sql="UPDATE Contact SET Postcode = '$_GET[post_code]' WHERE idContact = $ContactID";
			mysqli_query($db, $sql);
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
			$cols	= "";
			$bg 	= '#eee';
			if ($value == $radioID) {
				$active = 'active';
				$bg = '#339933';
			} 
			if (strlen($label) > 4) {
				$size = '-sm';
			}
			if (substr($caption, -4) === ".png") {
				$cols = "col-md-4";
			 $body = "
				<img src='img/$caption' class='img-responsive' alt='$label'>
					";
			} else {
			 $body = "
					<span class='btnLabel$size'>$label</span>
					</br>
					<span class='btnCaption'>$caption</span> 
					";
			}
			return "
				<div class='col-xs-6 $cols  top-buffer'>
				<button class='meterbutton $active'
					id='$ID' value='$radioID' onClick='radioToggle(this)'> 
					$body
					</button> </div>
					";
		}
		function countButton($ID,$label,$caption) {
			$value = $_GET["$ID"];
			$active = "";
			$minusButton = "";
			if ($value > 0) {
				$active = 'modified';
				$minusButton = "<button class='meterbutton minus' onClick='minusOne(\"$ID\")'>-1</button>";
			} 

			return "
				<div class='col-xs-6 top-buffer'>
					<button class='meterbutton $active'
						id='$ID' value='$value' onClick='addOne(this)'> 
					<span class='btnCaption'>$label</span> </br>
					<span class='btnLabel'>$value</span></br>
					<span class='btnCaption'>$caption</span>
					$minusButton
					</button> 
					</div>
					";
		}

		function navButton($type){
			return "<div class='col-xs-6 top-buffer'> 
				<button class='meterbutton next' onClick='$type()'>
				<img src='img/$type.png' class='img-responsive' alt='$type'>
				</button>
				</div>";
		}
?>
<script type="text/javascript">
	function back() {
		var page = document.getElementById('pn');
		var previousPage = document.getElementById('pp');
		var pageNumber = parseInt(page.value);
		previousPage.value = pageNumber;
		pageNumber -= 1;
		page.value = pageNumber;
		}

	function yes() {
		next();
	}
	function next() {
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
		next();
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

<?php //include("nav_bar.php"); ?>
<!--
  -->


<div class="container">		 <!-- CONTENT - row 1 -->
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
     <li data-target="#qSlider" data-slide-to="7" ></li>
     <li data-target="#qSlider" data-slide-to="8" ></li>
     <li data-target="#qSlider" data-slide-to="9" ></li>
     <li data-target="#qSlider" data-slide-to="10" ></li>
     <li data-target="#qSlider" data-slide-to="11" ></li>
     <li data-target="#qSlider" data-slide-to="12" ></li>
     <li data-target="#qSlider" data-slide-to="13" ></li>
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
		<input type="hidden" id="monthly" name="monthly">

	<div class="item <?php if ($_GET['pp'] == 0) {echo "active";}?>"> <!-- number of people -->
		<h2> Dear <?php echo $name; echo " ". $surname; ?> </h2>
		<p>Thank you for taking part in this research with the University of Oxford.</p>
		<p> Before we can send you your kit, please answer a few simple questions. This should take no more than 3 minutes.</p>
		<p>First, can you confirm that these are the correct contact details for you?</p>
		<h3>Email: <?php echo $email; ?> </h3>
		<?php echo navButton('no'); ?>
		<?php echo navButton('yes'); ?>
		</div> <!--  item -->

	<div class="item <?php if ($_GET['pp'] == 1) {echo "active";}?>"> <!-- number of people -->
		<h2>What is your address?<small></br>This is where we will send your pack.</small></h2> </br>
		<div class="form-group">
			<label for="address1">Address</label>
			<input class="form-control" style="width: 80%" id="address1" name="address1" type="text" placeholder="<?php echo $Address1;?>"> </br>
			<input class="form-control" style="width: 80%" id="address2" name="address2" type="text" placeholder="<?php echo $Address2;?>"> </br>
			<label for="post_code">Post code</label>
			<input class="form-control" style="width: 90px" id="post_code" name="post_code" type="text" placeholder="<?php echo $Postcode;?>">
		</div>
		<div class="col-xs-6 top-buffer">
		</div> 
		<?php echo navButton('next'); ?>
	</div>

	<div class="item <?php if ($_GET['pp'] == 2) {echo "active";}?>"> <!-- number of people -->
		<h2> How many people live at this address? </h2>
			<?php echo radioButton('1','people','1','just me'); ?>
			<?php echo radioButton('2','people','2','people'); ?>
			<?php echo radioButton('3','people','3','people'); ?>
			<?php echo radioButton('4','people','4','people'); ?>
			<?php echo radioButton('5','people','5','people'); ?>
			<?php echo radioButton('6','people','6','or more'); ?>
		</div> <!--  item -->

	<div class="item <?php if ($_GET['pp'] == 3) {echo "active";}?>"> <!-- Age groups -->
		<h2><?php if ($people > 1) { echo "Which age groups do these $people people fall into? <small><br>Click once per person</small>";} else { echo "What are group are you?";} ?> </h2>
			<?php echo countButton('ag1','Under 8x','people'); ?>
			<?php echo countButton('ag2','Age 8 - 18','people'); ?>
			<?php echo countButton('ag3','Age 19 - 34','people'); ?>
			<?php echo countButton('ag4','Age 35 - 50','people'); ?>
			<?php echo countButton('ag5','Age 51 - 70','people'); ?>
			<?php echo countButton('ag6','Over 70','people'); ?>
			<?php echo navButton('back'); ?>
			<?php echo navButton('next'); ?>
		</div> <!--  item -->

	<div class="item <?php if ($_GET['pp'] == 4) {echo "active";}?>"> <!-- occupancy at 6pm -->
		<h2>On a typical weekday, how many people are at home around 6pm?<small></br>This can include visitors.</small> </h2>
			<?php echo radioButton('0','p6pm','0','Nobody'); ?>
			<?php echo radioButton('1','p6pm','1','person'); ?>
			<?php echo radioButton('2','p6pm','2','people'); ?>
			<?php echo radioButton('3','p6pm','3','people'); ?>
			<?php echo radioButton('4','p6pm','4','people'); ?>
			<?php echo radioButton('5','p6pm','5','or more'); ?>
		</div> <!--  item -->

	<div class="item <?php if ($_GET['pp'] == 5) {echo "active";}?>"> <!-- Rooms -->
		<h2>How many rooms are in your home?<small></br>Not counting kitchens and bathroom(s)</small> </h2>
			<?php echo radioButton('1','rms','1','room'); ?>
			<?php echo radioButton('2','rms','2','rooms'); ?>
			<?php echo radioButton('3','rms','3','rooms'); ?>
			<?php echo radioButton('4','rms','4','rooms'); ?>
			<?php echo radioButton('5','rms','5','rooms'); ?>
			<?php echo radioButton('6','rms','6','or more'); ?>
     	 	</div>

	<div class="item <?php if ($_GET['pp'] == 6) {echo "active";}?>"> <!-- ownership -->
		<h2>Do you own or rent your property?</h2>
			<div class="row"> <div class="col-xs-3 top-buffer">  </div>
			<?php echo radioButton('1','own','Own','With or without a mortgage'); ?>
			</div> <div class="row"> <div class="col-xs-3 top-buffer">  </div>
			<?php echo radioButton('2','own','Rent','Social landlord'); ?>
			</div> <div class="row"> <div class="col-xs-3 top-buffer">  </div>
			<?php echo radioButton('3','own','Rent','Private landlord'); ?>
			</div>
		</div> <!--  item -->


	<div class="item <?php if ($_GET['pp'] == 7) {echo "active";}?>"> <!-- Appliance toggle -->
		<h2>Which of these items do you have?</h2>
			<small>Click any that items you have in the house.</small> </br>
				<?php echo toggleButton("Tumble dryer", "ab1", "dryer.png"); ?>
				<?php echo toggleButton("Air conditioning", "ab2", "ac_unit.png"); ?>
				<?php echo toggleButton("Under floor heating", "ab3", "ufh.png"); ?>
				<?php echo toggleButton("Gas boiler", "ab4", "boiler.png"); ?>
				<?php echo toggleButton("Heat pump", "ab5", "heat_pump.png"); ?>
				<?php echo toggleButton("Electric hob", "ba6", "hob.png"); ?>
				<?php echo toggleButton("Fish tank", "ab7", "fish_tank.png"); ?>
				<?php echo toggleButton("Hedge trimmer", "ab7", "fish_tank.png"); ?>
				<?php echo navButton('back'); ?>
				<?php echo navButton('next'); ?>
			</div> <!--  class item-->

	<div class="item <?php if ($_GET['pp'] == 8) {echo "active";}?>"> <!-- Appliance count -->
		<h2>Do you have any of these items?
			<small>If so, click to say how many. Only count things you actually used in the last year.</small></h2>
			<div class="row">
				<div class="col-xs-6 top-buffer">
					<button class="meterbutton <?php if ($appliance1 > 0) {echo "modified";} ?>" style="background: #eee url('img/pv.png'); background-size: 100%" id="ap1" value="<?php echo $_GET['ap1']; ?>" onClick="addOne(this)"> 
					<span class="btnCaption">PV panels</span> </br>
					<span class="btnLabel"> <?php echo $_GET['ap1']; ?></span></br>
					<span class="btnCaption">number of panels</span>
					<?php if ($_GET['ap1'] > 0) { echo '<button class="meterbutton minus" onClick="minusOne(\'ap1\')">
					<img src="img/minus.png" class="img-responsive" alt="-1">
					</button>';} ?>
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
				<?php echo navButton('back'); ?>
				<?php echo navButton('next'); ?>
			</div> <!--  row  -->
		</div> <!--  item -->

	<div class="item <?php if ($_GET['pp'] == 9) {echo "active";}?>"> <!-- El. provider -->
		<h2>Who provides your electricity?</h2>
			<?php echo radioButton('bg' ,'pvd','British Gas','bg.png'); ?>
			<?php echo radioButton('eco','pvd','Ecotricity','eco.png'); ?>
			<?php echo radioButton('edf','pvd','EDF','edf.png'); ?>
			<?php echo radioButton('eon','pvd','e-On','eon.png'); ?>
			<?php echo radioButton('coop','pvd','The co-operative','coop.png'); ?>
			<?php echo radioButton('good','pvd','Good Energy','good.png'); ?>
			<?php echo radioButton('npower','pvd','nPower','npower.png'); ?>
			<?php echo radioButton('sp','pvd','Scottish Power','sp.png'); ?>
			<?php echo radioButton('sse','pvd','SSE','sse.png'); ?>
			<?php echo radioButton('oth','pvd','Other','not listed'); ?>
		</div> <!--  item -->

	<div class="item <?php if ($_GET['pp'] == 10) {echo "active";}?>"> <!-- Tariff -->
		<h2>Which of these best describes your electricity tariff?<small></br>Just pick one</small> </h2>
			<?php echo radioButton('1','trf','Standard','flat rate'); ?>
			<?php echo radioButton('2','trf','Green','low carbon'); ?>
			<?php echo radioButton('3','trf','Economy 7','low at night'); ?>
			<?php echo radioButton('4','trf','Economy 10','10h low cost'); ?>
			<?php echo radioButton('5','trf','Don\'t know','or not sure'); ?>
			<?php echo radioButton('6','trf','Other','not listed here'); ?>
		 	</div>

	<div class="item <?php if ($_GET['pp'] == 11) {echo "active";}?>"> <!-- Bill -->
		<h2>How much do you spend on electricity per year?<small></br>If you prefer to answer per month, click below.</small> </h2>
			<?php $bill = '£300'; if($_GET['monthly'] > 0) {$bill = '£25';} echo radioButton('1','bl',$bill,'or less'); ?>
			<?php $bill = '£400'; if($_GET['monthly'] > 0) {$bill = '£33';} echo radioButton('1','bl',$bill,'up to'); ?>
			<?php $bill = '£550'; if($_GET['monthly'] > 0) {$bill = '£46';} echo radioButton('1','bl',$bill,'up to'); ?>
			<?php $bill = '£700'; if($_GET['monthly'] > 0) {$bill = '£58';} echo radioButton('1','bl',$bill,'up to'); ?>
			<?php $bill = '£850'; if($_GET['monthly'] > 0) {$bill = '£71';} echo radioButton('1','bl',$bill,'up to'); ?>
			<?php $bill = '£850'; if($_GET['monthly'] > 0) {$bill = '£71';} echo radioButton('1','bl',$bill,'or more'); ?>
			<?php $bill = 'monthly'; if($_GET['monthly'] > 0) {$bill = 'annually';} echo toggleButton("Say $bill","monthly","switch to $bill"); ?>
		 	</div>

	<div class="item <?php if ($_GET['pp'] == 12) {echo "active";}?>"> <!-- Income -->
		<h2>What is your annual household income?</h2>
			<small>Before any deductions for tax of national insurance</small> </br>
				<?php echo radioButton("1","inc", "15,000", "up to"); ?>
				<?php echo radioButton("2","inc", "25,000", "up to"); ?>
				<?php echo radioButton("3","inc", "35,000", "up to"); ?>
				<?php echo radioButton("4","inc", "50,000", "up to"); ?>
				<?php echo radioButton("5","inc", "75,000", "up to"); ?>
				<?php echo radioButton("6","inc", "75,000", "more than"); ?>
				<?php echo navButton('back'); ?>
				<?php echo navButton('next'); ?>
			</div> <!--  class item  -->


	<div class="item <?php if ($_GET['pp'] == 13) {echo "active";}?>"> <!-- Bill -->
		<h2>How affordable do you find your electricity?<small></br>Select the statement which best describes the affordability of your electricity.</small> </h2>
			<?php echo radioButton('1','af','Not affordable','I struggle to pay'); ?>
			<?php echo radioButton('2','af','High ','I must budget'); ?>
			<?php echo radioButton('3','af','Affordable','I can pay'); ?>
			<?php echo radioButton('4','af','Very affordable','I can pay easily'); ?>
		 	</div>

	<div class="item <?php if ($_GET['pp'] == 14) {echo "active";}?>"> <!-- Bill -->
		<h2>Which days would suit you for this trial?<small></br>Pick any days that allow you to install the electricity recorder the day before. Don't worry whether this is a 'typical' day for you.</small> </h2>
			<?php $date1 = '29 Jan'; ?>
			<?php $date2 = '1 Feb'; ?>
			<?php $date3 = '5 Feb'; ?>
			<?php echo toggleButton($date1,"date1","Friday");?>
			<?php echo toggleButton($date2,"date2","Monday");?>
			<?php echo toggleButton($date3,"date3","Friday");?>
		 	</div>

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
