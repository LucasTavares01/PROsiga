<?php
class ControleSessao {

    public static $professor;
    public static $materias;
    public static $materia;
    public static $aulas;
    public static $aula;
    public static $presencas;
    
    public function __construct() {
        limpar();
    }

    private static function limpar() {
        $professor = null;
        $materias = [];
        $materia = null;
        $aulas = [];
        $aula = null;
        $presencas = [];
    }

    public static function login($email, $senha) {
        limpar();
        $professor = Professor::buscarProfessor($email, $senha);
        if($professor) {
            $materias = ControleMateria::buscarMaterias($professor->id_prof);
        } else {
            
        }
        
    }

    public static function selecionarMateria() {
        
        $aulas = ControleAula::buscarAulas($materia->cod_materia);
        $aula = null;
        $presencas = [];
    }

    public static function selecionarAula() {

        $presencas = ControlePresenca::buscarPresencas($aula->id_aula);
    }
    
    public static function salvarChamada() {
        ControlePresenca::salvarPresencas($presencas);
    }


}
?>