<?php

include('db_functions.php');
include('div_admin.php');
include('div_carlog.php');

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
elseif ($_POST['action'] == "outputTest")
{
	echo "Confirming communication to the server and that the PHP file is able to return data";
}
elseif ($_POST['action'] == "action_initial_maintenance_display")
{
	echo 'action_initial_maintenance_display';
	$rows = mysqli_query($db, "SELECT * FROM `cardb_maint`");
	echo '<table border = "2">';
	echo '<tr>';
	echo '<th>id</th> <th>garage</th> <th>description</th> <th>cost</th> <th>date</th> <th>miles</th> <th>notes</th> <th>invoice</th>';
	echo '</tr>';
	while ($row = mysqli_fetch_array($rows)) 
	{
		echo "<tr>";
		echo "<td>" . $row['id'] ."</td>";
		echo "<td>" . $row['garage'] . "</td>";
		echo "<td>" . $row['description'] . "</td>";
		echo "<td>" . $row['cost'] . "</td>";
		echo "<td>" . $row['date'] . "</td>";
		echo "<td>" . $row['miles'] . "</td>";
		echo "<td>" . $row['notes'] . "</td>";
		echo "<td>" . $row['invoice'] . "</td>";
		echo "</tr>";
	}
	echo '</table>';
}
elseif ($_POST['action'] == "action_add_vehicle")
{
    echo '<label for="make">Make:</label>';
    echo '<input type="text" id="make" name="make" required><br><br>';

    echo '<label for="model">Model:</label>';
    echo '<input type="text" id="model" name="model" required><br><br>';

    echo '<label for="year">Year:</label>';
    echo '<input type="number" id="year" name="year" required><br><br>';

    echo '<label for="vin">VIN Number:</label>';
    echo '<input type="text" id="vin" name="vin" required><br><br>';

    echo '<label for="registration">Registration Number:</label>';
    echo '<input type="text" id="registration" name="registration" required><br><br>';

    echo '<label for="mileage">Mileage:</label>';
    echo '<input type="number" id="mileage" name="mileage" required><br><br>';

    echo '<label for="license">License Plate:</label>';
    echo '<input type="text" id="license" name="license" required><br><br>';
    echo '<button onclick="handleNewCarCreation();">Create Car</button>'; 
}
elseif ($_POST['action'] == "action_select_car")
{
	echo "vin was passed in as " . $_POST['vin'];
	echo $dev_carlog;
}
elseif ($_POST['action'] == "action_administration")
{
	echo $dev_admin;
}
elseif ($_POST['action'] == "submit_new_vehicle")
{
	echo "submit new vehicle as : '" . $_POST['vin'] . "', '" . $_POST['plate'] . "', '" . $_POST['registration'] . "', '" . $_POST['make'] . "', '" . $_POST['model'] . "', '" . $_POST['miles'] . "', '" . $_POST['image'] . "'";
	
	$query = "INSERT INTO `cardb_cars` (`vin`, `plate`, `registration`, `make`, `model`, `miles`, `image`) VALUES ('"	. $_POST['vin'] . "', '" . $_POST['plate'] . "', '" . $_POST['registration'] . "', '" . $_POST['make'] . "', '" . $_POST['model'] . "', '" . $_POST['miles'] . "', '" . $_POST['image'] ."');";
	
	$rows = mysqli_query($db, $query);
}
elseif ($_POST['action'] == "delete_vehicle")
{
	echo "delete vehicle : '" . $_POST['id'] . "'";
	$query = "DELETE FROM `cardb_cars` WHERE `id` = '" . $_POST['id'] ."';";
	
	$rows = mysqli_query($db, $query);
}
elseif ($_POST['action'] == "update_existing_vehicle")
{
	$everyOther = TRUE;
	$tok = strtok($_POST['updatestring'], " =");
	$key=$tok;
	while ($tok !== false) {
		$everyOther = !$everyOther;
		if($everyOther === FALSE)
		{
			$key=$tok;
		}		
		else
		{
			if($key === "vin")
			{
				$newVin = $tok;
			}
			else if($key === "plate")
			{
				$newPlate = $tok;
			}
			else if($key === "registration")
			{
				$newRegistration = $tok;
			}
			else if($key === "make")
			{
				$newMake = $tok;
			}
			else if($key === "model")
			{
				$newModel = $tok;
			}
			else if($key === "miles")
			{
				$newMiles = $tok;
			}
			else if($key === "year")
			{
				$newYear = $tok;
			}
			else if($key === "image")
			{
				$newImage = $tok;
			}
		}
		$tok = strtok(" =");
	}
	$query = "UPDATE cardb_cars SET vin = '"	. $newVin . "', plate = '" . $newPlate . "', registration = '" . $newRegistration . "', make = '" . $newMake . "', year = '" . $newYear . "', model = '" . $newModel . "', miles = '" . $newMiles . "', image = '" . $newImage . "' WHERE id = '" . $_POST['vehicletoupdate']  . "';";
	$rows = mysqli_query($db, $query);
}
elseif ($_POST['action'] == "submit_new_maint")
{
	echo "submit new maintenace record : '" . $_POST['description'] . "', '" . $_POST['cost'] . "', '" . $_POST['garage'] . "'";
	$query = "INSERT INTO `cardb_maint` (`description`, `garage`, `cost`) VALUES ('" . $_POST['description'] . "', '" . $_POST['garage'] . "', '" . $_POST['cost'] ."');";
	
	$rows = mysqli_query($db, $query);
}
elseif ($_POST['action'] == "delete_maint")
{
	echo "delete maintenance record : '" . $_POST['id'] . "'";
	$query = "DELETE FROM `cardb_maint` WHERE `id` = '" . $_POST['id'] ."';";
	
	$rows = mysqli_query($db, $query);
}
elseif ($_POST['action'] == "update_existing_maint")
{
	$everyOther = TRUE;
	$tok = strtok($_POST['updatestring'], " =");
	$key=$tok;
	while ($tok !== false) {
		$everyOther = !$everyOther;
		if($everyOther === FALSE)
		{
			$key=$tok;
		}		
		else
		{
			if($key === "vehicleID")
			{
				$newVehicleID = $tok;
			}
			else if($key === "garage")
			{
				$newGarage = $tok;
			}
			else if($key === "cost")
			{
				$newCost = $tok;
			}
			else if($key === "date")
			{
				$newDate = $tok;
			}
			else if($key === "miles")
			{
				$newMiles = $tok;
			}
			else if($key === "notes")
			{
				$newNotes = $tok;
			}
			else if($key === "description")
			{
				$newDescription = $tok;
			}
			else if($key === "invoice")
			{
				$newInvoice = $tok;
			}
		}
		$tok = strtok(" =");
	}
	$query = "UPDATE cardb_maint SET vehicleID = '"	. $newVehicleID . "', garage = '" . $newGarage . "', cost = '" . $newCost . "', date = '" . $newDate . "', miles = '" . $newMiles . "', description = '" . $newDescription . "', notes = '" . $newNotes . "', invoice = '" . $newInvoice . "' WHERE id = '" . $_POST['maintenancetoupdate']  . "';";
	$rows = mysqli_query($db, $query);
}
elseif ($_POST['action'] == "dump_maint")
{
	echo "Output all maintenance records :\n";
	
	$query = "SELECT * FROM `cardb_maint`";
	$rows = mysqli_query($db, $query);
	printMaintTable($rows);
}
elseif ($_POST['action'] == "dump_vehicles")
{
	echo "Output all vehicles :\n";	
	$query = "SELECT * FROM `cardb_cars`";
	$rows = mysqli_query($db, $query);
	printCarTable($rows);
}
else
{
	echo 'no command';
}

