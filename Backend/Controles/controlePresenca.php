<?php
//require("bancoDeDados.php");
//require("presenca.php");
//require("aluno.php");
//require("controleSessao.php");

class ControlePresenca {

    public static function buscarPresencas($idAula) {
        $presencas = [];
        $bd = BancoDeDados::obterInstancia();
        $resultados = [];
        $resultados = $bd->consultar("SELECT * FROM PRESENCA WHERE ID_AULA = $idAula");
        ControleSessao::setResultado($resultados);
        if($resultados->num_rows > 0) {
            ControleSessao::setStatus("resultado encontrado");
            foreach ($resultados as $resultado) {
                $aluno = null;
                $buscas = [];
                $id_mat = $resultado['ID_MATR'];
                $buscas = $bd->consultar("SELECT ID_ALUNO FROM MATRICULA WHERE ID_MATR = $id_mat");
                foreach ($buscas as $busca) {
                    $aluno = ControleAluno::buscarAluno($busca['ID_ALUNO']);
                    break;
                }
                $presenca = new Presenca($resultado['ID_AULA'],
                $resultado['ID_MATR'],
                $aluno,
                $resultado['DATA'],
                $resultado['PRESENCAS'],
                $resultado['ID_PRESENCA']);
                $presencas[] = $presenca;
            }            
        } else {
            $presencas = ControlePresenca::criarPresencas($idAula);
            ControleSessao::setStatus("nao encontrado");
        }
        ControleSessao::registrarPresencas(count($presencas));
        return $presencas;
    }

    private static function criarPresencas($idAula) {
        $presencas = [];
        $aula = $_SESSION['aula'];
        $alunos = ControleAluno::buscarAlunos($idAula);
        ControleSessao::registrarAlunos(count($alunos));
        ControleSessao::setResultado($alunos);
        foreach ($alunos as $aluno) {
            $presenca = new Presenca($idAula,
            $aluno->id_matr,
            $aluno,
            $aula->data,
            0);
            $presencas[] = $presenca;
        }
        return $presencas;
    }

    public static function salvarPresencas($presencas) {
        $data = null;
        foreach ($presencas as $presenca) {
            ControlePresenca::salvarPresenca($presenca);
        }
    }

    private static function salvarPresenca($presenca) {
        $bd = BancoDeDados::obterInstancia();
        if($presenca->id_presenca === -1) {
            $dados = ["ID_AULA" => "$presenca->id_aula",
            "ID_MATR" => "$presenca->id_matricula",
            "DATA" => "$presenca->data",
            "PRESENCAS" => "$presenca->presencas"];
            $bd->inserir("PRESENCA", $dados);
        } else {
            $dados = ["PRESENCAS" => "$presenca->presencas"];
            $bd->atualizar("PRESENCA", $dados, "ID_PRESENCA = '$presenca->id_presenca'");
        }
    }
}
?>