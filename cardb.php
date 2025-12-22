<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>CarDB</title>
<link rel="stylesheet" type="text/css" href="formatting.css"> </link>

</head>

<body>
<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"> </script>
<script src="cardb_shim.js"></script>

<div id="vehicle_output" class="image-container">

</div>

<hr class="lineHorizontal">   

<div id="actionContainer" class="flex-parent-element">
  <div id="action_output" class="flex-child-element" style="flex-grow: 4;"> </div>
  <div id="button_output" class="flex-child-element style="flex-grow: 1;""> </div>
  <div id="sidemargin_output" class="flex-child-element style="flex-grow: 1;""> </div>
</div>

<script>
	$(document).ready(function() {
		vehicle_initial_button_generation();
		action_initial_maintenance_display();
	});

</script>

</body>

</html>