function printCarTable($rows) {
	echo "<table id=\"carTable\"> <tr> <th width=\"7%\"> ID </th> <th width=\"13%\"> Year </th> <th width=\"20%\"> Model</th> <th width=\"15%\"> Make</th> <th width=\"15%\"> Miles</th> <th width=\"15%\"> Registration</th> <th width=\"15%\"> VIN </th>";
	if($rows == null)
	{
		return;
	}
	while ($row = mysqli_fetch_array($rows)) {
		//var_dump ($row);
		echo "<tr " . $row['id'] . ", null)\">";
		echo "<td align=\"center\"> " . $row['id'] . "</td>";
		echo "<td align=\"center\">" . $row['year'] . "</td>";
		echo "<td align=\"center\">" . $row['make'] . "</td>";
		echo "<td align=\"center\">" . $row['model'] . "</td>";
		echo "<td align=\"center\">" . $row['miles'] . "</td>";
		echo "<td align=\"left\">" . $row['registration'] . "</td>";
		echo "<td align=\"left\">" . $row['vin'] . "</td>";
		echo "</tr>";
		}
	echo "</table>";
}

function printMaintTable($rows) {

	echo "<table id=\"maintTable\"> <tr> 
	<th width=\"5%\"> ID </th> 
	<th width=\"10%\"> vin </th> 
	<th width=\"10%\"> garage</th> 
	<th width=\"5%\"> cost </th>
	<th width=\"10%\"> miles </th>
	<th width=\"25%\"> description </th>
	<th width=\"10%\"> date</th>
	<th width=\"25%\"> notes</th>
	
	";
	if($rows == null)
	{
		return;
	}
	while ($row = mysqli_fetch_array($rows)) {
		//var_dump ($row);
		echo "<tr " . $row['id'] . ", null)\">";
		echo "<td align=\"center\"> " . $row['id'] . "</td>";
		echo "<td align=\"center\">" . $row['vin'] . "</td>";
		echo "<td align=\"center\">" . $row['garage'] . "</td>";
		echo "<td align=\"center\">" . $row['cost'] . "</td>";
		echo "<td align=\"center\">" . $row['miles'] . "</td>";
		echo "<td align=\"center\">" . $row['description'] . "</td>";
		echo "<td align=\"center\">" . $row['date'] . "</td>";
		echo "<td align=\"center\">" . $row['notes'] . "</td>";
		echo "</tr>";
		}
	echo "</table>";
}