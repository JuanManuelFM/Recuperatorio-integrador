<?php
class Locomotora{
    //atributos
    private $peso;
    private $velocidadMaxima;

    public function __construct($unPeso, $unavelocidadMaxima){
        $this->peso=$unPeso;
        $this->velocidadMaxima=$unavelocidadMaxima;
    }
}