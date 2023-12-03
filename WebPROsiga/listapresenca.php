<?php
require($_SERVER['DOCUMENT_ROOT'] . '/PROsiga/Backend/Controles/controleSessao.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['salvarChamada'])) {
        $presencas = $_SESSION['presencas'];
        $index = 0;
        $lista = [];
        //$checkboxes = isset($_POST['checkbox']) ? $_POST['checkbox'] : array();
        foreach ($presencas as $presenca) {
            $check = $_POST['presencas'][$index];
            if ($check === 'on') {
                $presenca->presencas = 1;
            } else {
                $presenca->presencas = 0;
            }
            echo '<pre>', var_dump($check, $presenca->presencas), '</pre>';
            $lista[] = $presenca;
            $index++;
        }
        //echo '<pre>' , var_dump($presencas) , '</pre>';
        //echo '<pre>' , var_dump($lista) , '</pre>';
        ControleSessao::salvarChamada($lista);
        header("Location: aulas.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Disciplinas</title>
    <link rel="stylesheet" href="stylelistapresenca.css">
</head>

<body>

    <div class="avatar-container">
        <div class="fundoavatar"></div>
        <div class="imagemavatar"></div>
    </div>
<!--------------------------------------------------------------------------------HEADER---------------------------------------------------------------->
    <header>
        <div class="nomeprofessor">
            <?php
            $professor = $_SESSION['professor'];
            echo "<h1> $professor->nome </h1>"; //NOME DO PROFESSOR AQUI
            ?>
        </div>
        <div class="caixapesquisa">
            <p>Pesquisar</p>
            <div class="iconepesquisa"></div>
        </div>
        <div class="imagemlogo"></div>

    </header>

    <div class="uniaoasidemain">
<!--------------------------------------------------------------------------------ASIDE---------------------------------------------------------------->
        <aside>
            <nav>
                <ul>
                    <form action='' method='post'>
                        <li><a class="disciplina" href="disciplinas.php">DISCIPLINAS</a></li>
                        <li><a class="materiais" href="#">MATERIAIS</a></li>
                        <li><a class="perfil" href="#">PERFIL</a></li>
                    </form>
                </ul>
            </nav>
        </aside>
        <!--------------------------------------------------------------------------------MAIN----------------------------------------------------------------->
        <main>
            <h2>LISTA DE PRESENÇA</h2>
            <div class="cabecalhomateria">
                <div class="fundocabecalhomateria"></div>
                <?php
                $aula = $_SESSION['aula'];
                $materia = $_SESSION['materia'];
                $imagemCodificada = base64_encode($materia->icone);
                echo "<img class='icone' src='data:image/svg+xml;base64,$imagemCodificada' />";
                echo "<span class='nomemateria'>$materia->nome - Aula do dia $aula->data </span>";
                ?>
            </div>

            <div class='caixatabela'>
                <form action='' method='post'>
                    <table>
                        <thead>
                            <tr class=cabecalhotabela>
                                <th class="col-imagem"></th>
                                <th class="col-nome">Nome</th>
                                <th class="col-status">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $presencas = $_SESSION['presencas'];
                            $n_alunos = $_SESSION['n_alunos'];
                            $novas_pres = $_SESSION['novas_pres'];
                            $aula = $_SESSION['aula'];
                            $resultados = [];
                            $resultados = $_SESSION['resultado'];
                            $status = $_SESSION['status'];
                            /*
                            echo "n_res: $n_res /";
                            //foreach($resultados as $resultado)
                            
                            echo "aula_id: $aula->id_aula / ";
                            echo "novas_pres: $novas_pres / ";
                            echo "numero_alunos: $n_alunos / "; 
                            echo "status: $status /";
                            //var_dump($resultados);*/

                            $index = 0;
                            foreach ($presencas as $presenca) {
                                $aluno = $presenca->aluno;
                                $nome = $aluno->nome;
                                $img = base64_encode($aluno->img);
                                echo "<tr class='linha'>";
                                echo "<td class='foto'><img src='data:image/jpeg;base64,$img' class='editfoto' alt='Imagem'></td>";
                                if (($aluno->status === "PRESENTE" && $aula->status === "NAO REALIZADA") || ($aula->status === "REALIZADA" && $presenca->presencas > 0)) {
                                    echo "<td class='nomealuno'><b>$nome</b></td>";
                                } else {
                                    echo "<td class='nomealuno'>$nome</td>";
                                }

                                echo "<td class='status'>";
                                if (($aluno->status === "PRESENTE" && $aula->status === "NAO REALIZADA") || ($aula->status === "REALIZADA" && $presenca->presencas > 0)) {
                                    echo "<b><input type='checkbox' class='checkbox' id=$index name='presencas[]' checked/></b>";
                                } else {
                                    echo "<input type='checkbox' class ='checkbox' id=$index name='presencas[]' />";
                                }
                                echo "</td>";
                                echo "</tr>";
                                $index++;
                            }
                            ?>
                        </tbody>
                    </table>

                    <div class="caixabotao">
                        <button type='submit' name='salvarChamada' class='salvarchamada'>Salvar Chamada</button>
                    </div>

                </form>
            </div>

        </main>

    </div>

    <footer>
        <div class="caixalogo">
            <div class="logocentropaula"></div>
            <div class="logogovernosp"></div>
        </div>
    </footer>
</body>

</html>