
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

function action_add_vehicle(make, model, vin, registration, year, plate) {
    $.post("cardb_interface.php", { action: "action_add_vehicle" },
        function(data) {
       		$('#action_output').html(data);
           vehicle_initial_button_generation();
        });
}

function submit_new_vehicle(make, model, vin, registration, year, plate) {
  $.post("cardb_interface.php", { action: "submit_new_vehicle", make: make, model: model, vin: vin, registration: registration, year: year, plate: plate },
      function(data) {
      $('#action_output').html(data);
      });
	vehicle_initial_button_generation();
  action_initial_maintenance_display();
}

function action_select_car(vin_number) {
    $.post("cardb_interface.php", { action: "action_select_car", vin: vin_number },
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

function handleNewCarCreation() {
  var newCarMake = document.getElementById("make").value;
  var newCarModel = document.getElementById("model").value;
  var newCarVin = document.getElementById("vin").value;
  var newCarRegistration = document.getElementById("registration").value;
  var newCarYear = document.getElementById("year").value;
  var newCarPlate = document.getElementById("license").value;
  var newCarName = document.getElementById("name").value;

  submit_new_vehicle(newCarMake, newCarModel, newCarVin, newCarRegistration, newCarYear, newCarPlate, newCarName);
}

function setActiveCar(carID) {
  $.post("cardb_interface.php", { action: "action_select_car", activeCar: carID },
    function(data) {
      $('#action_output').html(data);
    });
}

function updateExitingCar(carID) {
  $.post("cardb_interface.php", { action: "modify_existing_vehicle", activeCar: carID },
    function(data) {
      $('#action_output').html(data);
    });
}

function pushVehicleUpdates(carID) {
  var updateCarMake = document.getElementById("make").value;
  var updateCarModel = document.getElementById("model").value;
  var updateCarMiles = document.getElementById("mileage").value;
  var updateCarVin = document.getElementById("vin").value;
  var updateCarImage = document.getElementById("image").value;
  var updateCarRegistration = document.getElementById("registration").value;
  var updateCarYear = document.getElementById("year").value;
  var updateCarPlate = document.getElementById("license").value;
  var updateCarName = document.getElementById("name").value;
  $.post("cardb_interface.php", { action: "push_updates_vehicle", activeCar: carID, updateMake: updateCarMake, updateModel: updateCarModel, updateVin: updateCarVin, updateRegistration: updateCarRegistration, updateYear: updateCarYear, updatePlate: updateCarPlate, updateMiles: updateCarMiles, updateImage: updateCarImage, updateName: updateCarName},
    function(data) {
      $('#action_output').html(data);
      vehicle_initial_button_generation();
    });
}

