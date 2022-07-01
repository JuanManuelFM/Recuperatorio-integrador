<?php

class VagonCarga extends Vagon
{
    private $pesoMaximoPosible;
    private $pesoActualCarga;
    private $indiceCarga;
    //constructor VagonPasajeros
    public function __construct($añoInstalacionV, $largoV, $anchoV, $pesoVacioV, $pesoMaximoPosibleV, $pesoActualCargaV, $indiceCargaV)
    {
        //Invocamos constructor Vagon
        parent::__construct($añoInstalacionV, $largoV, $anchoV, $pesoVacioV);
        $this->pesoMaximoPosible= $pesoMaximoPosibleV;
        $this->pesoActualCarga= $pesoActualCargaV;
        $this->indiceCarga= $indiceCargaV;
    }

    public function calcularPesoVagon(){
        $pesoTotal= parent::calcularPesoVagon();
        //10% de descuento viaje nacional
        $pesoActualVagon= $this->getPesoActualCarga();
        $indicePeso= $this->getIndiceCarga();
        $pesoTotal= $pesoTotal + (($pesoActualVagon*$indicePeso)/100);
        //$this->setImporte($importe); //no los podes setear, sino la proxima vez que quieras calcular calculas sobre el ya descontado
        return $pesoTotal;
    }

    public function incorporarCargaVagon($cantCarga){
        $agregado= false;
        $pesoMaximo= $this->getPesoMaximoPosible();
        $cargaActual= $this->getPesoActualCarga();
        if ($pesoMaximo > $cargaActual){
            $pesoDisponible= $pesoMaximo - $cargaActual;
            $cantCargaN= parent::getPesoVacio();
            $cantCarga= $cantCarga + $cantCargaN;
            if ($pesoDisponible >= $cantCarga) {
                $cargaActual= $cargaActual + $cantCarga;
                $this->setPesoActualCarga($cargaActual);
                //$pesoActual= $this->getPesoActualCarga();
                $pesoActualCarga= $this->calcularPesoVagon();
                $this->setPesoActualCarga($pesoActualCarga);
                $agregado= true;
            }


            return $agregado;
        }
    }
}