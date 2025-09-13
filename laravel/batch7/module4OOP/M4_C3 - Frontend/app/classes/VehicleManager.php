<?php

require_once 'VehicleBase.php';
require_once 'VehicleActions.php';
require_once 'FileHandler.php';
 
class VehicleManager extends VehicleBase  implements VehicleActions{
   
    use FileHandler ;

    public function addVehicle($data) {       
        
        $vehicles = $this->readFile();
        $vehicles[] = $data;
        $this->writeFile($vehicles);

    }



    public function editVehicle($id, $data) {
        
    }

    public function deleteVehicle($id) {
        
    }

    public function getVehicles() {
       
    }

    // Implement abstract method
    public function getDetails() {
        
    }



}


