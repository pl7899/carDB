<?php

include('db_functions.php');
include('div_admin.php');
include('div_carlog.php');

$db = db_connect();

if ($_POST['action'] == "vehicle_initial_button_generation")
{
    echo "<button class=\"button\" onclick=\"action_add_vehicle()\" title=\"Add A New Vehicle\" style=\"width: 250px; height: 200px; background-image: url('images/car.png'); background-size: cover; background-position: center;\"></button>";
    $rows = mysqli_query($db, "SELECT * FROM `cardb_cars`");
    while ($row = mysqli_fetch_array($rows)) 
    {
        // Assuming each car has an image URL stored in the 'image' column
        $imageUrl = $row['image']; // Replace 'image' with the correct column name for the image URL

        // Check if the image URL is valid
        if (!empty($imageUrl)) {
            echo "<button class=\"button\" onclick=\"setActiveCar(" . $row['id'] . ")\" title=\"Activate " . $row['name'] . "\" style=\"width: 250px; height: 200px; background-image: url('" . $imageUrl . "'); background-size: cover; background-position: center;\"></button>";
        } else {
            // Fallback to showing the name if no valid image is available
            echo "<button class=\"button\" onclick=\"setActiveCar(" . $row['id'] . ")\" title=\"Activate " . $row['name'] . "\" style=\"width: 250px; height: 200px;\">" . $row['name'] . "</button>";
        }
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
		echo "<td>" . $row['name'] ."</td>";
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

    echo '<label for="name">Name:</label>';
    echo '<input type="text" id="name" name="name" required><br><br>';

    echo '<label for="license">License Plate:</label>';
    echo '<input type="text" id="license" name="license" required><br><br>';
    echo '<button class=\"button\" onclick="handleNewCarCreation();">Create Car</button>'; 
}
elseif ($_POST['action'] == "action_select_car")
{
	$activeCar = $_POST['activeCar'];
	$query = "SELECT * FROM `cardb_cars` WHERE `id` = '" . $_POST['activeCar'] . "';";
	$rows = mysqli_query($db, $query);
	printCarTable($rows, 0);

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
	$query = "INSERT INTO `cardb_cars` (`vin`, `plate`, `registration`, `make`, `model`, `miles`, `year`, `image`, `name`) VALUES ('"	. $_POST['vin'] . "', '" . $_POST['plate'] . "', '" . $_POST['registration'] . "', '" . $_POST['make'] . "', '" . $_POST['model'] . "', '" . $_POST['miles'] . "', '" . $_POST['year'] . "', '" . $_POST['image'] . "', '" . $_POST['name']	."');";
	
	$rows = mysqli_query($db, $query);
}
elseif ($_POST['action'] == "modify_existing_vehicle")
{
    $query = "SELECT * FROM `cardb_cars` WHERE `id` = '" . $_POST['activeCar'] . "';";
    $rows = mysqli_query($db, $query);
    if ($rows == null) {
        return;
    }
    $row = mysqli_fetch_array($rows);

    echo '<h2>Modify Vehicle Information</h2>';
    echo '<form id="modifyVehicleForm" style="display: flex; align-items: center; gap: 20px;">'; // Center vertically

    // Use a table for better alignment of labels and input fields
    echo '<table class="form-table" style="width: 35%;">';
    echo '<tr>';
    echo '<td><label for="name">Name:</label></td>';
    echo '<td><input type="text" id="name" name="name" required value="' . $row['name'] . '" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td><label for="make">Make:</label></td>';
    echo '<td><input type="text" id="make" name="make" required value="' . $row['make'] . '" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td><label for="model">Model:</label></td>';
    echo '<td><input type="text" id="model" name="model" required value="' . $row['model'] . '" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td><label for="year">Year:</label></td>';
    echo '<td><input type="number" id="year" name="year" required value="' . $row['year'] . '" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td><label for="image">Image URL:</label></td>';
    echo '<td><input type="text" id="image" name="image" required value="' . $row['image'] . '" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td><label for="vin">VIN Number:</label></td>';
    echo '<td><input type="text" id="vin" name="vin" required value="' . $row['vin'] . '" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td><label for="registration">Registration Number:</label></td>';
    echo '<td><input type="text" id="registration" name="registration" required value="' . $row['registration'] . '" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td><label for="mileage">Mileage:</label></td>';
    echo '<td><input type="number" id="mileage" name="mileage" required value="' . $row['miles'] . '" /></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td><label for="license">License Plate:</label></td>';
    echo '<td><input type="text" id="license" name="license" required value="' . $row['plate'] . '" /></td>';
    echo '</tr>';
    echo '</table>';

    // Add the submit button to the right-hand side
    echo '<div style="flex-shrink: 0;">';
    echo '<button class="button" title="Update Car Entry" style="width: 125px; height: 100px; margin: 50px; border: none; border-radius: 10px; cursor: pointer;" onclick="pushVehicleUpdates(' . $_POST['activeCar'] . ');">Modify Car</button>';
    echo '</div>';

    echo '</form>';
}
elseif ($_POST['action'] == "show_new_maintenance_entry")
{
    echo '<h2>Add New Maintenance Record</h2>';
    echo '<form id="newMaintenanceForm" style="width: 100%; max-width: 600px; margin: 0 auto;">';

    // Use a table for better alignment of labels and input fields
    echo '<table class="form-table" style="width: 100%; border-spacing: 10px;">';

    echo '<tr>';
    echo '<td><label for="description">Description:</label></td>';
    echo '<td><input type="text" id="description" name="description" required style="width: 100%;"></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td><label for="garage">Garage:</label></td>';
    echo '<td><input type="text" id="garage" name="garage" required style="width: 100%;"></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td><label for="miles">Miles:</label></td>';
    echo '<td><input type="number" id="miles" name="miles" required style="width: 100%;"></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td><label for="notes">Notes:</label></td>';
    echo '<td><input type="text" id="notes" name="notes" required style="width: 100%;"></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td><label for="cost">Cost:</label></td>';
    echo '<td><input type="text" id="cost" name="cost" required style="width: 100%;"></td>';
    echo '</tr>';

    echo '<tr>';
    echo '<td><label for="date">Date:</label></td>';
    echo '<td><input type="date" id="date" name="date" required style="width: 100%;"></td>';
    echo '</tr>';

    echo '</table>';

    // Add the submit button
    echo '<div style="text-align: center; margin-top: 20px;">';
    echo '<button class="button" onclick="handleNewMaintCreation();" style="width: 200px; height: 50px; border: none; border-radius: 10px; background-color: #4CAF50; color: white; cursor: pointer;">Create Maintenance</button>';
    echo '</div>';

    echo '</form>';
}
elseif ($_POST['action'] == "delete_vehicle")
{
	echo "delete vehicle : '" . $_POST['id'] . "'";
	$query = "DELETE FROM `cardb_cars` WHERE `id` = '" . $_POST['id'] ."';";
	
	$rows = mysqli_query($db, $query);
}
elseif ($_POST['action'] == "push_updates_vehicle")
{
	$query = "UPDATE cardb_cars SET vin = '"	. $_POST['updateVin'] . "', plate = '" . $_POST['updatePlate'] . "', registration = '" . $_POST['updateRegistration'] . "', make = '" . $_POST['updateMake'] . "', year = '" . $_POST['updateYear'] . "', model = '" . $_POST['updateModel'] . "', miles = '" . $_POST['updateMiles'] . "', image = '" . $_POST['updateImage'] . "', name = '" . $_POST['updateName'] .	"' WHERE id = '" . $_POST['activeCar']  . "';";
	$rows = mysqli_query($db, $query);

	$query = "SELECT * FROM `cardb_cars` WHERE `id` = '" . $_POST['activeCar'] . "';";
	$rows = mysqli_query($db, $query);
	printCarTable($rows, 0);

	$query = "SELECT * FROM `cardb_maint` WHERE `vehicleID` = '" . $_POST['activeCar'] . "';";
	$rows = mysqli_query($db, $query);
	printMaintTable($rows);
}
elseif ($_POST['action'] == "submit_new_maintenance")
{
    $query = "INSERT INTO `cardb_maint` (`vehicleID`, `description`, `garage`, `cost`, `miles`, `notes`, `date`) VALUES ('" . $_POST['activeCar']  . "', '" . $_POST['description'] . "', '" . $_POST['garage'] . "', '" . $_POST['cost'] . "', '" . $_POST['miles'] . "', '" . $_POST['notes'] . "', '" . $_POST['date'] . "');";
	echo $query;
	
	$rows = mysqli_query($db, $query);
}
elseif ($_POST['action'] == "delete_maint")
{
	echo "delete maintenance record : '" . $_POST['id'] . "'";
	$query = "DELETE FROM `cardb_maint` WHERE `id` = '" . $_POST['id'] ."';";
	
	$rows = mysqli_query($db, $query);
}
elseif ($_POST['action'] == "add_button_for_maintenance")
{
	echo "<button class=\"button\" onclick=\"action_show_new_maintenance_entry()\" title=\"Record New Maintenance\" style=\"width: 250px; height: 200px; background-image: url('images/wrench.png'); background-size: cover; background-position: center;\"></button>";
}
elseif ($_POST['action'] == "add_button_for_car_update")
{
	echo "<button class=\"button\" onclick=\"updateExitingCar(" . $_POST['activeCar'] .")\" title=\"Modify the Selected Vehicle\" style=\"width: 250px; height: 200px; background-image: url('images/customization.png'); background-size: cover; background-position: center;\"></button>";
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

function printCarTableWithHeader($rows, $showEditButton) {
	echo "<table id=\"carTable\" > 
	<tr> 
	<th width=\"10%\"> name </th> 
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
		echo "<tr class=\"carTable\">";
		echo "<td align=\"center\">" . $row['name'] . "</td>";
		echo "<td align=\"center\">" . $row['year'] . "</td>";
		echo "<td align=\"center\">" . $row['make'] . "</td>";
		echo "<td align=\"center\">" . $row['model'] . "</td>";
		echo "<td align=\"center\">" . $row['miles'] . "</td>";
		echo "<td align=\"center\">" . $row['registration'] . "</td>";
		echo "<td align=\"center\">" . $row['plate'] . "</td>";
		echo "<td align=\"center\">" . $row['vin'] . "</td>";
		if($showEditButton == 1)
		{
			echo "<td class=\"td-button\" onclick=\"updateExitingCar(" . $row['id'] .")\"> Edit </td>";
		}
	
		echo "</tr>";
		}
	echo "</table>";
}

function printCarTable($rows, $showEditButton) {
	echo "<br>";
	echo "<table class=\"carTable\" id=\"carTable\" > ";
	if($rows == null)
	{
		echo "</table>";
		return;
	}
	while ($row = mysqli_fetch_array($rows)) {
		echo "<tr>";
		echo "<th align=\"center\">" . $row['name'] . "</th>";
		echo "<th align=\"center\">" . $row['year'] . "</th>";
		echo "<th align=\"center\">" . $row['make'] . "</th>";
		echo "<th align=\"center\">" . $row['model'] . "</th>";
		echo "<th align=\"center\">" . $row['miles'] . "</th>";
		echo "<th align=\"center\">" . $row['registration'] . "</th>";
		echo "<th align=\"center\">" . $row['plate'] . "</th>";
		echo "<th align=\"center\">" . $row['vin'] . "</th>";
		if($showEditButton == 1)
		{
			echo "<th class=\"td-button\" onclick=\"updateExitingCar(" . $row['id'] .")\"> Edit </th>";
		}
	
		echo "</tr>";
		}
	echo "</table>";
	echo "<br><br>";
}

function printMaintTable($rows) {

	echo "<table class=\"maintTable\" id=\"maintTable\"> <tr> 
	<th width=\"10%\"> Garage</th> 
	<th width=\"5%\"> Cost </th>
	<th width=\"10%\"> Miles </th>
	<th width=\"25%\" style=\"text-align:left\";> Description </th>
	<th width=\"10%\"> Date</th>
	<th width=\"25%\" style=\"text-align:left\";> Notes</th>
	";
	if($rows == null)
	{
		echo "</table>";
		return;
	}
	while ($row = mysqli_fetch_array($rows)) {
		echo "<tr>";
		echo "<td align=\"center\">" . $row['garage'] . "</td>";
		echo "<td align=\"center\">" . $row['cost'] . "</td>";
		echo "<td align=\"center\">" . $row['miles'] . "</td>";
		echo "<td align=\"left\">" . $row['description'] . "</td>";
		echo "<td align=\"center\">" . $row['date'] . "</td>";
		echo "<td align=\"left\">" . $row['notes'] . "</td>";
		echo "</tr>";
		}
	echo "</table>";
}


