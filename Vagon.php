<?php
class Vagon{
    //atributos
    private $añoInstalacion;
    private $largo;
    private $ancho;
    private $pesoVacio;

    public function __construct($añoInstalacionV, $largoV, $anchoV, $pesoVacioV){
        $this->añoInstalacion=$añoInstalacionV;
        $this->largo=$largoV;
        $this->ancho=$anchoV;
        $this->pesoVacio=$pesoVacioV;
    }

    public function calcularPesoVagon(){
        $pesoTotal= null;
        $pesoVacio= $this->getPesoVacio();
        $pesoTotal= $pesoTotal + $pesoVacio;
        return $pesoTotal;
    }
}