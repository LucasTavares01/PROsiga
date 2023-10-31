<?php
class Presenca {

    public $id_presenca;
    public $id_aula;
    public $id_matricula;
    public $data;
    public $presencas;

    public function __construct($idAula, $idMatricula, $data, $nPresencas, $idPresenca = -1) {
        $this->id_presenca = $idPresenca;
        $this->id_aula = $idAula;
        $this->id_matricula = $idMatricula;
        $this->data = $data;
        $this->presencas = $nPresencas;
    }
}
?>