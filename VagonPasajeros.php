<?php

class VagonPasajeros extends Vagon{
    private $cantMaximaP;
    private $cantPViajando;
    private $pesoPromedioP;
    private $pesoActualTotal;
    //constructor VagonPasajeros
    public function __construct($añoInstalacionV, $largoV, $anchoV, $pesoVacioV, $cantMaximaPasajeros, $cantPasajerosViajando, $pesoPromedioPasajeros, $pesoActualVagonP){
        //Invocamos constructor Vagon
        parent::__construct($añoInstalacionV, $largoV, $anchoV, $pesoVacioV);
        $this->cantMaximaP= $cantMaximaPasajeros;
        $this->cantPViajando= $cantPasajerosViajando;
        $this->pesoPromedioP= $pesoPromedioPasajeros;
        $this->pesoActualTotal= $pesoActualVagonP;
    }

    public function calcularPesoVagon(){
        $pesoTotal= parent::calcularPesoVagon();
        //10% de descuento viaje nacional
        $pasajeros= $this->getCantPViajando(); 
        $pesoPromedio= $this->getPesoPromedioP();
        $pesoTotal= $pesoTotal + ($pasajeros*$pesoPromedio);
        //$this->setImporte($importe); //no los podes setear, sino la proxima vez que quieras calcular calculas sobre el ya descontado
    return $pesoTotal;
    }

    Public function incorporarPasajeroVagon($cantPasajeros){
        $agregado= false;
        $cantMaxima= $this->getCantMaximaP();
        $cantActualPasajeros= $this->getCantPViajando();
        if($cantMaxima > $cantActualPasajeros){
            $lugaresDisponibles= $cantMaxima - $cantActualPasajeros;
            if($lugaresDisponibles >= $cantPasajeros){
                $cantActualPasajeros= $cantActualPasajeros + $cantPasajeros;
                $this->setCantPViajando($cantActualPasajeros);
                //$pesoActual= $this->getPesoActualTotal();
                $pesoTotal= $this->calcularPesoVagon();
                $this->setPesoActualTotal($pesoTotal);
                $agregado= true;
            }
        }
        return $agregado;
    }
}