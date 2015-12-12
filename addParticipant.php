<?php
// Define connection settings
$server = 'localhost';
$dbName = 'Meter';
$dbUserName = 'webuser';
$dbUserPass = 'Secure22012004';

// Connect to the database server
$db = mysqli_connect($server,$dbUserName,$dbUserPass,$dbName);

if (mysqli_connect_errno()) {
    print '<p class="alert alert-error">Oh, dear. The connect failed: ' . mysqli_connect_error() . '. Please email philipp.grunewald@ouce.ox.ac.uk about it.</p>';
    exit();
}
 
$sql="INSERT INTO Registered (`Name`, `Surname`, `Email`, `ev`, `pv`, `ps`, `ashp`, `gshp`, `sh`, `comment`)
VALUES
('$_POST[Name]','$_POST[Surname]','$_POST[Email]','$_POST[ev]','$_POST[pv]','$_POST[ps]','$_POST[ashp]','$_POST[gshp]','$_POST[sh]','$_POST[comment]')";
 
if (!mysqli_query($db,$sql))
  {
  die('I am sorry - something went wrong. Please email philipp.grunewald@ouce.ox.ac.uk.!!  ' . mysqli_error());
  }
else
{
    echo "Thank you for rigistering.";
header( 'Location: http://www.distributed-energy.de/?page_id=353' ) ;


}
mysql_close($db);
?>

