<?php
class Aluno {

    public $id_aluno;
    public $id_matr;
    public $ra;
    public $nome;
    public $img;
    
    public function __construct($id_aluno, $id_matr, $ra, $nome, $img) {
        $this->id_aluno = $id_aluno;
        $this->id_matr = $id_matr;
        $this->ra = $ra;
        $this->nome = $nome;
        $this->img = $img;
    }
}
?>