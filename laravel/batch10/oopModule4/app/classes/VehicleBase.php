<?php

abstract class VehicleBase {
    protected $name ;
    protected $type ;
    protected $price ;
    protected $image ;
  

    abstract public function getDetails();

    public function anotherMethod(){
        return "Hello";
    }

}
