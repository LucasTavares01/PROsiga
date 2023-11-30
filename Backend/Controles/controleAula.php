<?php
//require("bancoDeDados.php");
//require("aula.php");

class ControleAula {

    public static function buscarAulas($codMateria) {
        $aulas = [];
        $bd = BancoDeDados::obterInstancia();
        $resultados = [];
        $resultados = $bd->consultar("SELECT * FROM AULA WHERE COD_MAT = $codMateria ORDER BY DATA");
        foreach ($resultados as $resultado) {
            $aula = new Aula($resultado['ID_AULA'],
            $resultado['COD_MAT'],
            $resultado['N_PRESENCAS'],
            $resultado['DATA'],
            $resultado['TITULO'],
            $resultado['COMENTARIO'],
            $resultado['STATUS']);
            $aulas[] = $aula;
        }
        return $aulas;
    }

    public static function salvarAula($aula) {
        $bd = BancoDeDados::obterInstancia();
        $dados = ["N_PRESENCAS" => "$aula->n_presencas",
        "DATA" => "$aula->data",
        "TITULO" => "$aula->titulo",
        "COMENTARIO" => "$aula->comentario",
        "STATUS" => "$aula->status"];
        $bd->atualizar("AULA", $dados, "ID_AULA = '$aula->id_aula'" );
    }
}
?>

