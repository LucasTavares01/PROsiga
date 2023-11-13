<?php
class Professor {

    public $id_prof;
    public $nome;
    public $email;
    
    public function __construct($id_prof, $nome, $email) {
        $this->id_prof = $id_prof;
        $this->nome = $nome;
        $this->email = $email;
    }
}
?>