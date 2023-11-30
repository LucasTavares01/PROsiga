<?php
//require("bancoDeDados.php");
class ControleAluno {

    public static function buscarAluno($id_aluno) {
        $aluno = null;
        $bd = BancoDeDados::obterInstancia();
        $cod_mat = $_SESSION['materia']->cod_materia;
        $resultados = $bd->consultar("SELECT ALUNO.ID_ALUNO, MATRICULA.ID_MATR, ALUNO.RA, ALUNO.NOME, ALUNO.IMG, ALUNO.STATUS FROM ALUNO INNER JOIN MATRICULA ON MATRICULA.ID_ALUNO = ALUNO.ID_ALUNO WHERE ALUNO.ID_ALUNO = $id_aluno AND MATRICULA.COD_MAT = $cod_mat");
        foreach ($resultados as $resultado) {
            $aluno = new Aluno($resultado['ALUNO.ID_ALUNO'],
            $resultado['MATRICULA.ID_MATR'],
            $resultado['ALUNO.RA'],
            $resultado['ALUNO.NOME'],
            $resultado['ALUNO.IMG'],
            $resultado['ALUNO.STATUS']);
            break;
        }
        return $aluno;
    }

    public static function buscarAlunos($idAula) {
        $alunos = [];
        $resultados = [];
        $bd = BancoDeDados::obterInstancia();
        $resultados = $bd->consultar("SELECT ALUNO.ID_ALUNO, MATRICULA.ID_MATR, ALUNO.RA, ALUNO.NOME, ALUNO.IMG, ALUNO.STATUS FROM ALUNO INNER JOIN MATRICULA ON MATRICULA.ID_ALUNO = ALUNO.ID_ALUNO INNER JOIN AULA ON AULA.COD_MAT = MATRICULA.COD_MAT WHERE AULA.ID_AULA = $idAula ORDER BY ALUNO.NOME");
        $_SESSION['n_alunos'] = count($resultados);
        foreach ($resultados as $resultado) {
            $aluno = new Aluno($resultado['ID_ALUNO'],
            $resultado['ID_MATR'],
            $resultado['RA'],
            $resultado['NOME'],
            $resultado['IMG'],
            $resultado['STATUS']);
            $alunos[] = $aluno;
        }
        
        return $alunos;
    }
}