<?php

require('controleProfessor.php');
require($_SERVER['DOCUMENT_ROOT'].'/PROsiga/Backend/Modelos/professor.php');
require('controleMateria.php');
require($_SERVER['DOCUMENT_ROOT'].'/PROsiga/Backend/Modelos/materia.php');
require('controleAula.php');
require($_SERVER['DOCUMENT_ROOT'].'/PROsiga/Backend/Modelos/aula.php');
require('controlePresenca.php');
require($_SERVER['DOCUMENT_ROOT'].'/PROsiga/Backend/Modelos/presenca.php');
require('controleAluno.php');
require($_SERVER['DOCUMENT_ROOT'].'/PROsiga/Backend/Modelos/aluno.php');
require($_SERVER['DOCUMENT_ROOT'].'/PROsiga/Banco de Dados/bancoDeDados.php');


class ControleSessao {

    public static $professor;
    public static $materias;
    public static $materia;
    public static $aulas;
    public static $aula;
    public static $presencas;
    
    public function __construct() {
        session_start();
        ControleSessao::limpar();
    }

    public static function limpar() {
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
        $_SESSION['novas_pres'] = 10;
        $_SESSION['n_alunos'] = 10;
        $_SESSION['status'] = "inicio";
        $_SESSION['resultado'] = "-";
        
    }

    public static function login($email, $senha) {
        ControleSessao::limpar();
        $professor = ControleProfessor::buscarProfessor($email, $senha);
        $_SESSION['professor'] = $professor;
        if($professor) {
            $materias = ControleMateria::buscarMaterias($professor->id_prof);
            $_SESSION['materias'] = $materias;
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
    }

    public static function selecionarAula($Aula) {
        $_SESSION['aula']=$Aula;
        $presencas = ControlePresenca::buscarPresencas($Aula->id_aula);
        $_SESSION['presencas'] = $presencas;
    }
    
    public static function salvarChamada($presencas) {
        ControlePresenca::salvarPresencas($presencas);
        $presencas = [];
        $_SESSION['presencas'] = $presencas;
        $_SESSION['aula']->status = "REALIZADA";
        ControleAula::salvarAula($_SESSION['aula']);
        ControleSessao::selecionarMateria($_SESSION['materia']);
    } 

    public static function registrarAlunos($n_alunos){
        $_SESSION['n_alunos'] = $n_alunos;
    }
    public static function registrarPresencas($n_pres){
        $_SESSION['novas_pres'] = $n_pres;
    }
    public static function setStatus($status){
        $_SESSION['status'] = $status;
    }
    public static function setResultado($res){
        $_SESSION['resultado'] = $res;
    }
}
?>