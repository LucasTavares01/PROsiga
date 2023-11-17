<?php
class Professor {

    public $id_prof;
    public $nome;
    public $email;
    public $senha;
    
    public function __construct($id_prof, $nome, $email, $senha) {
        $this->id_prof = $id_prof;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }
}
?>