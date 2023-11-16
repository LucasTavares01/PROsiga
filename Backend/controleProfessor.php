<?php
require("bancoDeDados.php");
//require("professor.php");

class ControleProfessor {

    public static function buscarProfessor($email, $senha) {
        $professor = null;
        $bd = BancoDeDados::obterInstancia();
        $resultados = $bd->consultar("SELECT * FROM PROFESSOR WHERE EMAIL = '$email' AND SENHA = '$senha'");
        foreach ($resultados as $resultado) {
            $professor = new Professor($resultado['ID_PROF'],
            $resultado['NOME'],
            $resultado['EMAIL'],
            $resultado['SENHA']);
            break;
        }
        return $professor;
    }
    public static function salvarProfessor($professor) {
        $bd = BancoDeDados::obterInstancia();
        $dados = ["NOME" => $professor->nome,
        "EMAIL" => $professor->email,
        "SENHA" => $professor->senha];
        $bd->atualizar("PROFESSOR", $dados, "ID_PROF = $professor->id_prof");
    }

}