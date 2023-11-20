<?php

class ControleMateria {

    public static function buscarMaterias($id_prof) {
        $materias = [];
        $bd = BancoDeDados::obterInstancia();
        $resultados = [];
        $resultados = $bd->consultar("SELECT * FROM MATERIA WHERE ID_PROF = $id_prof");
        foreach ($resultados as $resultado) {
            $materia = new Materia($resultado['COD_MAT'],
            $resultado['NOME'],
            $resultado['ANO_SEM'],
            $resultado['ID_PROF'],
            $resultado['ICONE']);
            $materias[] = $materia;
        }
        return $materias;
    }
}
?>