<?php
require("bancoDeDados.php");
class ControleAluno {

    public static function buscarAluno($id_aluno) {
        $aluno = null;
        $bd = BancoDeDados::obterInstancia();
        $resultados = $bd->consultar("SELECT ALUNO.ID_ALUNO, MATRICULA.ID_MATR, ALUNO.RA, ALUNO.NOME, ALUNO.IMG FROM ALUNO INNER JOIN MATRICULA ON MATRICULA.ID_ALUNO = ALUNO.ID_ALUNO WHERE ID_ALUNO = $id_aluno ORDER BY ALUNO.NOME");
        foreach ($resultados as $resultado) {
            $aluno = new Aluno($resultado['ALUNO.ID_ALUNO'],
            $resultado['MATRICULA.ID_MATR'],
            $resultado['ALUNO.RA'],
            $resultado['ALUNO.NOME'],
            $resultado['ALUNO.IMG']);
            break;
        }
        return $aluno;
    }

    public static function buscarAlunos($idAula) {
        $alunos = [];
        $bd = BancoDeDados::obterInstancia();
        $resultados = $bd->consultar("SELECT ALUNO.ID_ALUNO, MATRICULA.ID_MATR, ALUNO.RA, ALUNO.NOME, ALUNO.IMG FROM ALUNO INNER JOIN MATRICULA ON MATRICULA.ID_ALUNO = ALUNO.ID_ALUNO INNER JOIN AULA ON AULA.COD_MAT = MATRICULA.COD_MAT WHERE AULA.ID_AULA = $idAula ORDER BY ALUNO.NOME");
        foreach ($resultados as $resultado) {
            $aluno = new Aluno($resultado['ALUNO.ID_ALUNO'],
            $resultado['MATRICULA.ID_MATR'],
            $resultado['ALUNO.RA'],
            $resultado['ALUNO.NOME'],
            $resultado['ALUNO.IMG']);
            $alunos[] = $aluno;
        }
        return $alunos;
    }
}