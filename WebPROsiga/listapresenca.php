<?php
require($_SERVER['DOCUMENT_ROOT'] . '/PROsiga/Backend/Controles/controleSessao.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['salvarChamada'])) {
        $presencas = $_SESSION['presencas'];
        $index = 0;
        $lista = [];
        //$checkboxes = isset($_POST['checkbox']) ? $_POST['checkbox'] : array();
        foreach($presencas as $presenca) {
            $check = $_POST['presencas'][$index];
            if($check === 'on') {
                $presenca->presencas = 1;
            } else {
                $presenca->presencas = 0;
            }
            echo '<pre>' , var_dump($check, $presenca->presencas) , '</pre>';
            $lista[] = $presenca;
            $index++;
        }
        //echo '<pre>' , var_dump($presencas) , '</pre>';
        //echo '<pre>' , var_dump($lista) , '</pre>';
        //ControleSessao::salvarChamada($lista);
        //header("Location: aulas.php");
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

    <header>
        <?php
        $professor = $_SESSION['professor'];
        echo "<h1> $professor->nome </h1>"; //NOME DO PROFESSOR AQUI
        ?>
    </header>

    <div class="uniaoasidemain">

        <aside>
            <nav>
                <ul>
                    <li><a class="disciplina" href="#">DISCIPLINAS</a></li>
                    <li><a class="materiais" href="#">MATERIAIS</a></li>
                    <li><a class="perfil" href="#">PERFIL</a></li>
                </ul>
            </nav>
        </aside>
<!------------------------------------------------MAIN---------------------------------------->
        <main>
            <h2>LISTA DE PRESENÇA</h2>
            <div class="cabecalhomateria">
                <div class="fundocabecalhomateria"></div>
                <?php
                $materia = $_SESSION['materia'];
                $imagemCodificada = base64_encode($materia->icone);
                echo "<img class='icone' src='data:image/svg+xml;base64,$imagemCodificada' />";
                echo "<span class='nomemateria'>$materia->nome - </span>";    
                $aula = $_SESSION['aula'];
                echo "<span class='dataaula'>Aula do dia $aula->data</span>";            
                ?>
                
            </div>

            <div class='caixatabela'>
                <table>
                    <thead>
                        <tr class=cabecalhotabela>
                        <th class="col-imagem">Imagem</th>
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

                        echo "<form action='' method='post'>";                        
                        $index = 0;
                        foreach($presencas as $presenca) {
                            $aluno = $presenca->aluno;
                            $nome = $aluno->nome;
                            $img = base64_encode($aluno->img);
                            echo "<tr class='linha'>";
                            echo "<td class='foto'><img src='data:image/svg+xml;base64,$img' alt='Imagem'></td>";
                            echo "<td class='nomealuno'>$nome</td>";
                            echo "<td class='status'>";                            
                            if($aluno->status === "PRESENTE") {
                                echo "<input type='checkbox' class = form id=$index name='presencas[]' checked/>";
                            } else {
                                echo "<input type='checkbox' class = form id=$index name='presencas[]' />";
                            }                         
                            echo "</td>";
                            echo "</tr>";
                            $index++;
                        }
                        echo "<button type='submit' name='salvarChamada' class='salvarchamada'>Salvar Chamada</button>";
                        echo "</form>";
                        
                        ?>
                    </tbody>
                </table>
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