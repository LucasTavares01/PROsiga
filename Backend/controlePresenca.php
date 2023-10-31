<?php
class ControlePresenca {

    public static function buscarPresencas($idAula) {
        $presencas = [];
        $bd = BancoDeDados::obterInstancia();
        $resultados = [];
        $resultados = $bd->consultar("SELECT * FROM PRESENCA WHERE ID_AULA = $idAula");
        if($resultados) {
            foreach ($resultados as $resultado) {
                $presenca = new Presenca($resultado['ID_AULA'],
                $resultado['ID_MATR'],
                $resultado['DATA'],
                $resultado['PRESENCAS'],
                $resultado['ID_PRESENCA']);
                $presencas[] = $presenca;
            }
        } else {
            $presencas = criarPresencas($idAula);
        }

        return $presencas;
    }

    private static function criarPresencas($idAula, $idMatricula, $data) {
        $presencas = [];

        return $presencas;
    }

    public static function salvarPresencas($presencas) {
        foreach ($presencas as $presenca) {
            salvarPresenca($presenca);
        }
    }

    private static function salvarPresenca($presenca) {
        $bd = BancoDeDados::obterInstancia();
        if($presenca->id_presenca === -1) {

        } else {
        $dados = ["PRESENCAS" => "$presenca->presencas"];
        $bd->atualizar("PRESENCA", $dados, "ID_PRESENCA = '$presenca->id_presenca'" );
        }
    }
}
?>