<?php
class Aula {

    public $id_aula;
    public $cod_materia;
    public $n_presencas;
    public $data; 
    public $titulo;
    public $comentario;
    public $status;
    
    public function __construct($id_aula, $cod_materia, $n_presencas, $data, $titulo, $comentario, $status) {
        $this->id_aula = $id_aula;
        $this->cod_materia = $cod_materia;
        $this->n_presencas = $n_presencas;
        $this->data = $data; 
        $this->titulo = $titulo;
        $this->comentario = $comentario;
        $this->status = $status;
    }
}
?>