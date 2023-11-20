<?php
class Materia {

    public $cod_materia;
    public $nome;
    public $ano_sem;
    public $id_prof;

    public function __construct($cod_materia, $nome, $ano_sem, $id_prof, $icone) {
        $this->cod_materia = $cod_materia;
        $this->nome = $nome;
        $this->ano_sem = $ano_sem;
        $this->id_prof = $id_prof;
        $this->icone = $icone;
    }
}
?>