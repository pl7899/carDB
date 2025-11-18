<?php
include('db_functions.php');
$db = db_connect();

if ($_POST['action'] == "vehicle_initial_button_generation")
{
	$rows = mysqli_query($db, "SELECT * FROM `cardb_cars`");
	while ($row = mysqli_fetch_array($rows)) 
	{
		echo "found : " . $row['vin'] + " make : " + $row['make'];
	}
echo <<<EOT
		<button style="width: 200px; height: 150px;">Add Car</button>
		<img src="https://picsum.photos/400/300" alt="1" />
		<img src="https://picsum.photos/100/150" alt="2" />
		<img src="https://picsum.photos/300/300" alt="3" />
		<img src="https://picsum.photos/200/300" alt="4" />
		<img src="https://picsum.photos/300/200" alt="5" />
		<img src="https://picsum.photos/300/200" alt="6" />
		<img src="https://picsum.photos/400/200" alt="7" />
		<img src="https://picsum.photos/300/500" alt="8" />
	EOT;
}
elseif ($_POST['action'] == "action_initial_maintenance_display")
{
	echo 'action_initial_maintenance_display';
}
else
{
	echo 'no command';
}