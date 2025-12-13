<?php

include('db_functions.php');
include('div_admin.php');
include('div_carlog.php');

$db = db_connect();

if ($_POST['action'] == "vehicle_initial_button_generation")
{
	echo "<button onclick=\"action_add_vehicle()\" style=\"width: 200px; height: 150px;\">Add a Car</button>";
	$rows = mysqli_query($db, "SELECT * FROM `cardb_cars`");
	while ($row = mysqli_fetch_array($rows)) 
	{
		echo "<button onclick=\"setActiveCar(" . $row['id'] . ")\" style=\"width: 200px; height: 150px;\">" . $row['Make'] . " " . $row['model'] . "</button>";
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

	$query = "SELECT * FROM `cardb_cars` WHERE `id` = '" . $_POST['activeCar'] . "';";
	$rows = mysqli_query($db, $query);
	printCarTable($rows, 1);

	$query = "SELECT * FROM `cardb_maint` WHERE `vehicleID` = '" . $_POST['activeCar'] . "';";
	$rows = mysqli_query($db, $query);
	printMaintTable($rows);
}
elseif ($_POST['action'] == "action_administration")
{
	echo $dev_admin;
}
elseif ($_POST['action'] == "submit_new_vehicle")
{
	echo "submit new vehicle as : '" . $_POST['vin'] . "', '" . $_POST['plate'] . "', '" . $_POST['registration'] . "', '" . $_POST['make'] . "', '" . $_POST['model'] . "', '" . $_POST['miles'] . "', '" . $_POST['image'] . "'";
	
	$query = "INSERT INTO `cardb_cars` (`vin`, `plate`, `registration`, `make`, `model`, `miles`, `year`, `image`) VALUES ('"	. $_POST['vin'] . "', '" . $_POST['plate'] . "', '" . $_POST['registration'] . "', '" . $_POST['make'] . "', '" . $_POST['model'] . "', '" . $_POST['miles'] . "', '" . $_POST['year'] . "', '" . $_POST['image'] ."');";
	
	$rows = mysqli_query($db, $query);
}
elseif ($_POST['action'] == "modify_existing_vehicle")
{
	$query = "SELECT * FROM `cardb_cars` WHERE `id` = '" . $_POST['activeCar'] . "';";
	$rows = mysqli_query($db, $query);
	if($rows == null)
	{
		return;
	}	
	$row = mysqli_fetch_array($rows);
	echo '<label for="make">Make:</label>';
    echo '<input type="text" id="make" name="make" required value="' . $row['make'] . '" /> <br>';

    echo '<label for="model">Model:</label>';
    echo '<input type="text" id="model" name="model" required value="' . $row['model'] . '" /> <br>';

    echo '<label for="year">Year:</label>';
    echo '<input type="number" id="year" name="year" required value="' . $row['year'] . '" /> <br>';

	echo '<label for="year">image:</label>';
    echo '<input type="text" id="image" name="image" required value="' . $row['image'] . '" /> <br>';

    echo '<label for="vin">VIN Number:</label>';
    echo '<input type="text" id="vin" name="vin" required value="' . $row['vin'] . '" /> <br>';

    echo '<label for="registration">Registration Number:</label>';
    echo '<input type="text" id="registration" name="registration" required value="' . $row['registration'] . '" /> <br>';

    echo '<label for="mileage">Mileage:</label>';
    echo '<input type="number" id="mileage" name="mileage" required value="' . $row['miles'] . '" /> <br>';

    echo '<label for="license">License Plate:</label>';
    echo '<input type="text" id="license" name="license" required value="' . $row['plate'] . '" /> <br>';
    echo '<button onclick="pushVehicleUpdates(' . $_POST['activeCar'] . ');">Modify Car</button>'; 
}
elseif ($_POST['action'] == "delete_vehicle")
{
	echo "delete vehicle : '" . $_POST['id'] . "'";
	$query = "DELETE FROM `cardb_cars` WHERE `id` = '" . $_POST['id'] ."';";
	
	$rows = mysqli_query($db, $query);
}
elseif ($_POST['action'] == "push_updates_vehicle")
{
	$query = "UPDATE cardb_cars SET vin = '"	. $_POST['updateVin'] . "', plate = '" . $_POST['updatePlate'] . "', registration = '" . $_POST['updateRegistration'] . "', make = '" . $_POST['updateMake'] . "', year = '" . $_POST['updateYear'] . "', model = '" . $_POST['updateModel'] . "', miles = '" . $_POST['updateMiles'] . "', image = '" . $_POST['updateImage'] . "' WHERE id = '" . $_POST['activeCar']  . "';";
	$rows = mysqli_query($db, $query);
	action_select_car($_POST['activeCar']);
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
	printCarTable($rows, 0);
}
else
{
	echo 'no command';
}

function printCarTable($rows, $showEditButton) {
	echo "<table id=\"carTable\"> 
	<tr> 
	<th width=\"5%\"> ID </th> 
	<th width=\"10%\"> Year </th> 
	<th width=\"15%\"> Model</th> 
	<th width=\"10%\"> Make</th> 
	<th width=\"10%\"> Miles</th> 
	<th width=\"15%\"> Registration</th> 
	<th width=\"10%\"> Plate</th> 
	<th width=\"15%\"> VIN </th>";
	if($showEditButton == 1)
	{
		echo "<th width=\"10%\"> Modify </th>";
	}

	echo "</tr>";
	if($rows == null)
	{
		echo "</table>";
		return;
	}
	while ($row = mysqli_fetch_array($rows)) {
		//var_dump ($row);
		echo "<tr>";
		echo "<td align=\"center\"> " . $row['id'] . "</td>";
		echo "<td align=\"center\">" . $row['year'] . "</td>";
		echo "<td align=\"center\">" . $row['make'] . "</td>";
		echo "<td align=\"center\">" . $row['model'] . "</td>";
		echo "<td align=\"center\">" . $row['miles'] . "</td>";
		echo "<td align=\"left\">" . $row['registration'] . "</td>";
		echo "<td align=\"left\">" . $row['plate'] . "</td>";
		echo "<td align=\"left\">" . $row['vin'] . "</td>";
		if($showEditButton == 1)
		{
			echo "<td class=\"td-button\" onclick=\"updateExitingCar(" . $row['id'] .")\"> Edit </td>";
		}
	
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
		echo "</table>";
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


