<?php

require_once 'VehicleBase.php';
require_once 'VehicleActions.php';
require_once 'FileHandler.php';

class VehicleManager extends VehicleBase implements VehicleActions {
    use FileHandler;

    public function addVehicle($data) {

        $vehilces = $this->readFile();
        $vehilces[] = $data ;
        $this->writeFile($vehilces) ;

    }

    public function editVehicle($id, $data) {
        $vehilces = $this->readFile();
        if(isset($vehilces[$id])){
            $vehilces[$id] = $data ;
            $this->writeFile($vehilces) ;
        }
    }

    public function deleteVehicle($id) {
        $vehilces = $this->readFile();
        if(isset($vehilces[$id])){
          unset($vehilces[$id]) ;
          $this->writeFile(array_values($vehilces)) ;

        }
    }

    public function getVehicles() {
       return $this->readFile();
    }

    // Implement abstract method
    public function getDetails() {
        return [
            'name' => $this->name ,
            'type' => $this->type ,
            'price' => $this->price ,
            'image' => $this->image 
        ];
    }
}
