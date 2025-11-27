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
	echo '<FORM>';
    echo '<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">';
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
    echo '<button type="submit">Submit</button>';
	echo '</form></FORM>';
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
else
{
	echo 'no command';
}