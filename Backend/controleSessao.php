<?php
require("professor.php");
require("controleProfessor.php");
require("materia.php");
require("controleMateria.php");
require("aula.php");
require("controleAula.php");
require("presenca.php");
require("controlePresenca.php");
require("aluno.php");
require("controleAluno.php");

class ControleSessao {

    public static $professor;
    public static $materias;
    public static $materia;
    public static $aulas;
    public static $aula;
    public static $presencas;
    
    public function __construct() {
        session_start();
        limpar();

    }

    private static function limpar() {
        $professor = null;
        $materias = [];
        $materia = null;
        $aulas = [];
        $aula = null;
        $presencas = [];
        $_SESSION['professor'] = $professor;
        $_SESSION['materias'] = $materias;
        $_SESSION['materia'] = $materia;
        $_SESSION['aulas'] = $aulas;
        $_SESSION['aula'] = $aula;
        $_SESSION['presencas'] = $presencas;
    }

    public static function login($email, $senha) {
        limpar();
        $professor = Professor::buscarProfessor($email, $senha);
        $_SESSION['professor'] = $professor;
        if($professor) {
            $materias = ControleMateria::buscarMaterias($professor->id_prof);
            $_SESSION['materias'] = $materias;
            //ir para pagina Materias
        } else {
            //Mensagem de erro
        }
        
    }

    public static function selecionarMateria($Materia) {      
        $_SESSION['materia'] = $Materia;  
        $aulas = ControleAula::buscarAulas($Materia->cod_materia);
        $_SESSION['aulas'] = $aulas;
        $aula = null;
        $_SESSION['aula'] = $aula;
        $presencas = [];
        $_SESSION['presencas'] = $presencas;
        //Ir para pagina Aulas
    }

    public static function selecionarAula($Aula) {
        $_SESSION['aula']=$Aula;
        $presencas = ControlePresenca::buscarPresencas($Aula->id_aula);
        $_SESSION['presencas'] = $presencas;
        //Ir para a pagina Chamada
    }
    
    public static function salvarChamada() {
        $presencas = $_SESSION['presencas'];
        ControlePresenca::salvarPresencas($presencas);
        //Ir para pagina Aulas
    }


}
?>