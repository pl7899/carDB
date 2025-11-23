
function vehicle_initial_button_generation() {
    $.post("cardb_interface.php", { action: "vehicle_initial_button_generation" },
        function(data) {
    		$('#vehicle_output').html(data);
        });
}

function action_initial_maintenance_display() {
    $.post("cardb_interface.php", { action: "action_initial_maintenance_display" },
        function(data) {
    		$('#action_output').html(data);
        });
}

function action_add_vehicle() {
    $.post("cardb_interface.php", { action: "action_add_vehicle" },
        function(data) {
    		$('#action_output').html(data);
        });
}

function action_select_car(vin_number) {
    $.post("cardb_interface.php", { action: "action_select_car", vin: "vin_number" },
        function(data) {
    		$('#action_output').html(data);
        });
}

function action_administration() {
    $.post("cardb_interface.php", { action: "action_administration" },
        function(data) {
    		$('#action_output').html(data);
        });
}