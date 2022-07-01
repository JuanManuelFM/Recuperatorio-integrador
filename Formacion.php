<?php
class Formacion{
    //atributos
    private $objLocomotora;
    private $coleccionVagones;
    private $maximoVagones;

    public function __construct($objLocomotoraF, $coleccionVagonesF, $maximoVagonesF){
        $this->objLocomotora=$objLocomotoraF;
        $this->coleccionVagones=$coleccionVagonesF;
        $this->maximoVagones=$maximoVagonesF;
    }

    /* busca dentro de la colección de vagones aquel vagón capaz de
    incorporar esa cantidad de pasajeros. Si no hay ningún vagón en la formación que pueda ingresar la
    cantidad de pasajeros, el método debe retornar un valor falso y verdadero en caso contrario. Puede
    utilizar la función is_a para saber si se trata de un vagón de carga o de pasajeros.
    */
    public function incorporarPasajeroInformacion($cantPasajeros){
        $i= 0;
        $hayLugar= false;
        $arrayVagones= $this->getColeccionVagones();
        $vagones= count($arrayVagones);
        for ($i = 0; $i < $vagones; $i++){
            $unVagon = $arrayVagones[$i];
            $elVagon= is_a($unVagon, "VagonPasajeros");
            if($elVagon){
                $cantActualPasajeros= $unVagon->getCantPViajando();
                $cantMaxPasajeros= $unVagon->getCantMaximaP();
                $lugares= $cantMaxPasajeros - $cantActualPasajeros;
                if($lugares >= $cantPasajeros){
                    $cantActualPasajeros= $cantActualPasajeros + $cantPasajeros;
                    $unVagon->setCantPViajando($cantActualPasajeros);
                    $hayLugar= true;
                }
            }
        }
        return $hayLugar;
    }

    public function incorporarVagonInformacion($unVagon){
        $arrayVagones= $this->getColeccionVagones();
        $elVagon= is_a($unVagon, "VagonCarga");
        if($elVagon){
            $nuevo= new VagonCarga ($añoInstalacionV, $largoV, $anchoV, $pesoVacioV, $pesoMaximoPosibleV, $pesoActualCargaV, $indiceCargaV);
        }
        else{
            $nuevo= new VagonPasajeros ($añoInstalacionV, $largoV, $anchoV, $pesoVacioV, $cantMaximaPasajeros, $cantPasajerosViajando, $pesoPromedioPasajeros, $pesoActualVagonP);
        }
        array_push($arrayVagones, $nuevo);
        $this->setColeccionVagones($arrayVagones);
    }

    public function pesoFormacion(){
        $pesoFormacion= null;
        $arrayVagones= $this->getColeccionVagones();
        $vagones= count($arrayVagones);
        $locomotora= $this->getObjLocomotora();
        $pesoLocomoto= $locomotora->getPeso();
        $pesoFormacion= $pesoFormacion + $pesoLocomoto;
        for ($i = 0; $i < $vagones; $i++){
            $unVagon = $arrayVagones[$i];
            $elVagon= is_a($unVagon, "VagonPasajeros");
            if ($elVagon){
                $pesoPasajeros= $unVagon->getPesoActualTotal();
                $pesoFormacion= $pesoFormacion + $pesoPasajeros;
            }
            else{
                $pesoCarga= $unVagon->getPesoActualCarga();
                $pesoFormacion= $pesoFormacion + $pesoCarga;
            }
        }
        return $pesoFormacion;
    }   
}

