<?php

if ($_POST['action'] == "vehicle_initial_button_generation")
{
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
  <!-- Add up to 15 images similarly -->
	EOT;
}
elseif ($_POST['action'] == "action_initial_maintenance_display")
{
}
else
{
	echo 'no command';
}