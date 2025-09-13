<?php

abstract class VehicleBase {
    protected $name ;
    protected $type ;
    protected $price ;
    protected $image ;

    public function __construct( $name , $type , $price , $image )
    {
        $this->name = $name ;
        $this->name = $type ;
        $this->name = $price ;
        $this->name = $image ;
    }

    abstract public function getDetails();
}
