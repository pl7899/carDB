<?php
include('db_functions.php');
$db = db_connect();

if ($_POST['action'] == "vehicle_initial_button_generation")
{
	echo "<button style=\"width: 200px; height: 150px;\">Add a Car</button>";
	$rows = mysqli_query($db, "SELECT * FROM `cardb_cars`");
	echo "trying to parse db";
	while ($row = mysqli_fetch_array($rows)) 
	{
		echo "found : " . $row['vin'] . " make : " . $row['make'];
		echo "<button style=\"width: 200px; height: 150px;\">" . $row['vin'] . " " . $row['make'] . "</button>";
	}

}
elseif ($_POST['action'] == "action_initial_maintenance_display")
{
	echo 'action_initial_maintenance_display';
}
elseif ($_POST['action'] == "action_add_vehicle")
{
echo <<<EOB
<FORM>    <form action="/submit-vehicle" method="POST">
    <label for="make">Make:</label>
    <input type="text" id="make" name="make" required><br><br>

    <label for="model">Model:</label>
    <input type="text" id="model" name="model" required><br><br>

    <label for="year">Year:</label>
    <input type="number" id="year" name="year" required><br><br>

    <label for="vin">VIN Number:</label>
    <input type="text" id="vin" name="vin" required><br><br>

    <label for="registration">Registration Number:</label>
    <input type="text" id="registration" name="registration" required><br><br>

    <label for="mileage">Mileage:</label>
    <input type="number" id="mileage" name="mileage" required><br><br>

    <label for="license">License Plate:</label>
    <input type="text" id="license" name="license" required><br><br>
    <button type="submit">Submit</button>
</form></FORM>
EOB;
}
else
{
	echo 'no command';
}