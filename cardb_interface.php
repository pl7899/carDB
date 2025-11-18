<?php

if ($_POST['action'] == "vehicle_initial_button_generation")
{
	echo 'vehicle_initial_button_generation Called';

}
elseif ($_POST['action'] == "action_initial_maintenance_display")
{
	echo 'action_initial_maintenance_display Called';
}
else
{
	echo 'no command';
}