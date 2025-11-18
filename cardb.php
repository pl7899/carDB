<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Responsive Image Container</title>

<style>
  .image-container {
    display: flex;
    height: 150px;             /* Fixed height for container */
    gap: 18px;                  /* Space between images */
  }
  .image-container img {
    height: 100%;              /* Make images fit container height */
    flex-shrink: 1;            /* Allow shrinking */
    width: auto;               /* Maintain aspect ratio */
    object-fit: contain;
  }
  .lineHorizontal {
    border-top: 1px solid #000;
    border-boottom: 1px solid #000;
    width: 100%;
    height: 5px;
  }	
</style>

</head>

<body>
<script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"> </script>
<script src="cardb_shim.js"></script>

<div id="vehicle_output" class="image-container">

</div>

<hr class="lineHorizontal">   

<div id="action_output">
	<p>location 1</p>
</div>

<script>
	$(document).ready(function() {
		vehicle_initial_button_generation();
		action_initial_maintenance_display();
	});

</script>

</body>

</html>