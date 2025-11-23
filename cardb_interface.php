<?php
include('db_functions.php');
include('dev_addcar.php');
$db = db_connect();

if ($_POST['action'] == "vehicle_initial_button_generation")
{
	echo "<button onclick=\"action_add_vehicle()\" style=\"width: 200px; height: 150px;\">Add a Car</button>";
	$rows = mysqli_query($db, "SELECT * FROM `cardb_cars`");
	echo "trying to parse db";
	while ($row = mysqli_fetch_array($rows)) 
	{
		echo "found : " . $row['vin'] . " make : " . $row['make'];
		echo "<button onclick=\"action_select_car(" . $row['vin'] . ")\" style=\"width: 200px; height: 150px;\">" . $row['vin'] . " " . $row['make'] . "</button>";
	}

}
elseif ($_POST['action'] == "action_initial_maintenance_display")
{
	echo 'action_initial_maintenance_display';
}
elseif ($_POST['action'] == "action_add_vehicle")
{
	echo $dev_addcar;
}
elseif ($_POST['action'] == "action_select_car")
{
	echo "vin was passed in as " . $_POST['vin'] . " :: ";
	var_dump($_POST);
}
else
{
	echo 'no command';
}